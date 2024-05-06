<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_salas;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_modalidades;
use App\Models\ris\ris_salas;
use App\Models\ris\ris_sedes;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_salasController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {


        $salas = ris_salas::join('ris_sedes', 'ris_sedes.id', 'ris_salas.sede_id')
            ->join('ris_modalidades', 'ris_modalidades.id', 'ris_salas.modalidad_id')
            ->selectRaw("ris_salas.id,ris_salas.codigo,ris_salas.nombre,ris_sedes.nombre as sede,ris_modalidades.codigo as modalidad,case when ris_salas.idestado='2' then 'Inactivo' when ris_salas.idestado='1' then 'Activo' end estado")
            ->paginate();

        return view('ris.salas.index', compact('salas'));
    }

    public function create()
    {


        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $modalidades = ris_modalidades::where('idestado', '1')->get();
        $sedes = ris_sedes::where('idestado', '1')->get();


        return view('ris.salas.create', compact('estados', 'sedes', 'modalidades'));
    }


    public function store(Storeris_salas $request)
    {



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
    }


    public function edit(ris_salas $sala)
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $sedes = ris_sedes::where('idestado', '1')->get();
        $modalidades = ris_modalidades::get();

        return view('ris.salas.edit', compact('sala', 'sedes', 'estados', 'modalidades'));
    }
    public function update(Storeris_salas $request, ris_salas $sala)
    {

        $sala->update($request->all());
        notify()->success('Sala Actualizada', 'Confirmacion');
        return redirect()->route('rissalas.edit', compact('sala'));
    }


    public function destroy(ris_salas $sala)
    {


        $sala->delete();

        notify()->success('Sada Eliminada', 'Confirmacion');
        return redirect()->route('rissalas.index');
    }
}
