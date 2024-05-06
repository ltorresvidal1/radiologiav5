
@push('css')
        <link href="/assets/js/plugins/chartjs2/css/chart.min.css" rel="stylesheet">
@endpush


@extends('layouts.plantillaPrincipal')
@section('title','RADIOLOGIA')
@section('tituloformulario','Tablero de Control')


<?php  $anoactual=date("Y"); ?> 

@section('content') 

    <div class="row">
        <div id="chartJsLineChart" class="mb-5">
            <div class="card">
                <div class="card-body">
                <h6>ESTUDIOS REALIZADOS POR MES AÑO <?php echo  $anoactual; ?></h6>
                
                <canvas id="lineChart" height="120"></canvas>
             
                

                </div>    
            </div>
        </div>
    </div>
    <div class="row">
   
     

        <div class="col-md-4">
            <a class="card bg-gradient-cyan-blue border-0 text-decoration-none">
                <div class="card-body d-flex align-items-center text-white">
                    <div class="flex-fill">
                        <div class="mb-1">PACIENTES</div>
                        <h2>{{ $consultapacientes }}</h2>
                    </div>
                    <div class="opacity-5">
                            <i class="fa fa-user fa-6x"></i>
                    </div>
                </div>
            </a>
        </div>  

        
     

        <div class="col-md-4">
            <a class="card bg-gradient-custom-teal border-0 text-decoration-none">
                <div class="card-body d-flex align-items-center text-white">
                    <div class="flex-fill">
                        <div class="mb-1">IMAGENES</div>
                        <h2>{{ $consultaestudios }}</h2>
                    </div>
                    <div class="opacity-5">
                            <i class="fa fa-image fa-6x"></i>
                    </div>
                </div>
            </a>
        </div>  

             

                     

        <div class="col-md-4">
            <a class="card bg-gradient-red-pink border-0 text-decoration-none">
                <div class="card-body d-flex align-items-center text-white">
                    <div class="flex-fill">
                        <div class="mb-1">DISCO</div>
                        <h2>{{ $tamanoendisco[0] }} %</h2>
                    </div>
                    <div class="opacity-5">
                            <i class="fa fa-database fa-6x"></i>
                    </div>
                </div>
            </a>
        </div>  
    

    </div>


@endsection


@push('scripts')

<script src="/assets/js/plugins/chartjs2/js/chart.min.js"></script>

<!-- script -->
<script>

    Chart.defaults.plugins.legend.display = false;

    const valores = @json($valeresmeses);
    

    var ctx = document.getElementById('lineChart');
    var lineChart = new Chart(ctx, {
      type: 'line',
      data: {
        labels: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Agos', 'Sep', 'Oct', 'Nov', 'Dic'],
        datasets: [{       
            label: 'Estudios',
            fill: !0,
            lineTension: 0,
            backgroundColor: 'rgba(0,172,255, 0.1)',
            borderWidth: 2,borderColor: '#00AAFF',
            borderCapStyle: 'butt',
            borderDash: [],
            borderDashOffset: 0,
            borderJoinStyle: 'miter',
            pointRadius: 5,
            pointBorderColor: '#00AAFF',
            pointBackgroundColor: '#fff',
            pointBorderWidth: 2,
            pointHoverRadius: 15,
            pointHoverBackgroundColor: '#fff',
            pointHoverBorderColor: '#00AAFF',
            pointHoverBorderWidth: 2,
            data: valores
        }],
    
     
      }
    });
  </script>
@endpush  

