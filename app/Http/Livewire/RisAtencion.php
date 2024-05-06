<?php

namespace App\Http\Livewire;

use App\Models\clientes\Clientes;
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
use Aranyasen\HL7\Message;
use Aranyasen\HL7\Connection;
use Illuminate\Support\Facades\Auth;
use App\Models\ris\medicosremitentes;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_agendados;
use App\Models\ris\ris_hl7generados;
use App\Models\ris\ris_relserviciostransito;
use App\Models\ris\ris_soportes;
use App\Models\usuariosclientes\Usuariosclientes;

class RisAtencion extends Component
{
    use WithFileUploads;
    protected $listeners = ['elimarregistro', 'addatencion', 'cerrarmodal', 'buscarSalas'];
    public $paciente = [], $medicos = [], $convenios = [], $prioridades = [], $procedencias = [], $medicosremintentes = [], $servicios = [];
    public $transitos = [], $tipoid = [], $sexos = [], $finalidades = [], $modalidades = [], $salas = [];
    public $fechaactual, $fechaservicio, $idtransito, $idadmision, $idpaciente, $idmedico, $idconvenio, $idprioridad, $idprocedencia, $idmedicoremintente, $idservicio;
    public $idfinalidad, $idmodalidad, $idsala, $cie10;
    public $relservicios = [];
    public $activeForm, $idusuario;

    public $idtipoid, $documento, $primernombre, $segundonombre, $primerapellido, $segundoapellido, $fechanacimiento, $idsexo, $correo, $direccion, $barrio, $celular, $telefono;
    public $filehistoria = null, $fileordenmedica = null, $fileconsentimiento = null, $fileverificacion = null;

    public $buscarSalas;

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

