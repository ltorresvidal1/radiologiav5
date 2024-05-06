<?php

namespace App\Http\Livewire;

use App\Models\desplegable;
use App\Models\ris\ris_modalidades;
use App\Models\ris\ris_prioridades;
use App\Models\ris\ris_salas;
use App\Models\ris\ris_sedes;
use Livewire\Component;

class ModalFiltrossalasComponent extends Component
{


    public $salasfiltro = [];

    public function mount()
    {
        $this->salasfiltro = ris_salas::where('idestado', '=', '1')->get();
    }

    public function render()
    {
        return view('livewire.modal-filtrossalas-component');
    }
}
