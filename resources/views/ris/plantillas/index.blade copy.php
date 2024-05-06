
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
                   
 
@livewire('ris-relplantillasradiologos', ['idplantilla' => '99acf121-3bec-4c78-9f0d-661a9b69c854'])
                  
<table id="datatableDefault" class="table text-nowrap w-100">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Usuarios</th>
            <th></th>                                                     
        </tr>
    </thead>
    <tbody>
        @foreach ($plantillas as $plantilla)
        <tr>
            <td>{{$plantilla->nombre}}</td>
            <td>{{$plantilla->estado}} </td>
            <td>
                <a href="javascript: modal_relplantillaradiologo()" data-toggle="tooltip"  title="Agregar Radiologo"><i class="fa fa-user-md fa-fw fa-lg"></i></a>
             </td>
            <td>
             
                <div class="dropdown text-center">
                    <a href="#" data-bs-toggle="dropdown" class="text-decoration-none"><i class="fa fa-ellipsis-v fa-fw fa-lg"></i> </a>
                    <div class="dropdown-menu">
                       
                        <a href="{{ route('risplantillas.edit', $plantilla->id) }}" class="dropdown-item"><i class="far fa-edit fa-fw fa-lg"></i> Editar</a>
                        <form id="delete-{{$plantilla->id}}" action="{{route('risplantillas.destroy',$plantilla)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="dropdown-item"  onclick="EliminarPlantilla('{{ $plantilla->id }}')"><i class="far fa-trash-alt fa-fw fa-lg"></i> Eliminar</a>
                    </div>
                </div>

       
            </td>
         </tr>
        
        @endforeach
      
    
    </tbody>
</table>       


                             
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


<script type="text/javascript">
    VirtualSelect.init({
        ele: '#multi_option',
        search: true,
    });
</script>

  <script>

  $('#datatableDefault').DataTable({
    language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
    paging:false,
    dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
    responsive: true,
    buttons: [ {title: 'Clientes', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
    exportOptions: {columns: [0, 1, 2,3,4] }}]
  });  


  function modal_relplantillaradiologo() {
     
     $('#modalasignarradiologo').modal({backdrop: 'static', keyboard: false});
     $("#modalasignarradiologo").modal("toggle");
     $('#modalasignarradiologo').on('shown.bs.modal', function () {
    
    });
}
    

$(document).ready(function() {
  
    
});
</script>


  
@endpush
