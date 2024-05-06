
@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">

@endpush

@extends('layouts.plantillaFormularios')
@section('title','Pacientes')


@section('nombrevista','Atencion Inmediata')
@section('hrefformulario')
{{route('atencionimediata.index')}}
@endsection

@section('tituloformulario','Atención Inmediata')
@section('principalformulario','ATENCION INMEDIATA')
@section('accionformulario','TODOS')
@section('descripcionformulario','')
@section('classformulario','')


@section('content')
<div class="d-flex align-items-center mb-2">
                    
  <div class="form-group col-11 m-0">
 
  </div>     
  <div class="form-group col-1 m-0">
      <div>
          <button type="button" class="btn btn-primary mb-1 btn-sm" onclick="AbrirModalFiltros()">
              <i class="fa fa-cog"></i> Filtros
          </button>

      </div>     
      </div>     
 
</div>
@livewire('ris-atencion')     

@livewire('modal-filtrossalas-component')   

@endsection


@push('scripts')

<script src="/assets/js/btnEventos.js"></script>
<script src="/assets/js/funcionesAtencioninmediata.js"></script>
<script src="/assets/js/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.colVis.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.print.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/assets/js/plugins/datatables/js/responsive.bootstrap4.min.js"></script>


  <script>


  
$('#datatableDefault').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
      dom: "<'row mb-3'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax: {
            url: "{{route('datatable.atencioninmediata')}}",
            data: function (d){
                d.sala=buscar_salas
            }
        },
        dataType:'json',
        type: "POST",
        order: [[0, 'desc']],
      
      "columnDefs": [
            { "visible": false, "targets": 0 },
        ],
        columns:[
         {data:'id',orderable:false},
         {data:'nombre',orderable:false},
         {data:'admision',orderable:false},
         {data:'fecha',orderable:false},
         {data:'estudio',orderable:false},
         {data:'action',orderable:false},
          ]
          ,
      info:false,
      buttons: [ 
        {text: '<i class="fas fa-history"></i>', titleAttr: 'Refrescar', className: 'btn btn-indigo',action: function (e, dt, node, config) {$('#datatableDefault').DataTable().ajax.reload();}},
        {title: 'Atencion inmediata', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
        exportOptions: {columns: [1,2,3,4] }}],
      
    });  
  

function actulizar_filtros() {
    $('#datatableDefault').DataTable().ajax.reload();
}

  /*$('#datatableDefault').DataTable({
    language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
    paging:false,
    dom: "<'row mb-3'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    responsive: true,
    buttons: [ {title: 'Atencion inmediata', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
    exportOptions: {columns: [0, 1, 2,3,4] }}]
  });  
  */
</script>



  
@endpush
