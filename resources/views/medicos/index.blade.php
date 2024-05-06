
@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">

@endpush

@extends('layouts.plantillaFormularios')
@section('title','Radiologos')

@section('nombrevista','Radiologos')
@section('hrefformulario')
{{route('medicos.index')}}
@endsection
@section('botonesformulario')
<div class="ms-auto">
    <a href="{{route('medicos.create')}}" class="btn btn-primary"><i class="fa fa-plus-circle fa-fw me-1"></i> Crear radiólogo</a>
</div>
@endsection
@section('tituloformulario','Radiólogos')
@section('principalformulario','RADIóLOGOS')
@section('accionformulario','TODOS')
@section('descripcionformulario','Listado de radiólogos creados')
@section('classformulario','')


@section('content')
                             
<table id="datatableDefault" class="table text-nowrap w-100">
    <thead>
        <tr>
            <th>Documento</th>
            <th>Nombre</th>
            <th>Usuario</th>
            <th>Registro Médico</th>
            <th>Estado</th>
            <th></th>                                                     
        </tr>
    </thead>
    <tbody>
        @foreach ($medicos as $medico)
        <tr>
            <td>{{$medico->documento}}</td>
            <td>{{$medico->nombre}}</td>
            <td>{{$medico->usuario}}</td>
            <td>{{$medico->registromedico}}</td>
            <td>{{$medico->estado}} </td>
            <td>
             
                <div class="dropdown text-center">
                    <a href="#" data-bs-toggle="dropdown" class="text-decoration-none"><i class="fa fa-ellipsis-v fa-fw fa-lg"></i> </a>
                    <div class="dropdown-menu">
                        <form id="restablecer-{{$medico->id}}" action="{{route('medicos.restablecer',$medico)}}" method="POST">
                            @csrf
                            @method('PUT')
                        </form>
                        <a  class="dropdown-item"  onclick="RestablecerClave('{{ $medico->id }}')"><i class="fas fa-lg fa-fw me-2 fa-key"></i>Restablecer</a>
                        <a href="{{ route('medicos.edit', $medico->id) }}" class="dropdown-item"><i class="far fa-edit fa-fw fa-lg"></i> Editar</a>
                        <form id="delete-{{$medico->id}}" action="{{route('medicos.destroy',$medico)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="dropdown-item"  onclick="EliminarMedico('{{ $medico->id }}')"><i class="far fa-trash-alt fa-fw fa-lg"></i> Eliminar</a>
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
