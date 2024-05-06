<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\ris\transito;

class AtencioninmediataComponent extends Component
{

    protected $listeners = ['addatencion'];
    public $idtransito;
    public $paciente = [];
    public $tansitos = [];


    public function mount()
    {

        $this->tansitos = transito::where('transito.idestado', '=', '0')
            ->join('ris_pacientes', 'ris_pacientes.id', '=', 'transito.paciente_id')
            ->join('estudios', 'estudios.id', '=', 'transito.estudio_id')
            ->selectRaw("transito.id,concat(ris_pacientes.documento,' - ',ris_pacientes.primernombre,' ',ris_pacientes.segundonombre,' ',ris_pacientes.primerapellido,' ',ris_pacientes.segundoapellido) as nombre,
            estudios.nombre as estudio,transito.admision,transito.fecha")
            ->distinct()
            ->orderBy('transito.admision', 'asc')
            ->get();
    }
    public function addatencion(string $idtransito)
    {
        dd("aki");
        //$this->idtransito = $idtransito;

        $this->actuaizarcombo();
        $this->dispatchBrowserEvent('show-modal');
    }

    public function render()
    {
        return view('livewire.atencioninmediata-component');
    }



    public function actuaizarcombo()
    {
        $plantilla_actual = $this->idplantilla;

        $this->radiologos = Medicos::selectRaw('medicos.id as id,medicos.nombre as nombre')
            ->whereNotIn('medicos.id', function ($query) use ($plantilla_actual) {
                $query->select('ris_relplantillasradiologos.medico_id')
                    ->from('ris_relplantillasradiologos')
                    ->where('ris_relplantillasradiologos.plantilla_id', '=', $plantilla_actual);
            })
            ->get();
    }
}
