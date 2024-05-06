<?php

namespace App\Http\Controllers\auth;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\auth\StoreAuth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('auth.login');
    }

    public function store(StoreAuth $request)
    {

        $credentials = $request->only('usuario', 'password');
        $credentials['idestado'] = 1;


        if (Auth::attempt($credentials)) {

            notify()->success('Hola Sr ' . auth()->user()->nombre, 'Bienvenido');
            return redirect()->route('principal');
        } else {
            notify()->error('Usuario o contreseña invalido');
            return back();
        }
    }
}
