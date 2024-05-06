<?php

namespace App\Http\Controllers\ris;

use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_estudios;
use App\Models\ris\ris_estudios;
use Illuminate\Http\Request;

class ris_estudiosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $estudios = ris_estudios::selectRaw("cups,nombre,modalidad,valor,
        case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->get();

        return view('ris.estudios.index', compact('estudios'));
    }

    public function create()
    {

        /*
        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $modalidades = ris_modalidades::where('idestado', '1')->get();
        $sedes = ris_sedes::where('idestado', '1')->get();


        return view('ris.salas.create', compact('estados', 'sedes', 'modalidades'));
        */
    }


    public function store(Storeris_estudios $request)
    {


        /*
        ris_salas::create([
            'sede_id' => $request->sede_id,
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'modalidad_id' => $request->modalidad_id,
            'aetitle' => $request->aetitle,
            'idestado' => $request->idestado
        ]);


        notify()->success('Sala Creada', 'Confirmacion');
        return redirect()->route('rissalas.create');
        */
    }


    public function edit(ris_estudios $sala)
    {
        /*
        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $sedes = ris_sedes::where('idestado', '1')->get();
        $modalidades = ris_modalidades::get();

        return view('ris.salas.edit', compact('sala', 'sedes', 'estados', 'modalidades'));
        */
    }
    public function update(Storeris_estudios $request, ris_estudios $sala)
    {

        $sala->update($request->all());
        notify()->success('Sala Actualizada', 'Confirmacion');
        return redirect()->route('rissalas.edit', compact('sala'));
    }
}
