<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\medicos\Medicos;
use App\Models\ris\ris_plantillas;
use App\Models\ris\ris_relplantillaradiologo;
use Illuminate\Support\Facades\Auth;
use App\Models\usuariosclientes\Usuariosclientes;

class RisRelplantillasradiologos extends Component
{
    protected $listeners = ['elimarregistro', 'addradiologo'];
    public $idplantilla, $idradiologo;
    public $radiologos = [];
    public $plantillas = [];
    public $relplantillas = [];

    protected function rules()
    {
        return [
            'idradiologo' => ['required'],
        ];
    }
    public function mount()
    {

        $this->plantillas =  ris_plantillas::selectRaw("id,nombre,case when idestado='2' then 'Inactivo' when idestado='1' then 'Activo' end estado")
            ->get();
    }

    public function elimarregistro(string $relplantilla)
    {
        ris_relplantillaradiologo::where('id', $relplantilla)->delete();
        $this->actuaizarcombo();
    }
    public function addradiologo(string $plantillaid)
    {
        $this->idplantilla = $plantillaid;

        $this->actuaizarcombo();
        $this->dispatchBrowserEvent('show-modal');

        // $this->dispatchBrowserEvent('buscaragenda');
        //   ris_relplantillaradiologo::where('id', $relplantilla)->delete();
        //     $this->actuaizarcombo();
    }
    public function store()
    {

        $this->validate();
        ris_relplantillaradiologo::create([
            'plantilla_id' => $this->idplantilla,
            'medico_id' => $this->idradiologo
        ]);
        $this->actuaizarcombo();
        $this->idradiologo = "";
    }

    public function render()
    {
        return view('livewire.ris-relplantillasradiologos');
        /*
        return view(
            'livewire.ris-relplantillasradiologos',
            ['relplantillas' => ris_relplantillaradiologo::where('plantilla_id', $this->idplantilla)
                ->join('medicos', 'medicos.id', 'ris_relplantillasradiologos.medico_id')
                ->selectRaw('ris_relplantillasradiologos.id as id,medicos.nombre as nombre')
                ->get()]
        );*/
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
        $this->relplantillas = ris_relplantillaradiologo::where('plantilla_id', $this->idplantilla)
            ->join('medicos', 'medicos.id', 'ris_relplantillasradiologos.medico_id')
            ->selectRaw('ris_relplantillasradiologos.id as id,medicos.nombre as nombre')
            ->get();
    }
}
