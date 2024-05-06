
@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/virtualselect/virtual-select.min.css" rel="stylesheet">

        
@endpush

@extends('layouts.plantillaFormularios')
@section('title','Plantillas')

@section('nombrevista','Plantillas')
@section('hrefformulario')
{{route('risplantillas.index')}}
@endsection
@section('botonesformulario')
<div class="ms-auto">
    <a href="{{route('risplantillas.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i> Crear plantillas</a>
</div>
@endsection
@section('tituloformulario','Plantillas')
@section('principalformulario','PLANTILLAS')
@section('accionformulario','TODOS')
@section('descripcionformulario','Listado de plantillas creadas')
@section('classformulario','')


@section('content')
                   
 
@livewire('ris-relplantillasradiologos')
   


                             
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
<script src="/assets/js/plugins/virtualselect/virtual-select.min.js"></script>



  <script>

  $('#datatableDefault').DataTable({
    language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
    paging:false,
    dom: "<'row mb-3'<'col-sm-4'B><'col-sm-4'l><'col-sm-4'f>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    responsive: true,
    buttons: [ {title: 'Clientes', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
    exportOptions: {columns: [0, 1, 2,3,4] }}]
  });  
  
</script>


  
@endpush
