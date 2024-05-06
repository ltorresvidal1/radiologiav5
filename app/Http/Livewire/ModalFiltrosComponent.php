<?php

namespace App\Http\Livewire;

use App\Models\desplegable;
use App\Models\ris\ris_modalidades;
use App\Models\ris\ris_prioridades;
use App\Models\ris\ris_salas;
use App\Models\ris\ris_sedes;
use Livewire\Component;

class ModalFiltrosComponent extends Component
{


    public $sedes = [], $salas = [], $prioridades = [], $modalidades = [];

    public function mount()
    {
        $this->sedes = ris_sedes::where('idestado', '=', '1')->get();
        $this->salas = ris_salas::where('idestado', '=', '1')->get();

        $this->modalidades = ris_modalidades::where('idestado', '=', '1')->get();
        $this->prioridades = ris_prioridades::where('idestado', '=', '1')->orderBy('id', 'desc')->get();
    }

    public function render()
    {
        return view('livewire.modal-filtros-component');
    }
}
