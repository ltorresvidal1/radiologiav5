<?php

namespace App\Http\Controllers\medicos;

use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\medicos\Medicos;
use App\Models\perfiles\Perfiles;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\desplegables\Desplegables;
use App\Http\Requests\medicos\StoreMedicos;
use App\Models\usuariosclientes\Usuariosclientes;

class MedicosController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index()
    {



        $medicos = Medicos::join('users', 'users.documento', 'medicos.documento')
            ->join('usuariosclientes', 'usuariosclientes.user_id', '=', 'users.id')
            ->selectRaw("users.usuario,medicos.id,medicos.documento,medicos.nombre,medicos.registromedico,
            '' especialidad,case when medicos.idestado='2' then 'Inactivo' when medicos.idestado='1' then 'Activo' end estado")
            ->paginate();


        return view('medicos.index', compact('medicos'));
    }

    public function create()
    {
        $perfiles = Perfiles::where('id', '=', '3')->get();
        $desplegables = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('medicos.create', compact('perfiles', 'desplegables'));
    }

    public function store(StoreMedicos $request)
    {

        $user = Auth::user();
        $cu = usuariosclientes::where('user_id', '=', $user->id)->first();
        $codigounico = \Ramsey\Uuid\Uuid::uuid4()->toString();

        Medicos::create([
            'id' => $codigounico,
            'documento' => $request->documento,
            'nombre' => Str::upper($request->nombre),
            'registromedico' => Str::upper($request->registro),
            'firma' => $request->logo,
            'idestado' => $request->idestado
        ]);

        User::create([
            'id' => $codigounico,
            'documento' => $request->documento,
            'nombre' => Str::upper($request->nombre),
            'usuario' => Str::upper($request->usuario),
            'password' => Hash::make($request->password),
            'perfile_id' => $request->idperfil,
            'idestado' => $request->idestado
        ]);



        Usuariosclientes::create([
            'user_id' => $codigounico,
            'cliente_id' => $cu->cliente_id,
        ]);



        notify()->success('Radiologo Creado', 'Confirmacion');
        return redirect()->route('medicos.create');
    }

    public function edit(Medicos $medico)
    {
        $perfiles = Perfiles::where('id', '=', '3')->get();
        $usuario = User::where('documento', '=', $medico->documento)
            ->join('usuariosclientes', 'usuariosclientes.user_id', '=', 'users.id')
            ->select('users.usuario')
            ->first();

        $desplegables = Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        return view('medicos.edit', compact('usuario', 'medico', 'desplegables', 'perfiles'));
    }
    public function update(StoreMedicos $request, Medicos $medico)
    {



        User::where('documento', '=', $medico->documento)
            ->update([
                'documento' => $request->documento,
                'usuario' => $request->usuario, 'idestado' => $request->idestado
            ]);

        $medico->update($request->all());

        notify()->success('Radiologo Actualizado', 'Confirmacion');
        return redirect()->route('medicos.edit', compact('medico'));
    }
    public function destroy(Medicos $medico)
    {

        $medico->delete();
        notify()->success('Radiologo Eliminado', 'Confirmacion');
        return redirect()->route('medicos.index');
    }
    public function restablecer(Medicos $medico)
    {
        $user = Auth::user();


        $cliente = Usuariosclientes::where('user_id', '=', $user->id)
            ->join('clientes', 'clientes.id', '=', 'usuariosclientes.cliente_id')
            ->select('clientes.*')
            ->first();


        User::where('documento', '=',  $medico->documento)
            ->where('usuariosclientes.cliente_id', '=', $cliente->cliente_id)
            ->join('usuariosclientes', 'usuariosclientes.user_id', '=', 'users.id')
            ->update(['password' => Hash::make('123456'),]);

        notify()->success('Clave Actualizada', 'Confirmacion');
        return redirect()->route('medicos.index');
    }
}
