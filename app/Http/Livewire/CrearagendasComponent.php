<?php

namespace App\Http\Livewire;

use App\Jobs\crearprogramacion;
use Livewire\Component;
use App\Models\ris\ris_salas;
use App\Models\ris\ris_sedes;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Models\desplegables\Desplegables;
use App\Models\ris\ris_agendas;
use App\Models\ris\ris_citas;
use Illuminate\Console\View\Components\Alert;
use App\Models\usuariosclientes\Usuariosclientes;

class CrearagendasComponent extends Component
{
    public $sede, $sala, $fechaactual, $fechainicial, $horainicial, $fechafinal, $horafinal, $estado = "1";
    public $sedes = [], $salas = [], $estados = [], $dias = [];



    protected function rules()
    {
        return [
            'sede' => ['required'],
            'sala' => ['required'],
            'fechainicial' => ['required'],
            'horainicial' => ['required'],
            'fechafinal' => ['required'],
            'horafinal' => ['required'],
            'dias' => ['required'],
        ];
    }


    public function mount()
    {
        $user = Auth::user();
        $cu = Usuariosclientes::where('user_id', '=', $user->id)->first();

        $this->sedes = ris_sedes::get();
        $this->salas = collect();
        $this->estados =  Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        $this->fechaactual = Carbon::now()->setTimezone('America/Bogota');
        $this->horainicial = "07:00";
        $this->horafinal = "18:00";
    }

    public function updatedSede($value)
    {
        $this->salas = ris_salas::where('idestado', '1')->where('sede_id', $value)->get();
        $this->sala = $this->salas->first()->id ?? null;
    }


    public function store()
    {


        $this->validate();

        ris_agendas::create([

            'sede_id' => $this->sede,
            'sala_id' => $this->sala,
            'fechainicial' => $this->fechainicial,
            'horainicial' => $this->horainicial,
            'fechafinal' => $this->fechafinal,
            'horafinal' => $this->horafinal,
            'dias' => json_encode($this->dias),
            'idestado' =>  $this->estado,

        ]);



        crearprogramacion::dispatch($this->sede, $this->sala, $this->fechainicial,  $this->horainicial, $this->fechafinal, $this->horafinal, $this->dias);

        notify()->success('Agenda Creada', 'Confirmacion');
        return redirect()->route('risagendas.create');
    }


    public function render()
    {
        return view('livewire.crearagendas-component');
    }
}
