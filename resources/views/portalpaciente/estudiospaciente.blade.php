@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">
		<link href="/assets/js/plugins/summernote/css/summernote-lite.css" rel="stylesheet" />
        
        
@endpush


@extends('layouts.plantillaEstudiospaciente', [
  'appTopNav' => true,
  'appClass' => 'app-with-top-nav app-without-sidebar'
])

@section('title','RADIOLOGIA')
@section('tituloformulario','Estudios realizados')



@section('content')

<div id="identificacionPaciente" style="display: none;">{{ $paciente->identificacion }}</div>
<div class="row">            
    <table id="tabletab1" class="table text-nowrap w-100">
        <thead>
            <tr>
                <th>Id Estudio</th>
                <th>Fecha Estudio</th> 
                <th></th>
                <th><h6>Paciente</h6> <small>Nombre, identificación, sexo</small></th>
                <th>Sexo</th>
                <th>Estudio</th>
                <th>Acciones</th>                                                     
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>       
</div>
</div>

                                    
@endsection


@push('scripts')

<script src="/assets/js/btnEventos.js"></script>
<script src="/assets/js/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.colVis.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.print.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/assets/js/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-lite.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-es-ES.min.js"></script>



<script>
    
    var identificacion = document.getElementById('identificacionPaciente').innerText;

    $('#tabletab1').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
    searching: false,
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax: {
            url: "{{route('datatable.estudiospacientes')}}",
            data: function (d){
                d.paciente=identificacion
            }
        },
        dataType:'json',
        type: "POST",
        order: [[0, 'desc']],
      
      "columnDefs": [
            { "visible": false, "targets": 0 },
            { "visible": false, "targets": 2 },
            { "visible": false, "targets": 4 },
           {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(row.sexo=="*"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:red;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-minus-circle"></i> - Sin Diligenciar</small>';
                    }
                    if(row.sexo=="M"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:green;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-male"></i> - Masculino</small>';
                    }
                    if(row.sexo=="F"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:pink;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-female"></i> - Femenino</small>';
                    }
            },
            "targets": 3
        }
        ],
        columns:[
         {data:'study_pk',orderable:false},
         {data:'fecha',orderable:false},
         {data:'pat_id',orderable:false},
         {data:'nombre',orderable:false},
         {data:'sexo',orderable:false},
         {data:'estudio',orderable:false},
         {data:'action',orderable:false},
          ]
          ,
      info:false,
    });  
  
  
  
  function actualizador(){
    $('#tabletab1').DataTable().ajax.reload();
  }


function actulizar_filtros() {
    $('#tabletab1').DataTable().ajax.reload();
}
  

 
</script>


{{-- @vite('resources/js/app.js') --}}

@endpush
