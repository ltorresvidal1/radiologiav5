<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Models\ris\ris_modalidades;
use App\Http\Controllers\Controller;
use App\Http\Requests\ris\Storeris_modalidades;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_modalidadesController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        $user = Auth::user();
        $idcliente = Usuariosclientes::where('user_id', '=', $user->id)
            ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
            ->select('clientes.id')
            ->first();

        $modalidades = ris_modalidades::selectRaw("id,codigo,nombre,case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->paginate();

        return view('ris.modalidades.index', compact('modalidades'));
    }

    public function create()
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.modalidades.create', compact('estados'));
    }


    public function store(Storeris_modalidades $request)
    {

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();



        ris_modalidades::create([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre,
            'idestado' => $request->idestado
        ]);


        notify()->success('Modalidad Creada', 'Confirmacion');
        return redirect()->route('rismodalidades.create');
    }


    public function edit(ris_modalidades $modalidad)
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.modalidades.edit', compact('modalidad', 'estados'));
    }
    public function update(Storeris_modalidades $request, ris_modalidades $modalidad)
    {



        $modalidad->update($request->all());

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        notify()->success('modalidad Actualizada', 'Confirmacion');

        return redirect()->route('rismodalidades.edit', compact('modalidad',  'estados'));
    }


    public function destroy(ris_modalidades $modalidad)
    {


        $modalidad->delete();

        notify()->success('Modalidad Eliminada', 'Confirmacion');
        return redirect()->route('rismodalidades.index');
    }
}
