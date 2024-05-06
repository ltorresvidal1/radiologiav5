<?php

namespace App\Http\Controllers\ris;

use notify;
use App\Models\ris\transito;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\ris\ris_pacientes;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\desplegables\Desplegables;
use App\Http\Requests\ris\Storeris_pacientes;
use App\Models\ris\ris_soportes;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_pacientesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $pacientes = ris_pacientes::selectRaw("ris_pacientes.id,documento,
            concat(primernombre,' ',segundonombre,' ',primerapellido,' ',segundoapellido)as nombre,
            fechanacimiento,
            concat(date_part('year',age( CAST (fechanacimiento AS date ))),' años ',
             date_part('month',age( CAST (fechanacimiento AS date ))),' meses ',
            date_part('day',age( CAST (fechanacimiento AS date ))),' dias ') as edad
            
            ,ris_pacientes.celular as celular")
            ->get();

        return view('ris.pacientes.index', compact('pacientes'));
    }


    public function create()
    {

        $fechaactual = Carbon::now()->setTimezone('America/Bogota');
        $tipoid = Desplegables::where('ventana', 'tipodocumento')->where('estado', '1')->get();
        $sexos = Desplegables::where('ventana', 'genero')->where('estado', '1')->get();

        return view('ris.pacientes.create', compact('tipoid', 'sexos', 'fechaactual'));
    }


    public function store(Storeris_pacientes $request)
    {

        ris_pacientes::create([
            'idtipoid' => $request->idtipoid,
            'documento' => $request->documento,
            'primernombre' => $request->primernombre,
            'segundonombre' => $request->segundonombre,
            'primerapellido' => $request->primerapellido,
            'segundoapellido' => $request->segundoapellido,
            'fechanacimiento' => $request->fechanacimiento,
            'idsexo' => $request->idsexo,
            'direccion' => $request->direccion,
            'barrio' => $request->barrio,
            'celular' => $request->celular,
            'telefonow' => $request->telefono,
            'correo' => $request->correo,
            'idestado' => '1'
        ]);


        notify()->success('Paciente Creado', 'Confirmacion');
        return redirect()->route('rispacientes.create');
    }

    public function edit(ris_pacientes $paciente)
    {
        $fechaactual = Carbon::now()->setTimezone('America/Bogota');
        $tipoid = Desplegables::where('ventana', 'tipodocumento')->where('estado', '1')->get();
        $sexos = Desplegables::where('ventana', 'genero')->where('estado', '1')->get();

        return view('ris.pacientes.edit', compact('paciente', 'tipoid', 'sexos', 'fechaactual'));
    }
    public function update(Storeris_pacientes $request, ris_pacientes $paciente)
    {



        $paciente->update($request->all());

        notify()->success('Paciente Actualizado', 'Confirmacion');

        return redirect()->route('rispacientes.edit', compact('paciente'));
    }

    public function destroy(ris_pacientes $paciente)
    {


        $paciente->delete();

        notify()->success('Paciente Eliminado', 'Confirmacion');
        return redirect()->route('rispacientes.index');
    }

    public function buscarpacientes()
    {


        $fechaactual = Carbon::now()->setTimezone('America/Bogota');

        return view('ris.pacientes.buscar', compact('fechaactual'));
    }

    public function atencionimediata()
    {

        $tansitos = transito::where('transito.idestado', '=', '0')
            ->join('ris_pacientes', 'ris_pacientes.id', '=', 'transito.paciente_id')
            ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
            ->selectRaw("transito.id,concat(ris_pacientes.documento,' - ',ris_pacientes.primernombre,' ',ris_pacientes.segundonombre,' ',ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as nombre,
            estudios.nombre as estudio,transito.admision,transito.fecha")
            ->distinct()
            ->get();

        return view('ris.atencioninmediata.index', compact('tansitos'));
    }
    public function verificarsoporte($admision, $archivo)
    {

        $ruta = storage_path('app/public/soportes/' . $admision . '/' . $archivo);
        if (file_exists($ruta)) {
            $url = asset('storage/soportes/' . $admision . '/' . $archivo);
            return response()->json(['existe' => true, 'url' => $url]);
        } else {
            return response()->json(['existe' => false]);
        }
    }


    public function guardarsoportes(Request $request)
    {

        $user = Auth::user();
        if ($request->isMethod('POST')) {

            $file1 = $request->file('filehistoria');
            $file2 = $request->file('fileordenmedica');
            $file3 = $request->file('fileconsentimiento');
            $file4 = $request->file('fileverificacion');

            if ($file1 != null) {
                $file1->storeAs('soportes/' . $request->admision, 'historia_clinica' . "." . $file1->extension(), 'public');
                // ris_soportes::create(['admision' => $request->admision, 'user_id' =>  $user->idusuario, 'soporte' => 'historia_clinica', 'url' =>  'soportes/' . $request->admision . '/historia_clinica.pdf',]);
            }

            if ($file2 != null) {
                $file2->storeAs('soportes/' . $request->admision, 'orden_medica' . "." . $file2->extension(), 'public');
                //    ris_soportes::create(['admision' => $request->admision, 'user_id' =>  $user->idusuario, 'soporte' => 'orden_medica', 'url' =>  'soportes/' . $request->admision . '/orden_medica.pdf',]);
            }

            if ($file3 != null) {
                $file3->storeAs('soportes/' . $request->admision, 'consenticonsentimiento_informado' . "." . $file3->extension(), 'public');
                //  ris_soportes::create(['admision' => $request->admision, 'user_id' =>  $user->idusuario, 'soporte' => 'consenticonsentimiento_informado', 'url' =>  'soportes/' . $request->admision . '/consenticonsentimiento_informado.pdf',]);
            }

            if ($file4 != null) {
                $file4->storeAs('soportes/' . $request->admision, 'verificacion_derechos' . "." . $file4->extension(), 'public');
                //ris_soportes::create(['admision' => $request->admision, 'user_id' =>  $user->idusuario, 'soporte' => 'verificacion_derechos', 'url' =>  'soportes/' . $request->admision . '/verificacion_derechos.pdf',]);
            }
        }
    }
}
