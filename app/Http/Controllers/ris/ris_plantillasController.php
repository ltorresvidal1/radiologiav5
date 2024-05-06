<?php

namespace App\Http\Controllers\ris;

use Illuminate\Http\Request;
use App\Models\medicos\Medicos;
use App\Models\ris\ris_plantillas;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_relplantillaradiologo;
use App\Http\Requests\ris\Storeris_plantillas;
use App\Models\usuariosclientes\Usuariosclientes;

class ris_plantillasController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {

        return view('ris.plantillas.index');
    }

    public function create()
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.plantillas.create', compact('estados'));
    }


    public function store(Storeris_plantillas $request)
    {

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();



        ris_plantillas::create([
            'nombre' => $request->nombre,
            'plantilla' => $request->plantilla,
            'idestado' => $request->idestado

        ]);


        notify()->success('Plantilla Creada', 'Confirmacion');
        return redirect()->route('risplantillas.create');
    }


    public function edit(ris_plantillas $plantilla)
    {

        $estados = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('ris.plantillas.edit', compact('plantilla', 'estados'));
    }
    public function update(Storeris_plantillas $request, ris_plantillas $plantilla)
    {



        $plantilla->update($request->all());


        notify()->success('Plantilla Actualizada', 'Confirmacion');
        return redirect()->route('risplantillas.edit', compact('plantilla'));
    }


    public function destroy(ris_plantillas $plantilla)
    {


        $plantilla->delete();

        notify()->success('Plantilla Eliminada', 'Confirmacion');
        return redirect()->route('risplantillas.index');
    }


    public function plantillascargar($idplantilla)
    {

        $plantillas = ris_plantillas::where('id', '=', $idplantilla)->first();
        return $plantillas->plantilla;
    }
}
