<?php

namespace App\Jobs;

use App\Models\ris\ris_citas;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class crearprogramacion implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected  $idsede, $idsala, $fechainicial, $horainicial, $fechafinal, $horafinal, $dias;
    /**
     * Create a new job instance.
     */
    public function __construct($idsede, $idsala, $fechainicial, $horainicial, $fechafinal, $horafinal, $dias)
    {

        $this->idsede = $idsede;
        $this->idsala = $idsala;
        $this->fechainicial = $fechainicial;
        $this->horainicial = $horainicial;
        $this->fechafinal = $fechafinal;
        $this->horafinal = $horafinal;
        $this->dias = $dias;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $tiempoInicio = strtotime($this->fechainicial);
        $tiempoFin = strtotime($this->fechafinal);
        $dia = 86400;
        $minutos = 600;




        while ($tiempoInicio <= $tiempoFin) {
            $var = date("w", $tiempoInicio);


            $horaInicio = strtotime($this->horainicial);
            $horaFin = strtotime($this->horafinal);

            for ($i = 0; $i < count($this->dias); $i++) {

                if ($var == $this->dias[$i]) {

                    while ($horaInicio <= $horaFin) {

                        $fecha = date('Y-m-d', $tiempoInicio);

                        if (date('A', $horaInicio) == 'PM') {
                            $turno = date('g:i A', $horaInicio);
                        } else {
                            $turno = date('h:i A', $horaInicio);
                        }

                        ris_citas::create([

                            'sede_id' => $this->idsede,
                            'sala_id' => $this->idsala,
                            'fecha' => $fecha,
                            'hora' =>  $turno,


                        ]);
                        $horaInicio += $minutos;
                    }
                }
            }

            $tiempoInicio += $dia;
        }
    }
}
