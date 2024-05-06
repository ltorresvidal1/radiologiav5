
@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">

@endpush

@extends('layouts.plantillaFormularios')
@section('title','Motivos De Cancelaciones')

@section('nombrevista','Motivos De Cancelaciones')
@section('hrefformulario')
{{route('rismotivoscancelaciones.index')}}
@endsection
@section('botonesformulario')
<div class="ms-auto">
    <a href="{{route('rismotivoscancelaciones.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i> Crear motivos de cancelaciones</a>
</div>
@endsection
@section('tituloformulario','Motivos de cancelaciones')
@section('principalformulario','MOTIVOS DE CANCELACIONES')
@section('accionformulario','TODOS')
@section('descripcionformulario','Listado motivos de cancelaciones creadas')
@section('classformulario','')


@section('content')
                             
<table id="datatableDefault" class="table text-nowrap w-100">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th></th>                                                     
        </tr>
    </thead>
    <tbody>
        @foreach ($motivoscancelaciones as $motivocancelacion)
        <tr>
            <td>{{$motivocancelacion->nombre}}</td>
            <td>{{$motivocancelacion->estado}} </td>
            <td>
             
                <div class="dropdown text-center">
                    <a href="#" data-bs-toggle="dropdown" class="text-decoration-none"><i class="fa fa-ellipsis-v fa-fw fa-lg"></i> </a>
                    <div class="dropdown-menu">
                       
                        <a href="{{ route('rismotivoscancelaciones.edit', $motivocancelacion->id) }}" class="dropdown-item"><i class="far fa-edit fa-fw fa-lg"></i> Editar</a>
                        <form id="delete-{{$motivocancelacion->id}}" action="{{route('rismotivoscancelaciones.destroy',$motivocancelacion)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="dropdown-item"  onclick="EliminarMotivocancelacion('{{ $motivocancelacion->id }}')"><i class="far fa-trash-alt fa-fw fa-lg"></i> Eliminar</a>
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
</script>



  
@endpush
