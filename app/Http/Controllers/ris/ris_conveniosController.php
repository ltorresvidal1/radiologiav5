<?php

namespace App\Http\Controllers\ris;

use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_convenios;
use App\Models\ris\ris_convenios;
use Illuminate\Http\Request;

class ris_conveniosController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $convenios = ris_convenios::selectRaw("codigo,nit,nombre,telefono,
        case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->get();

        return view('ris.convenios.index', compact('convenios'));
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


    public function store(Storeris_convenios $request)
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


    public function edit(ris_convenios $convenio)
    {

        /*   $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $sedes = ris_sedes::where('idestado', '1')->get();
        $modalidades = ris_modalidades::get();

        return view('ris.salas.edit', compact('sala', 'sedes', 'estados', 'modalidades'));
    */
    }
    public function update(Storeris_convenios $request, ris_convenios $convenio)
    {

        /*
        $sala->update($request->all());
        notify()->success('Sala Actualizada', 'Confirmacion');
        return redirect()->route('rissalas.edit', compact('sala'));

        */
    }
}
