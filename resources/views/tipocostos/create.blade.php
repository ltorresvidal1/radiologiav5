@extends('layouts.plantillaFormularios')


@section('title','Crear Tipo de Costos')

@section('nombrevista','Tipo de Costos')
@section('hrefformulario')
{{route('tipocostos.index',$clientes)}}
@endsection

@section('tituloformulario','Tipo de Costos')
@section('principalformulario','TIPO DE COSTOS')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear Nuevo Tipo de Costo')
@section('classformulario','card')


@section('content')


	<!-- BEGIN #tabsWithCard -->


     
    <form action="{{route('tipocostos.store',$clientes)}}" method="POST">
        @csrf
                            
                            <div class="tab-content">
                              
                                <div id="general">
                                    <div class="row">													                                                    
                                    
                                        <div class="form-group col-md-8">
                                            <label class="form-label" for="nombre">Nombre</label>
                                            <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre')}}" />
                                                @error('nombre')
                                                <br>
                                                <small>*{{$message}}</small>
                                                <br>
                                            @enderror
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label class="form-label" for="idestado">Estado</label>
                                            <select class="form-control" id="idestado" name="idestado">
                                                @foreach ($desplegables as $desplegable)
                                                <option value="{{$desplegable->id}}">{{$desplegable->nombre}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="row">                 
                                     <div class="form-group col-md-3">   
                                                    <br>                                                     
                                                    <button type="submit" class="btn btn-primary">Crear Tipo Costo</button>
                                    </div>
                            </div>
    </form>
      
@endsection

@push('scripts')

  
<script>
    
    /*
$(document).ready(function() {
    
    $('.select2').select2();

    $("#idperfil").change(function () {     
        $('#temperfil').val($('#idperfil').val());
    });


    if ($('#idperfil').hasClass("select2-hidden-accessible")) {
        $('#idperfil').val($('#temperfil').val());
        $('#idperfil').trigger('change');
    }
 
    
    $("#idcliente").change(function () {     
        $('#tempcliente').val($('#idcliente').val());
    });


    if ($('#idcliente').hasClass("select2-hidden-accessible")) {
        $('#idcliente').val($('#tempcliente').val());
        $('#idcliente').trigger('change');
    }

});

*/




</script>
@endpush