<?php

namespace App\Http\Livewire;

use Livewire\Component;

class RisReproductorComponent extends Component
{
    public $idestudio, $idreproductor;

    public function mount($estudio, $reproductor)
    {
        $this->idestudio = $estudio;
        $this->idreproductor = $reproductor;
    }
    public function eliminargrabacion()
    {

        dd("eliminando");
        //   $this->idestudio = $estudio;
        //   $this->idreproductor = $reproductor;
    }


    public function render()
    {
        return view('livewire.ris-reproductor-component');
    }
}