    public function buscarSalas($buscar_salas)
    {
        $this->buscarSalas = $buscar_salas;


        $this->transitos =  transito::where('transito.idestado', '=', '0')
            ->whereNotIn('transito.admision', function ($query) {
                $query->select('ris_agendados.admision')->from('ris_agendados');
            })
            ->whereIn('ris_salas.codigo',  $this->buscarSalas)
            ->join('ris_pacientes', 'ris_pacientes.id', '=', 'transito.paciente_id')
            ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
            ->join('ris_modalidades', 'ris_modalidades.codigo', '=', 'estudios.modalidad')
            ->join('ris_salas', 'ris_salas.modalidad_id', '=', 'ris_modalidades.id')
            ->selectRaw("transito.id,ris_pacientes.id as idpaciente, concat(ris_pacientes.documento,' - ',ris_pacientes.primernombre,' ',ris_pacientes.segundonombre,' ',ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as nombre,
estudios.nombre as estudio,transito.admision,transito.fecha,ris_pacientes.documento,transito.medico_id as medico,
CAST(transito.procedencia AS INT) as prioridad,transito.procedencia,transito.convenio_id") // Agregar ris_pacientes.documento a la lista SELECT
            ->distinct()
            ->get();
        $this->dispatchBrowserEvent('actalizar-tabla');

        $this->actuaizarserviciocombo();
    }
    public function cerrarmodal()
    {

        $this->dispatchBrowserEvent('close-modal');

        //$this->dispatchBrowserEvent('destruir-tabla');
        $this->dispatchBrowserEvent('actalizar-tabla');

        $this->transitos =  transito::where('transito.idestado', '=', '0')
            ->whereNotIn('transito.admision', function ($query) {
                $query->select('ris_agendados.admision')->from('ris_agendados');
            })
            ->whereIn('ris_salas.codigo',  $this->buscarSalas)
            ->join('ris_pacientes', 'ris_pacientes.id', '=', 'transito.paciente_id')
            ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
            ->join('ris_modalidades', 'ris_modalidades.codigo', '=', 'estudios.modalidad')
            ->join('ris_salas', 'ris_salas.modalidad_id', '=', 'ris_modalidades.id')
            ->selectRaw("transito.id,ris_pacientes.id as idpaciente, concat(ris_pacientes.documento,' - ',ris_pacientes.primernombre,' ',ris_pacientes.segundonombre,' ',ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as nombre,
estudios.nombre as estudio,transito.admision,transito.fecha,ris_pacientes.documento,transito.medico_id as medico,
CAST(transito.procedencia AS INT) as prioridad,transito.procedencia,transito.convenio_id") // Agregar ris_pacientes.documento a la lista SELECT
            ->distinct()
            ->get();


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
        $this->filehistoria->storeAs('soportes/' . $this->idadmision, 'historia_clinica.pdf', 'public');


        ris_soportes::create([
            'admision' =>  $this->idadmision,
            'user_id' =>  $this->idusuario,
            'soporte' => 'historia_clinica',
            'url' =>  'soportes/' . $this->idadmision . '/historia_clinica.pdf',
            'pdf' =>  $this->filehistoria->get()
        ]);
    }
    public function cargarfileordenmedica()
    {
        $this->actuaizarserviciocombo();
    }
    public function updatedFileordenmedica()
    {
        $this->actuaizarserviciocombo();
        $this->fileordenmedica->storeAs('soportes/' . $this->idadmision, 'orden_medica.pdf', 'public');
        ris_soportes::create([
            'admision' =>  $this->idadmision,
            'user_id' =>  $this->idusuario,
            'soporte' =>  'orden_medica',
            'url' =>  'soportes/' . $this->idadmision . '/orden_medica.pdf',
        ]);
    }
    public function cargarfileconsentimiento()
    {
        $this->actuaizarserviciocombo();
    }
    public function updatedFileconsentimiento()
    {
        $this->actuaizarserviciocombo();
        $this->fileconsentimiento->storeAs('soportes/' . $this->idadmision, 'consentimiento_informado.pdf', 'public');
        ris_soportes::create([
            'admision' =>  $this->idadmision,
            'user_id' =>  $this->idusuario,
            'soporte' =>  'consentimiento_informado',
            'url' =>  'soportes/' . $this->idadmision . '/consentimiento_informado.pdf',
        ]);
    }
    public function cargarfileverificacion()
    {
        $this->actuaizarserviciocombo();
    }
    public function updatedFileverificacion()
    {
        $this->actuaizarserviciocombo();
        $this->fileverificacion->storeAs('soportes/' . $this->idadmision, 'verificacion_derechos.pdf', 'public');
        ris_soportes::create([
            'admision' =>  $this->idadmision,
            'user_id' =>  $this->idusuario,
            'soporte' =>  'verificacion_derechos',
            'url' =>  'soportes/' . $this->idadmision . '/verificacion_derechos.pdf',
        ]);
    }

    public function mount()
    {
        $this->transitos = transito::where('transito.idestado', '=', '0')
            ->whereNotIn('transito.admision', function ($query) {
                $query->select('ris_agendados.admision')->from('ris_agendados');
            })
            ->join('ris_pacientes', 'ris_pacientes.id', '=', 'transito.paciente_id')
            ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
            ->selectRaw("transito.id,ris_pacientes.id as idpaciente, concat(ris_pacientes.documento,' - ',ris_pacientes.primernombre,' ',ris_pacientes.segundonombre,' ',ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as nombre,
    estudios.nombre as estudio,transito.admision,transito.fecha,ris_pacientes.documento,transito.medico_id as medico,
    CAST(transito.procedencia AS INT) as prioridad,transito.procedencia,transito.convenio_id") // Agregar ris_pacientes.documento a la lista SELECT
            ->distinct()
            ->get();


        $this->modalidades = collect();
        $this->salas = collect();

        $user = Auth::user();
        $this->idusuario = $user->id;

        $this->actuaizarserviciocombo();
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

    public function addatencion(string $transitoid, string $fecha, string $pacienteid, string $admisionid, string $medicoid, string $prioridadid, string $procedenciaid, string $administradoraid)
    {

        $this->idtransito = $transitoid;
        $this->idadmision = $admisionid;
        $this->idpaciente = $pacienteid;
        $this->idmedico = $medicoid;
        $this->idconvenio = $administradoraid;
        $this->idprioridad = $prioridadid;
        $this->idprocedencia = $procedenciaid;
        $this->idfinalidad = 1;
        $this->fechaservicio = $fecha;
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


        $ip = '192.168.1.23';
        $port = '2575';

        $this->activeForm = 'atencion';
        $this->actuaizarserviciocombo();
        $this->validate();

        $paciente = ris_pacientes::where('ris_pacientes.id', $this->idpaciente)
            ->where('dtipo.ventana', 'tipodocumento')
            ->where('dsexo.ventana', 'genero')
            ->join('desplegables as dtipo', 'dtipo.id', '=', 'ris_pacientes.idtipoid')
            ->join('desplegables as dsexo', 'dsexo.id', '=', 'ris_pacientes.idsexo')
            ->selectRaw("ris_pacientes.documento,dtipo.nombre as tipoid,concat(ris_pacientes.primernombre,' ',ris_pacientes.segundonombre) as nombres_paciente,
            concat(ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as apellidos_paciente,ris_pacientes.fechanacimiento,ris_pacientes.direccion,
            ris_pacientes.celular,ris_pacientes.telefono,SUBSTRING(dsexo.nombre ,0,2) as tiposexo")
            ->first();

        $empresa = Clientes::first();
        $fechanaci = str_replace('-', '', $paciente->fechanacimiento);

        $doctor = Medicos::where('id', $this->idmedico)->first();
        $administradora = ris_convenios::where('id', $this->idconvenio)->first();
        $fechaactual = Carbon::now()->setTimezone('America/Bogota');


        foreach ($this->relservicios as $servicio) {

            $hora = $fechaactual->format('His');
            $fechaaorden = str_replace('-', '', $this->fechaservicio) . $hora;

            $numero_orden = $fechaactual->format('Ymdu');


            $message = new Message("MSH|^~\\&|SIOS|SYSNET|Hunab|Hunab|" . $fechaaorden . "||ORM^O01|" . $numero_orden . "|P|2.5||||||\rPID|||" . $paciente->documento . "^" . $paciente->tipoid . "||" . $paciente->apellidos_paciente . "^" . $paciente->nombres_paciente . "||" . $fechanaci . "|" . $paciente->tiposexo . "|||" . $paciente->direccion . "|||" . $paciente->celular . "|||||\rPV1||I|Imágenes Diagnósticas|||||||||||||||||||||||||||||||||||||||||" . $fechaaorden . "|\rORC|NW|" . $empresa->nit . "^" . $empresa->nombre . "||311|SC||^^^" . $fechaaorden . "^" . $fechaaorden . "^1|||||" . $doctor->documento . "^" . $doctor->nombre . "||||||||||" . $administradora->nit . "^" . $administradora->nombre . "|||\rOBR||^" . $empresa->nit . "^" . $empresa->nombre . "||" . $servicio->servicio . "|" . $this->idprioridad . "|||||||||||" . $this->idprocedencia . "||" . $numero_orden . "||||||" . $servicio->modalidad . "|||||||\r");
            $message->toString(true);


            $connection = new Connection($ip, $port);
            $response = $connection->send($message);
            $response->toString(true);
            $respuesta = $response->getSegmentByIndex(1)->getField(1);

            if ($respuesta == 'AA') {

                ris_agendados::create([
                    'serviciotransito_id' => $servicio->id,
                    'administradora' =>  $administradora->nombre,
                    'admision' => $this->idadmision,
                    'numero_orden' => $numero_orden,
                    'medico_id' =>  $this->idmedico,
                    'medicoremintente_id' =>  $this->idmedicoremintente,
                    'cie10' =>  $this->cie10,
                    'prioridad_id' =>  $this->idprioridad,
                    'procedencia_id' =>  $this->idprocedencia,
                ]);



                /*
                ris_hl7generados::create([
                    'fecha_orden' =>  $fechaaorden,
                    'numero_examen' =>   $numero_orden,
                    'identificacion_paciente' => $paciente->documento,
                    'tipo_id_paciente' => $paciente->tipoid,
                    'apellidos_paciente' => $paciente->apellidos_paciente,
                    'nombres_paciente' => $paciente->nombres_paciente,
                    'fechanacimiento_paciente' => $paciente->fechanacimiento,
                    'sexo_paciente' => $paciente->tiposexo,
                    'direccion_paciente' => $paciente->direccion,
                    'ciudad_paciente' => '',
                    'municipio_paciente' => '',
                    'departamento_paciente' => '',
                    'pais_paciente' => '',
                    'telefono_paciente' => $paciente->telefono,
                    'celular_paciente' => $paciente->celular,
                    'unidad_funcional' => '',
                    'fecha_admision' =>   $fechaaorden,
                    'nit_empresa' => $empresa->nit,
                    'nombre_empresa' => $empresa->nombre,
                    'numero_orden' =>    $numero_orden,
                    'fecha_inicio' => $fechaaorden,
                    'fecha_finalizacion' => $fechaaorden,
                    'usuario_doctor' => '',
                    'codigo_doctor' => $doctor->documento,
                    'apellido_doctor' => '',
                    'nombre_doctor' => $doctor->nombre,
                    'sala' => $servicio->sala,
                    'puesto_atencion' => '1',
                    'nit_administradora' => $administradora->nit,
                    'nombre_administradora' => $administradora->nombre,
                    'cups' => '',
                    'nombre_cups' => $servicio->servicio,
                    'procedencia' => $this->idprocedencia,
                    'modalidad' => $servicio->modalidad,
                    'message' => $message->toString(true)
                ]);
            */
            }
        }



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
            ->selectRaw("estudios.id,estudios.cups,estudios.nombre")
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
            ->selectRaw("estudios.id,estudios.cups,estudios.nombre")
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
