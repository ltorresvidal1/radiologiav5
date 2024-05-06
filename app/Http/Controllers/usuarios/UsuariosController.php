<?php

namespace App\Http\Controllers\usuarios;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\perfiles\Perfiles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Flasher\Toastr\Prime\ToastrFactory;
use App\Models\desplegables\Desplegables;
use App\Http\Requests\Usuarios\StoreUsuarios;
use App\Models\usuariosclientes\Usuariosclientes;

class UsuariosController extends Controller
{


  public function __construct()
  {
    $this->middleware('auth');
  }


  public function index()
  {

    $user = Auth::user();


    $idcliente =   usuariosclientes::where('user_id', '=', $user->id)->first();

    $usuarios = User::where('users.id', '<>', '63b9aa06-9f58-4718-b9fb-eab6b5e903f0')
      ->where('clientes.id', '=', $idcliente->cliente_id)
      ->where('users.perfile_id', '>=', '4')
      ->join('usuariosclientes', 'usuariosclientes.user_id', '=', 'users.id')
      ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
      ->selectRaw("users.id,users.documento,users.nombre,users.usuario, case when users.idestado='2' then 'Inactivo' when users.idestado='1' then 'Activo' end estado")->paginate();


    return view('usuarios.index', compact('usuarios'));
  }

  public function create()
  {
    $perfiles = Perfiles::where('id', '>=', '4')->get();

    $desplegables = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
    return view('usuarios.create', compact('perfiles', 'desplegables'));
  }

  public function store(StoreUsuarios $request, ToastrFactory $msn)
  {

    $user = Auth::user();
    $idcliente =   usuariosclientes::where('user_id', '=', $user->id)->first();

    User::create([
      'documento' => $request->documento,
      'nombre' => Str::upper($request->nombre),
      'usuario' => Str::upper($request->usuario),
      'password' => Hash::make($request->password),
      'perfile_id' => $request->idperfil,
      'idestado' => $request->idestado
    ]);
    $IdUsuario = User::latest('id')->first();

    Usuariosclientes::create([
      'user_id' => $IdUsuario->id,
      'cliente_id' => $idcliente->cliente_id
    ]);

    notify()->success('Usuario Creado', 'Confirmacion');
    return redirect()->route('usuarios.create');
  }

  public function edit(User $usuario)
  {

    $perfiles = Perfiles::where('id', '>=', '4')->get();
    $desplegables = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();

    return view('usuarios.edit', compact('usuario', 'perfiles',  'desplegables'));
  }


  public function update(StoreUsuarios $request, User $usuario)
  {


    $usuario->update([
      'documento' => $request->documento,
      'nombre' => Str::upper($request->nombre),
      'usuario' => Str::upper($request->usuario),
      'perfile_id' => $request->idperfil,
      'idestado' => $request->idestado
    ]);


    notify()->success('Usuario Actualizado', 'Confirmacion');
    return redirect()->route('usuarios.edit', compact('usuario'));
  }

  public function destroy(User $usuario)
  {
    $usuario->usuarioclientes()->delete();
    $usuario->delete();

    notify()->success('Usuario Eliminado', 'Confirmacion');
    return redirect()->route('usuarios.index');
  }


  public function restablecer(User $usuario)
  {
    $usuario->update([
      'password' => Hash::make('1234567'),
    ]);


    notify()->success('Clave Actualizada', 'Confirmacion');
    return redirect()->route('usuarios.index');
  }
}
