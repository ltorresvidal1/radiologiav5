
@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">

@endpush

@extends('layouts.plantillaFormularios')
@section('title','Salas')

@section('nombrevista','Agendas')
@section('hrefformulario')
{{route('risagendas.index')}}
@endsection
@section('botonesformulario')
<div class="ms-auto">
    <a href="{{route('risagendas.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i> Crear Agendas</a>
</div>
@endsection
@section('tituloformulario','Agendas')
@section('principalformulario','AGENDAS')
@section('accionformulario','TODOS')
@section('descripcionformulario','Listado De Agendas Creadas')
@section('classformulario','')


@section('content')
                             
<table id="datatableDefault" class="table text-nowrap w-100">
    <thead>
        <tr>
            <th>Sede</th>
            <th>Sala</th>
            <th>Rango De Fecha</th>
            <th>Estado</th>
            <th>Usuarios</th>
            <th></th>                                                     
        </tr>
    </thead>
    <tbody>
        @foreach ($agendas as $agenda)
        <tr>
            <td>{{$agenda->sede}}</td>
            <td>{{$agenda->sala}}</td>
            <td>

                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 d-flex align-items-center fw-600 text-body">
                    <i class="fa fa-circle fs-9px fa-fw text-teal me-2 "></i> Fecha Inicial: {{$agenda->fechainicial}}
                    </div>
                    <div class="fw-600 text-body">Hora: {{$agenda->horainicial}}  </div>
                </div>
                <div class="d-flex align-items-center">
                    <div class="flex-grow-1 d-flex align-items-center fw-600 text-body">
                    <i class="fa fa-circle fs-9px fa-fw text-danger me-2"></i>  Fecha Final:  {{$agenda->fechafinal}}
                    </div>
                    <div class="fw-600 text-body">Hora: {{$agenda->horafinal}}  </div>
                    </div>
            </td>
            <td>{{$agenda->estado}} </td>
            <td>
                <a href="{{ route('risagendas.edit', $agenda->id) }}" data-toggle="tooltip"  title="Agregar Radiologo"><i class="fa fa-user-md fa-fw fa-lg"></i></a>
             </td>
            <td>
             
                <div class="dropdown text-center">
                    <a href="#" data-bs-toggle="dropdown" class="text-decoration-none"><i class="fa fa-ellipsis-v fa-fw fa-lg"></i> </a>
                    <div class="dropdown-menu">
                       
                        <a href="{{ route('risagendas.edit', $agenda->id) }}" class="dropdown-item"><i class="far fa-edit fa-fw fa-lg"></i> Editar</a>
                        <form id="delete-{{$agenda->id}}" action="{{route('risagendas.destroy',$agenda)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="dropdown-item"  onclick="EliminarAgenda('{{ $agenda->id }}')"><i class="far fa-trash-alt fa-fw fa-lg"></i> Eliminar</a>
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

  $(function () {
  $('[data-toggle="tooltip"]').tooltip()
})
</script>



  
@endpush
