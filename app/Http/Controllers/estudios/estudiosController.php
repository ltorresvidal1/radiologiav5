<?php

namespace App\Http\Controllers\estudios;

use Carbon\Carbon;
use App\Models\pacs\study;
use App\Events\MessageSent;
use Illuminate\Http\Request;
use App\Models\lecturas\lecturas;
use App\Events\estudiodeturnoEvent;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Events\estudioporvalidarEvent;
use App\Models\usuariosclientes\Usuariosclientes;

class  estudiosController extends Controller
{
  public function __construct()
  {
    $this->middleware('auth');
  }


  public function index()
  {

    $FechaInicial = Carbon::now()->setTimezone('America/Bogota');
    $FechaFinal = Carbon::now()->setTimezone('America/Bogota');
    return view('estudios.estudioscompletadosmedico', compact('FechaInicial', 'FechaFinal'));
  }


  public function estudiosagendados()
  {
    return view('estudios.estudiosagendados');
  }

  public function estudioscompletados()
  {

    $FechaInicial = Carbon::now()->setTimezone('America/Bogota');
    $FechaFinal = Carbon::now()->setTimezone('America/Bogota');


    return view('estudios.estudioscompletados', compact('FechaInicial', 'FechaFinal'));
  }

  public function estudiosenproceso()
  {


    return view('estudios.estudiosenproceso');
  }

  public function estudiosdeturno()
  {

    return view('estudios.estudiosdeturno');
  }

  public function estudiosporvalidar()
  {

    return view('estudios.estudiosporvalidar');
  }

  public function update_validado($idestudio)
  {
    lecturas::where('study_id', '=', $idestudio)->update(['validado' => 1]);
    estudioporvalidarEvent::dispatch("actualizar");
  }

  public function update_audio($idestudio)
  {
    $user = Auth::user();
    study::where('study_iuid', '=', $idestudio)->increment('conaudio');
    study::where('study_iuid', '=', $idestudio)->update(['medico_id' => $user->id]);

    estudiodeturnoEvent::dispatch("actualizar");
  }
}
