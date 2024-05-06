<?php

namespace App\Http\Livewire;

use App\Models\ris\ris_citas;
use App\Models\ris\ris_pacientes;
use App\Models\ris\ris_salas;
use App\Models\ris\ris_sedes;
use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use App\Models\usuariosclientes\Usuariosclientes;
use Illuminate\Cache\RateLimiting\Limit;

class RisCitas extends Component
{
    public  $sede, $sala;
    public $sedes = [], $salas = [], $estados = [], $eventos;
    protected $listeners = ['buscaragenda'];

    public $search;
    public $searchResults = [];
    public $pacienteencontrado = 0;

    public function buscar_p()
    {


        $this->pacienteencontrado = ris_pacientes::where('documento', 'like', '%' . $this->search . '%')->count();

        if ($this->pacienteencontrado == 0) {
            $this->dispatchBrowserEvent('paciente-no-encontrado');
        } else {
            $this->dispatchBrowserEvent('paciente-encontrado');
        }
    }

    public function updatedSearch($value)
    {


        //  dump($this->buscadordocumentoresultado);
    }

    public function mount()
    {
        $this->sedes = ris_sedes::get();
        $this->salas = collect();
        //$this->estados =  Desplegables::where('ventana', 'estados')->where('estado', '1')->get();
        //$this->fechaactual = Carbon::now()->setTimezone('America/Bogota');
        //$this->horainicial = "07:00";
        //$this->horafinal = "18:00";
    }
    public function updatedSede($value)
    {
        $this->salas = ris_salas::where('idestado', '1')->where('sede_id', $value)->get();
        $this->sala = $this->salas->first()->id ?? null;
        $this->dispatchBrowserEvent('buscaragenda');
    }


    public function getEvents()
    {
        // $startDate = '2023-07-01';
        //$endDate = '2023-07-30';

        // $events = Cache::remember('user-events-' . auth()->id() . '-' . base64_encode($startDate.$endDate), now()->addHour(), function() use ($startDate, $endDate){
        $events = [];

        // add other events
        $eventos = ris_citas::where('sede_id',  $this->sede)
            ->leftjoin('ris_pacientes', 'ris_pacientes.id', 'ris_citas.paciente_id')
            ->selectRaw("CASE WHEN ris_citas.paciente_id is null then 'Turno disponible' 
            else  concat(ris_pacientes.documento,' ',ris_pacientes.primernombre,' ',ris_pacientes.primerapellido,' - Tel: ',ris_pacientes.celular)
           END datospaciente,fecha , hora as horainicial,hora+'00:10:00' as horafinal")
            //->limit(1)
            ->get();



        foreach ($eventos as $global_event) {
            //  dd($global_event->id);
            $event = [
                //'id' => $global_event->id,
                'title' => $global_event->datospaciente,
                'start' => $global_event->fecha . 'T' . $global_event->horainicial,
                'end' =>  $global_event->fecha . 'T' . $global_event->horafinal,
                'description' =>   $global_event->datospaciente,
                //'overlap' => true,
                //  'display'  => 'background',
                //    'color'  => '#0797D5'

                //'start' => $global_event->fecha->startOfDay()->format('Y-m-d'),
                //  'end' => $global_event->fecha ? $global_event->fecha->addDay()->startOfDay()->format('Y-m-d') : null,
                //  'allDay' => $global_event->allDay,
                //// 'editable' => $global_event->editable,
                //'deletable' => $global_event->created_by == auth()->id(),
                // 'backgroundColor' => $global_event->backgroundColor,
                //'extendedProps' => [
                //   'type' => 'Event',
                // 'content' => '1', // $global_event->content,
                // 'notes' => '2', //$global_event->notes,
                // 'editable' => '3', //$global_event->editable,
                //],

            ];

            $events[] = $event;
        }



        return $events;
    }

    public function render()
    {
        return view('livewire.ris-citas');
    }
}
