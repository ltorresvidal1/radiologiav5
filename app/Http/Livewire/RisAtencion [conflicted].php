<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ris\transito;
use App\Models\ris\ris_salas;
use Livewire\WithFileUploads;
use Illuminate\Support\Carbon;
use App\Models\medicos\Medicos;
use App\Models\ris\procedencias;
use App\Models\ris\ris_estudios;
use App\Models\ris\ris_convenios;
use App\Models\ris\ris_pacientes;
use App\Models\ris\ris_finalidades;
use App\Models\ris\ris_modalidades;
use App\Models\ris\ris_prioridades;
use Illuminate\Support\Facades\Auth;
use App\Models\ris\medicosremitentes;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_hl7generados;
use App\Models\ris\ris_relserviciostransito;
use App\Models\usuariosclientes\Usuariosclientes;

class RisAtencion extends Component
{
    use WithFileUploads;
    protected $listeners = ['elimarregistro', 'addatencion', 'cerrarmodal'];
    public $paciente = [], $medicos = [], $convenios = [], $prioridades = [], $procedencias = [], $medicosremintentes = [], $servicios = [];
    public $transitos = [], $tipoid = [], $sexos = [], $finalidades = [], $modalidades = [], $salas = [];
    public $fechaactual, $idtransito, $idadmision, $idpaciente, $idmedico, $idconvenio, $idprioridad, $idprocedencia, $idmedicoremintente, $idservicio;
    public $idfinalidad, $idmodalidad, $idsala, $cie10;
    public $relservicios = [];
    public $activeForm;

    public $idtipoid, $documento, $primernombre, $segundonombre, $primerapellido, $segundoapellido, $fechanacimiento, $idsexo, $correo, $direccion, $barrio, $celular, $telefono;
    public $filehistoria = null, $fileordenmedica = null, $fileconsentimiento = null, $fileverificacion = null;


    protected function rules()
    {
        if ($this->activeForm === 'servicios') {
            return [
                'idservicio' => 'required',
                'idmodalidad' => 'required',
                'idsala' => 'required',
                'idfinalidad' => 'required',
            ];
        }
        if ($this->activeForm === 'paciente') {
            return [
                'idtipoid' => 'required',
                'documento' => 'required',
                'primernombre' => 'required',
                'primerapellido' => 'required',
                'fechanacimiento' => 'required',
                'idsexo' => 'required',
                'celular' => 'required',
            ];
        }
        if ($this->activeForm === 'atencion') {
            return [
                'idtipoid' => 'required',
                'documento' => 'required',
                'primernombre' => 'required',
                'primerapellido' => 'required',
                'fechanacimiento' => 'required',
                'idsexo' => 'required',
                'celular' => 'required',
                'idprioridad' => 'required',
                'idprocedencia' => 'required',
                'idmedico' => 'required',
                'idconvenio' => 'required',
                'cie10' => 'required',
                'relservicios' => 'required|array|min:1',
            ];
        }
    }
    // 
    public function cerrarmodal()
    {
        $this->dispatchBrowserEvent('close-modal');
        //$this->resetModal();
    }

    public function resetModal()
    {
        // $this->idmodalidad = '';
        //  $this->idsala = '';
        //  $this->cie10 = '';

        //    $this->idfinalidad = '';
    }
    public function cargarfilehistoria()
    {
        $this->actuaizarserviciocombo();
    }
    public function updatedFilehistoria()
    {
        $this->actuaizarserviciocombo();
        $this->filehistoria->storeAs('soportes/' . $this->idadmision, "historia_clinica.pdf", 'public');
    }
    public function cargarfileordenmedica()
    {
        $this->actuaizarserviciocombo();
    }
    public function updatedFileordenmedica()
    {
        $this->actuaizarserviciocombo();
        $this->fileordenmedica->storeAs('soportes/' . $this->idadmision, "orden_medica.pdf", 'public');
    }
    public function cargarfileconsentimiento()
    {
        $this->actuaizarserviciocombo();
    }
    public function updatedFileconsentimiento()
    {
        $this->actuaizarserviciocombo();
        $this->fileconsentimiento->storeAs('soportes/' . $this->idadmision, "consentimiento_informado.pdf", 'public');
    }
    public function cargarfileverificacion()
    {
        $this->actuaizarserviciocombo();
    }
    public function updatedFileverificacion()
    {
        $this->actuaizarserviciocombo();
        $this->fileverificacion->storeAs('soportes/' . $this->idadmision, "verificacion_derechos.pdf", 'public');
    }

