@extends('layouts.plantillaFormularios')


     

@section('title','Editar Usuarios')

@section('nombrevista','Usuarios')
@section('hrefformulario')
{{route('sa_usuarios.index')}}
@endsection

@section('tituloformulario','Usuarios')
@section('principalformulario','USUARIOS')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar Usuario')
@section('classformulario','card')


@section('content')

											<form action="{{route('sa_usuarios.update',$usuario)}}" method="POST">
                                                @csrf
                                                @method('PUT')
												<div class="row">													                                                    
														<div class="form-group col-3 m-0">
															<label class="form-label" for="documento">Documento</label>
															<input type="text" class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento" value="{{old('documento',$usuario->documento)}}" />
                                                            @error('documento')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
														</div>
														<div class="form-group col-6 m-0">
															<label class="form-label" for="nombre">Nombre</label>
															<input type="text"  class="form-control @error('nombre') is-invalid @enderror"                                                              
                                                            class="form-control"  id="nombre" name="nombre"  value="{{old('nombre',$usuario->nombre)}}"/>
                                                            @error('nombre')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                            @enderror
														</div>
														<div class="form-group col-3 m-0">
															<label class="form-label" for="usuario">Usuario</label>
															<input type="text"  class="form-control @error('usuario') is-invalid @enderror"                                                              
                                                            class="form-control"  id="usuario" name="usuario"  value="{{old('usuario',$usuario->usuario)}}"/>
                                                            @error('usuario')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                            @enderror
														</div>
                                                </div>
                                                <div class="row">													                                                    
                                                    <div class="form-group col-3 m-0">
                                                        <label class="form-label" for="password">Contraseña</label>
                                                        <input type="password" class="form-control" id="password" name="password" value="*******************" readonly/>
                                                  
                                                    </div>
                                                    <div class="form-group col-3 m-0">
                                                        <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                                        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation"  value="*******************" readonly/>
                                                      
                                                    </div>
                                                    <div class="form-group col-3 m-0">
                                                     
                                                        
                                                    </div>
                                                 </div>

                                                <div class="row">													                                                    
                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="idcliente">Cliente</label>
                                                        <input type="hidden" class="form-control"  id="tempcliente" name="tempcliente" value="{{old('tempcliente',$usuariosclientes->cliente_id)}}" />
                                                        <div wire:ignore>
                                                            <div class="form-control  @error('idcliente') is-invalid @enderror" >
                                                            <select class="select2 form-control" id="idcliente" name="idcliente" >
                                                     
                                                                <option value="">-- Selecionar Cliente --</option>
                                                     
                                                                @foreach($clientes as $cliente)                                                     
                                                                    <option value="{{ $cliente->id }}">{{ $cliente->nombre }}</option>
                                                                @endforeach
                                                                                                
                                                
                                                            </select>
                                                            </div>
                                                        </div>
                                                        @error('idcliente')
                                                        <br>
                                                        <small>*{{$message}}</small>
                                                        <br>
                                                    @enderror
                                                     
                                                    </div>

                                               
                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="idperfil">Perfil</label>
                                                        <input type="hidden" class="form-control"  id="temperfil" name="temperfil" value="{{old('temperfil',$usuario->perfile_id)}}" />
                                                        <div wire:ignore>
                                                            <div class="form-control  @error('idperfil') is-invalid @enderror" >
                                                            <select class="select2 form-control" id="idperfil" name="idperfil" >
                                                     
                                                                <option value="">-- Selecionar Perfil --</option>
                                                     
                                                                @foreach($perfiles as $perfil)                                                     
                                                                    <option value="{{ $perfil->id }}">{{ $perfil->nombre }}</option>
                                                                @endforeach
                                                            </select>
                                                            </div>
                                                        </div>
                                                        @error('idperfil')
                                                        <br>
                                                        <small>*{{$message}}</small>
                                                        <br>
                                                    @enderror
                                                    </div>
                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="idestado">Estado</label>
                                                        <select class="form-control" id="idestado" name="idestado">
                                                            @foreach ($desplegables as $desplegable)
                                                            <option value="{{$desplegable->id}}" {{$desplegable->id == $usuario->idestado ? 'selected' : ''}}>{{$desplegable->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                 </div>

                                                <br>
                                                <div class="row">    
                                                    <div class="form-group col-3 m-0">                                                        
                                                        <button type="submit" class="btn btn-primary">Editar Usuario</button>
                                                    </div>
                                                </div>	
											</form>
      
@endsection

@push('scripts')

<script>
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




</script>
@endpush