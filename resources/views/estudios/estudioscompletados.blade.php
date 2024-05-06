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
@section('tituloformulario','Estudios completados')



@section('content')


<div class="row">		
    <div class="form-group col-8 m-0">		
    </div>	
    <div class="form-group col-2 m-0">
        <label class="form-label" for="fechainicial">Fecha Inicial</label>
        <input type="date" class="form-control  @error('fechainicial') is-invalid @enderror" value="{{$FechaInicial->format('Y-m-d')}}"  id="fechainicial" name="fechainicial"/>
        @error('fechainicial')
            <br>
            <small>*{{$message}}</small>
            <br>
        @enderror
    </div>
    <div class="form-group col-2 m-0">
        <label class="form-label" for="fechafinal">Fecha Final</label>
        <input type="date"   @error('fechafinal') class="form-control is-invalid" @enderror
        class="form-control"  id="fechafinal" name="fechafinal"  value="{{$FechaFinal->format('Y-m-d')}}"/>
        @error('fechafinal')
        <br>
        <small>*{{$message}}</small>
        <br>
    @enderror
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
    

    $('#tabletab1').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
      dom: "<'row mb-3'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax: {
            url: "{{route('datatable.estudioscompetados')}}",
            data: function (d){
                d.sede=buscar_sedes,
                d.sala=buscar_salas,
                d.modalidad=buscar_modalidades,
                d.prioridad=buscar_prioridades,
                d.fechainicial=$("#fechainicial").val().replaceAll('-', ''),
                d.fechafinal=$("#fechafinal").val().replaceAll('-', '')
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
    $('#tabletab1').DataTable().ajax.reload();
  }


function actulizar_filtros() {
    $('#tabletab1').DataTable().ajax.reload();
}
  
  $("#fechainicial").change(function () {actualizador(); });
  $("#fechafinal").change(function () {actualizador(); });

 
</script>


{{-- @vite('resources/js/app.js') --}}

<script type="module">
/*
    Echo.channel('escuchandoestudiosporvalidar').listen('estudioporvalidarEvent',(e) => {
         console.log("estudioporvalidarEvent"+e.message);
         
         if(e.message=="actualizar"){
          $('#tabletab1').DataTable().ajax.reload();
         }
         
      });
*/
  </script>



@endpush