    public function mount()
    {
        $this->transitos = transito::where('transito.idestado', '=', '0')
            ->join('ris_pacientes', 'ris_pacientes.id', '=', 'transito.paciente_id')
            ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
            ->selectRaw("transito.id,ris_pacientes.id as idpaciente, concat(ris_pacientes.documento,' - ',ris_pacientes.primernombre,' ',ris_pacientes.segundonombre,' ',ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as nombre,
    estudios.nombre as estudio,transito.admision,transito.fecha,ris_pacientes.documento,transito.medico_id as medico,
    CAST(transito.procedencia AS INT) as prioridad,transito.procedencia,transito.convenio_id") // Agregar ris_pacientes.documento a la lista SELECT
            ->distinct()
            ->get();


        $this->modalidades = collect();
        $this->salas = collect();
    }

    public function updatedIdservicio($values)
    {
        if ($values != null) {
            $modalida_servicio = ris_estudios::where('idestado', '1')->where('id', $values)->first();
            $this->modalidades = ris_modalidades::where('idestado', '1')->where('codigo', $modalida_servicio->modalidad)->get();
            $this->idmodalidad = $this->modalidades->first()->id ?? null;

            $this->salas = ris_salas::where('idestado', '1')->where('modalidad_id', $this->idmodalidad)->get();
            $this->idsala = $this->salas->first()->id ?? null;
        } else {
            $this->modalidades = collect();
            $this->idmodalidad = "";
            $this->salas = collect();
            $this->idsala = "";
        }
        $this->actuaizarserviciocombo();
    }

    public function updatedIdmodalidad($values)
    {

        $this->idservicio = $values;
        $modalida_servicio = ris_estudios::where('idestado', '1')->where('id', $values)->first();
        $this->modalidades = ris_modalidades::where('idestado', '1')->where('codigo', $modalida_servicio->modalidad)->get();
        $this->idmodalidad = $this->modalidades->first()->id ?? null;
        $this->actuaizarserviciocombo();
    }

    public function addatencion(string $transitoid, string $pacienteid, string $admisionid, string $medicoid, string $prioridadid, string $procedenciaid, string $administradoraid)
    {

        $this->idtransito = $transitoid;
        $this->idadmision = $admisionid;
        $this->idpaciente = $pacienteid;
        $this->idmedico = $medicoid;
        $this->idconvenio = $administradoraid;
        $this->idprioridad = $prioridadid;
        $this->idprocedencia = $procedenciaid;
        $this->idfinalidad = 1;
        //dd($medicoid);
        //$this->medicos = ris_pacientes::where('id', $pacienteid)->first();

        $this->actuaizarcombo();
        $this->dispatchBrowserEvent('show-modal');
    }
    public function storeservicios()
    {
        $this->activeForm = 'servicios';
        $this->actuaizarserviciocombo();
        $this->validate();

        ris_relserviciostransito::create([
            'admision' => $this->idadmision,
            'estudio_id' => $this->idservicio,
            'modalidad_id' => $this->idmodalidad,
            'sala_id' => $this->idsala,
            'finalidad_id' => $this->idfinalidad
        ]);
        $this->actuaizarserviciocombo();
    }
    public function storepaciente()
    {
        $this->activeForm = 'paciente';
        $this->actuaizarserviciocombo();
        $this->validate();

        ris_pacientes::where('id',  $this->idpaciente)
            ->update([
                'idtipoid' => $this->idtipoid,
                'documento' => $this->documento,
                'primernombre' => $this->primernombre,
                'segundonombre' => $this->segundonombre,
                'primerapellido' => $this->primerapellido,
                'segundoapellido' => $this->segundoapellido,
                'fechanacimiento' => $this->fechanacimiento,
                'correo' => $this->correo,
                'direccion' => $this->direccion,
                'barrio' => $this->barrio,
                'celular' => $this->celular,
                'telefono' => $this->telefono,
            ]);

        $this->actuaizarserviciocombo();
    }

    public function storeatencion()
    {

        $this->activeForm = 'atencion';
        $this->actuaizarserviciocombo();
        $this->validate();

        $paciente = ris_pacientes::where('id', $this->idpaciente)->first();

        ris_hl7generados::create([
            'fecha_orden' => $fecha_orden,
            'numero_examen' => $numero_examen,
            'identificacion_paciente' => $identificacion_paciente,
            'tipo_id_paciente' => $tipo_id_paciente,
            'apellidos_paciente' => $apellidos_paciente,
            'nombres_paciente' => $nombres_paciente,
            'fechanacimiento_paciente' => $fechanacimiento_paciente,
            'sexo_paciente' => $sexo_paciente,
            'direccion_paciente' => $direccion_paciente,
            'ciudad_paciente' => $ciudad_paciente,
            'municipio_paciente' => $municipio_paciente,
            'departamento_paciente' => $departamento_paciente,
            'pais_paciente' => $pais_paciente,
            'telefono_paciente' => $telefono_paciente,
            'celular_paciente' => $celular_paciente,
            'unidad_funcional' => $unidad_funcional,
            'fecha_admision' => $fecha_admision,
            'nit_empresa' => $nit_empresa,
            'nombre_empresa' => $nombre_empresa,
            'numero_orden' => $numero_orden,
            'fecha_inicio' => $fecha_inicio,
            'fecha_finalizacion' => $fecha_finalizacion,
            'usuario_doctor' => $usuario_doctor,
            'codigo_doctor' => $codigo_doctor,
            'apellido_doctor' => $apellido_doctor,
            'nombre_doctor' => $nombre_doctor,
            'sala' => $sala,
            'puesto_atencion' => $puesto_atencion,
            'nit_administradora' => $nit_administradora,
            'nombre_administradora' => $nombre_administradora,
            'cups' => $cups,
            'nombre_cups' => $nombre_cups,
            'procedencia' => $procedencia,
            'modalidad' => $modalidad,
            'message' => $message->toString(true)
        ]);



        $this->cerrarmodal();
    }
    public function render()
    {
        return view('livewire.ris-atencion');
    }

    public function actuaizarcombo()
    {
        $paciente_actual = $this->idpaciente;
        $admision_actual = $this->idadmision;

        $this->fechaactual = Carbon::now()->setTimezone('America/Bogota');
        $this->tipoid = Desplegables::where('ventana', 'tipodocumento')->where('estado', '1')->get();
        $this->sexos = Desplegables::where('ventana', 'genero')->where('estado', '1')->get();
        $this->paciente = ris_pacientes::where('id', $paciente_actual)->first();

        $this->idtipoid = $this->paciente->idtipoid;
        $this->documento = $this->paciente->documento;
        $this->primernombre = $this->paciente->primernombre;
        $this->segundonombre = $this->paciente->segundonombre;
        $this->primerapellido = $this->paciente->primerapellido;
        $this->segundoapellido = $this->paciente->segundoapellido;
        $this->fechanacimiento = $this->paciente->fechanacimiento;
        $this->idsexo = $this->paciente->idsexo;
        $this->correo = $this->paciente->correo;
        $this->direccion = $this->paciente->direccion;
        $this->barrio = $this->paciente->barrio;
        $this->celular = $this->paciente->celular;
        $this->telefono = $this->paciente->telefono;

        $this->medicos = Medicos::where('idestado', '1')->get();
        $this->convenios = ris_convenios::where('idestado', '1')->get();
        $this->prioridades = ris_prioridades::where('idestado', '1')->get();
        $this->procedencias = procedencias::where('idestado', '1')->get();
        $this->medicosremintentes = medicosremitentes::where('idestado', '1')->get();
        $this->finalidades = ris_finalidades::where('idestado', '1')->get();

        $this->servicios = transito::where('transito.idestado', '=', '0')
            ->where('transito.admision', '=', $admision_actual)
            ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
            ->selectRaw("transito.id,estudios.id,estudios.cups,estudios.nombre")
            ->distinct()
            ->whereNotIn('estudios.id', function ($query) use ($admision_actual) {
                $query->select('ris_relserviciostransito.estudio_id')
                    ->from('ris_relserviciostransito')
                    ->where('ris_relserviciostransito.admision', '=', $admision_actual);
            })
            ->get();

        $this->relservicios = ris_relserviciostransito::where('ris_relserviciostransito.admision', '=', $admision_actual)
            ->join('estudios', 'estudios.id', '=', 'ris_relserviciostransito.estudio_id')
            ->join('ris_modalidades', 'ris_modalidades.id', '=', 'ris_relserviciostransito.modalidad_id')
            ->join('ris_salas', 'ris_salas.id', '=', 'ris_relserviciostransito.sala_id')
            ->join('ris_finalidades', 'ris_finalidades.id', '=', 'ris_relserviciostransito.finalidad_id')
            ->selectRaw("ris_relserviciostransito.id,estudios.nombre as servicio,ris_modalidades.codigo as modalidad,ris_salas.nombre as sala,ris_finalidades.nombre as finalidad")
            ->get();
    }

    public function actuaizarserviciocombo()
    {

        $admision_actual = $this->idadmision;

        $this->servicios = transito::where('transito.idestado', '=', '0')
            ->where('transito.admision', '=', $admision_actual)
            ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
            ->selectRaw("transito.id,estudios.id,estudios.cups,estudios.nombre")
            ->distinct()
            ->whereNotIn('estudios.id', function ($query) use ($admision_actual) {
                $query->select('ris_relserviciostransito.estudio_id')
                    ->from('ris_relserviciostransito')
                    ->where('ris_relserviciostransito.admision', '=', $admision_actual);
            })
            ->get();
        $this->relservicios = ris_relserviciostransito::where('ris_relserviciostransito.admision', '=', $admision_actual)
            ->join('estudios', 'estudios.id', '=', 'ris_relserviciostransito.estudio_id')
            ->join('ris_modalidades', 'ris_modalidades.id', '=', 'ris_relserviciostransito.modalidad_id')
            ->join('ris_salas', 'ris_salas.id', '=', 'ris_relserviciostransito.sala_id')
            ->join('ris_finalidades', 'ris_finalidades.id', '=', 'ris_relserviciostransito.finalidad_id')
            ->selectRaw("ris_relserviciostransito.id,estudios.nombre as servicio,ris_modalidades.codigo as modalidad,ris_salas.nombre as sala,ris_finalidades.nombre as finalidad")
            ->get();
    }

    public function elimarregistro(string $relservicio)
    {
        ris_relserviciostransito::where('id', $relservicio)->delete();
        $this->actuaizarserviciocombo();
    }
}
