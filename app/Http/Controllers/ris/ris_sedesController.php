<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Models\ris\ris_sedes;
use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_sedes;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_sedesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {



        $sedes = ris_sedes::selectRaw("id,codigo,nombre,case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->paginate();

        return view('ris.sedes.index', compact('sedes'));
    }

    public function create()
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.sedes.create', compact('estados'));
    }


    public function store(Storeris_sedes $request)
    {

        ris_sedes::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'idestado' => $request->idestado

        ]);


        notify()->success('Sede Creada', 'Confirmacion');
        return redirect()->route('rissedes.create');
    }


    public function edit(ris_sedes $sede)
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.sedes.edit', compact('sede', 'estados'));
    }
    public function update(Storeris_sedes $request, ris_sedes $sede)
    {



        $sede->update($request->all());

        notify()->success('Sede Actualizada', 'Confirmacion');

        return redirect()->route('rissedes.edit', compact('sede'));
    }


    public function destroy(ris_sedes $sede)
    {


        $sede->delete();

        notify()->success('Sede Eliminada', 'Confirmacion');
        return redirect()->route('rissedes.index');
    }
}
