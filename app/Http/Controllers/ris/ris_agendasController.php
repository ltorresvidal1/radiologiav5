<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Models\ris\ris_salas;
use App\Models\ris\ris_sedes;
use Illuminate\Support\Carbon;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Http\Requests\ris\Storeris_agendas;
use App\Models\ris\ris_agendas;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_agendasController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $agendas = ris_agendas::join('ris_sedes', 'ris_sedes.id', 'ris_agendas.sede_id')
            ->join('ris_salas', 'ris_salas.id', 'ris_agendas.sala_id')
            ->selectRaw("ris_agendas.id,
            ris_sedes.nombre as sede,
            ris_salas.nombre as sala,
            ris_agendas.fechainicial, ris_agendas.horainicial, ris_agendas.fechafinal, ris_agendas.horafinal,
            case when ris_agendas.idestado='2' then 'Inactivo' when ris_agendas.idestado='1' then 'Activo' end estado")
            ->paginate();

        return view('ris.agendas.index', compact('agendas'));
    }

    public function create()
    {
        $fechaactual = Carbon::now()->setTimezone('America/Bogota');
        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();

        $salas = ris_salas::where('idestado', '1')->get();
        return view('ris.agendas.create', compact('estados', 'salas', 'fechaactual'));
    }


    public function store(Storeris_agendas $request)
    {

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();


        /*
        ris_salas::create([
            'cliente_id' => $cu->cliente_id,
            'sede_id' => $request->sede_id,
            'nombre' => $request->nombre,
            'idestado' => $request->idestado
        ]);

*/
        notify()->success('Agenda Creada', 'Confirmacion');
        return redirect()->route('rissalas.create');
    }

    /*
    public function edit(ris_salas $sala)
    {
        $user = Auth::user();
        $idcliente = Usuariosclientes::where('user_id', '=', $user->id)
            ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
            ->select('clientes.id')
            ->first();


        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $sedes = ris_sedes::where('cliente_id', '=', $idcliente->id)->where('idestado', '1')->get();


        return view('ris.salas.edit', compact('sala', 'sedes', 'estados'));
    }
    public function update(Storeris_salas $request, ris_salas $sala)
    {



        $sala->update($request->all());

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        notify()->success('Sala Actualizada', 'Confirmacion');
        return redirect()->route('rissalas.edit', compact('sala',  'estados'));
    }


    public function destroy(ris_salas $sala)
    {


        $sala->delete();

        notify()->success('Sada Eliminada', 'Confirmacion');
        return redirect()->route('rissalas.index');
    }
    */

    public function asignarcita()
    {
        return view('ris.citas.index');
    }

    public function cargaragenda()
    {
    }
}
