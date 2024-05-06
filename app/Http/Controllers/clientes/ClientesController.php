<?php

namespace App\Http\Controllers\clientes;

use App\Http\Controllers\Controller;
use App\Http\Requests\clientes\StoreClientes;
use App\Models\clientes\Clientes;
use App\Models\desplegables\Desplegables;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ClientesController extends Controller
{

  public function __construct()
  {
    $this->middleware('permisoadministrador');
  }
  public function index()
  {

    $clientes = Clientes::paginate();
    return view('clientes.index', compact('clientes'));
  }

  public function create()
  {
    $desplegables = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
    return view('clientes.create', compact('desplegables'));
  }

  public function store(StoreClientes $request)
  {


    Clientes::create([
      'nit' => $request->nit,
      'nombre' => Str::upper($request->nombre),
      'direccion' => Str::upper($request->direccion),
      'telefono' => $request->telefono,
      'correo' => $request->correo,
      'logo' => $request->logo,
      'fechainicial' => $request->fechainicial,
      'fechafinal' => $request->fechafinal,
      'idestado' => $request->idestado
    ]);


    notify()->success('Cliente Creado', 'Confirmacion');
    return redirect()->route('clientes.create');
  }


  public function edit(Clientes $cliente)
  {
    $desplegables = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
    return view('clientes.edit', compact('cliente', 'desplegables'));
  }
  public function update(StoreClientes $request, Clientes $cliente)
  {

    $cliente->update($request->all());
    notify()->success('Cliente Actualizado', 'Confirmacion');
    return redirect()->route('clientes.edit', compact('cliente'));
  }
  public function destroy(Clientes $cliente)
  {

    $cliente->delete();
    notify()->success('Cliente Eliminado', 'Confirmacion');

    return redirect()->route('clientes.index');
  }
}
