@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">
		<link href="/assets/js/plugins/summernote/css/summernote-lite.css" rel="stylesheet" />
        
        
@endpush


@extends('layouts.plantillaEstudios', [
  'appTopNav' => true,
  'appClass' => 'app-with-top-nav app-without-sidebar'
])

@section('title','RADIOLOGIA')
@section('tituloformulario','Estudios agendados')



@section('content')

<div class="row">	


<div class="row">            
    <table id="tabletab4" class="table table-striped table-bordered table-condensed" style="width:100%" >
        <thead>
            <tr>
                <th>Id Estudio</th>
                <th>Fecha Estudio</th> 
                <th></th>
                <th><h6>Paciente</h6> <small>Nombre, identificación, sexo</small></th>
                <th>Sexo</th>
                <th>Administradora</th>
                <th>Estudio</th>
                <th>Modalidad</th>
                <th>Prioridad</th>
                <th>Acciones</th>                                                     
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>       
</div>

@livewire('modal-filtros-component')     
                                    
@endsection


@push('scripts')


<script src="/assets/js/btnEventos.js"></script>
<script src="/assets/js/funcionesEstudios.js"></script>
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


  /********************************************************************************/

  
    $('#tabletab4').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
      dom: "<'row mb-3'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax: {
            url: "{{route('datatable.estudiosagendados')}}",
            data: function (d){
                d.sede=buscar_sedes,
                d.sala=buscar_salas,
                d.modalidad=buscar_modalidades,
                d.prioridad=buscar_prioridades
            }
        },
        dataType:'json',
        type: "POST",
      order: [[0, 'desc']],
      
      "columnDefs": [
            { "visible": false, "targets": 0 },
            { "visible": false, "targets": 2 },
            { "visible": false, "targets": 4},
           {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(row.sexo=="M"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:green;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-male"></i> - Masculino</small>';
                    }
                     else if(row.sexo=="F"){
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:pink;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-female"></i> - Femenino</small>';
                    }
                    else {
                return '<h6 style="font-weight: bold;">'+data+'</h6> '+
                       '<small style="font-weight: bold;">'+row.pat_id+'</small> <br>'+
                       '<small style="color:red;font-weight: bold;"><i class="fas fa-lg fa-fw me-2 fa-minus-circle"></i> - Sin Diligenciar</small>';
                    }
            },
            "targets": 3
        },
        {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(data=="1"){
                return '<span class="badge bg-info text-white rounded-sm fs-12px fw-500">Baja</span>';
                 }
                 if(data=="2"){
                return '<span class="badge bg-warning text-white rounded-sm fs-12px fw-500">Media</span>';
                 }
                 if(data=="3"){
                return '<span class="badge bg-danger text-white rounded-sm fs-12px fw-500">Alta</span>';
                 }
            },
            "targets": 8
        }
        ],
        columns:[
         {data:'study_pk',orderable:false},
         {data:'fecha',orderable:false},
         {data:'pat_id',orderable:false},
         {data:'nombre',orderable:false},
         {data:'sexo',orderable:false},
         {data:'administradora',orderable:false},
         {data:'estudio',orderable:false},
         {data:'modalidad',orderable:false},
         {data:'prioridad',orderable:false},
         {data:'action',orderable:false},
          ]
          ,
      info:false,
      buttons: [ {title: 'Estudios', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
      exportOptions: {columns: [1,2,3] }}],
     
    });  
  

function actulizar_filtros() {
    $('#tabletab4').DataTable().ajax.reload();
}
</script>

{{-- @vite('resources/js/app.js') --}}

<script type="module">
/*
    Echo.channel('escuchandoestudiosporvalidar').listen('estudioporvalidarEvent',(e) => {
        console.log("estudioporvalidarEvent"+e.message);
         if(e.message=="actualizar"){
          $('#tabletab4').DataTable().ajax.reload();
         }
         
      });
*/
  </script>

@endpush
