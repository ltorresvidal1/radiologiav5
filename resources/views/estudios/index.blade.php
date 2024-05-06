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
@section('tituloformulario','Estudios')



@section('content')


<div class="row">		
    <div class="form-group col-5 m-0">		
    </div>	
    <div class="form-group col-3 m-0">
        <label class="form-label" for="fechainicial">Fecha Inicial</label>
        <input type="date" class="form-control  @error('fechainicial') is-invalid @enderror" value="{{$FechaInicial->format('Y-m-d')}}"  id="fechainicial" name="fechainicial"/>
        @error('fechainicial')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror
    </div>
    <div class="form-group col-3 m-0">
        <label class="form-label" for="fechafinal">Fecha Final</label>
        <input type="date"   @error('fechafinal') class="form-control is-invalid" @enderror
        class="form-control"  id="fechafinal" name="fechafinal"  value="{{$FechaFinal->format('Y-m-d')}}"/>
        @error('fechafinal')
        <br>
        <small>*{{$message}}</small>
        <br>
    @enderror
    </div>   
   
                                                                                       
    <div class="form-group col-1 m-0">
        <button type="button" class="btn btn-primary mb-1 btn-sm" data-bs-toggle="modal" data-bs-target="#modalSm">
            <i class="fa fa-cog"></i> Filtros
        </button>
    </div>
</div>

<br>
<div class="row">            
    <table id="tabletab1" class="table text-nowrap w-100">
        <thead>
            <tr>
                <th>Id Estudio</th>
                <th>Fecha Estudio</th> 
                <th></th>
                <th><h6>Paciente</h6> <small>Nombre, identificación, sexo</small></th>
                <th>Sexo</th>
                <th>Modalidad</th>
                <th>Prioridad</th>
                <th>Acciones</th>                                                     
            </tr>
        </thead>
        <tbody>

        </tbody>
    </table>       
</div>
</div>




<div class="modal fade" id="modalSm">
    <div class="modal-dialog modal-sm">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Opciones</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
    </div>
    <div class="modal-body">
    ...
    </div>
    </div>
    </div>
    </div>
    
                                    
@endsection


@push('scripts')

{{-- @vite('resources/js/app.js') --}}
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
    
/*
  var fechainicial = $("#fechainicial").val();
    fechainicial = fechainicial.replaceAll('-', '');

    var fechafinal = $("#fechafinal").val();
    fechafinal = fechafinal.replaceAll('-', '');
  
    $('#tabletab1').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
      dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax:"{{route('datatable.estudioscompetados',['',''])}}"+"/"+fechainicial+"/"+fechafinal,
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
        },
        {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(data=="0"){
                return '<span class="badge bg-info text-white rounded-sm fs-12px fw-500">Baja</span>';
                 }
                 if(data=="1"){
                return '<span class="badge bg-warning text-white rounded-sm fs-12px fw-500">Media</span>';
                 }
                 if(data=="2"){
                return '<span class="badge bg-danger text-white rounded-sm fs-12px fw-500">Alta</span>';
                 }
            },
            "targets": 6
        }
        ],
        columns:[
         {data:'study_pk',orderable:false},
         {data:'fecha',orderable:false},
         {data:'pat_id',orderable:false},
         {data:'nombre',orderable:false},
         {data:'sexo',orderable:false},
         {data:'modalidad',orderable:false},
         {data:'prioridad',orderable:false},
         {data:'action',orderable:false},
          ]
          ,
      info:false,
      buttons: [ {title: 'Estudios', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
      exportOptions: {columns: [1,2,3] }}],
     
    });  
  
  
  
  function actualizador(){

    var fechainicial = $("#fechainicial").val();
    fechainicial = fechainicial.replaceAll('-', '');
    var fechafinal = $("#fechafinal").val();
    fechafinal = fechafinal.replaceAll('-', '');
  

    $('#tabletab1').DataTable().ajax.url("{{route('datatable.estudioscompetados',['',''])}}"+"/"+fechainicial+"/"+fechafinal).load();

  }
  
  $("#fechainicial").change(function () {actualizador(); });
  $("#fechafinal").change(function () {actualizador(); });

 */
</script>




<script type="module">
      /*
     Echo.channel('luis').listen('MessageSent',(e) => {
       console.log(e);
    });
    */
    console.log('Mensaje recibido desde Laravel:', event);
    window.Echo.channel('mensaje').listen('MessageChannelEvent', (event) => {
    // event contiene el mensaje recibido desde el servidor
    console.log('Mensaje recibido desde Laravel:', event);
});
/*
    window.Echo.channel('Stm')
    .listen('WebSocketMessageReceived', (event) => {
        console.log('Mensaje recibido:', event.message);
        // Aquí puedes procesar el mensaje recibido en el frontend
    });*/

       /**
        * nebvU8-gotjuj-hogwij
        *luis
App\Events\MessageSent
{"message":"hola"}
        * 7KTMHT2GWLN33QUBCHZP6KZ6736GHPK3
       */
   </script>
@endpush
