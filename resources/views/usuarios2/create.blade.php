@extends('layouts.plantillaFormularios')



@section('title','Crear Usuarios')

@section('nombrevista','Usuarios')
@section('hrefformulario')

@endsection

@section('tituloformulario','Usuarios')
@section('principalformulario','USUARIOS')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear Nuevo Usuario')
@section('classformulario','card')




@section('content')

											<form action="{{route('usuarios.store')}}" method="POST">
                                                @csrf
												<div class="row">													                                                    
														<div class="form-group col-3 m-0">
															<label class="form-label" for="documento">Documento</label>
															<input type="text" class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento" value="{{old('documento')}}" />
                                                            @error('documento')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
														</div>
														<div class="form-group col-6 m-0">
															<label class="form-label" for="nombre">Nombre</label>
															<input type="text"  class="form-control @error('nombre') is-invalid @enderror"                                                              
                                                            class="form-control"  id="nombre" name="nombre"  value="{{old('nombre')}}"/>
                                                            @error('nombre')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                            @enderror
														</div>
														<div class="form-group col-3 m-0">
															<label class="form-label" for="usuario">Usuario</label>
															<input type="text"  class="form-control @error('usuario') is-invalid @enderror"                                                              
                                                            class="form-control"  id="usuario" name="usuario"  value="{{old('usuario')}}"/>
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
                                                        <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')}}" />
                                                        @error('password')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-3 m-0">
                                                        <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                                        <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation"  value="{{old('password_confirmation')}}"/>
                                                        @error('password_confirmation')
                                                        <br>
                                                        <small>*{{$message}}</small>
                                                        <br>
                                                    @enderror
                                                    </div>
                                                    <div class="form-group col-3 m-0">
                                                     
                                                        
                                                    </div>
                                                 </div>

                                                <div class="row">													                                                    
                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="idcliente">Cliente</label>
                                                        <input type="text" class="form-control @error('idcliente') is-invalid @enderror" id="idcliente" name="idcliente" value="{{old('idcliente')}}" />
                                                        @error('idcliente')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="idperfil">Perfil</label>
                                                        <input type="text" class="form-control @error('idperfil') is-invalid @enderror" id="idperfil" name="idperfil"  value="{{old('idperfil')}}"/>
                                                        @error('idperfil')
                                                        <br>
                                                        <small>*{{$message}}</small>
                                                        <br>
                                                    @enderror
                                                    </div>
                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="idestado">Estado</label>
                                                        <select class="form-control" id="idestado" name="idestado">
                                                            <option value="1">Activo</option>
                                                            <option value="0">Inanctivo</option>
                                                        </select>
                                                    </div>
                                                 </div>

                                                <br>
                                                <div class="row">    
                                                    <div class="form-group col-3 m-0">                                                        
                                                        <button type="submit" class="btn btn-primary">Crear Usuario</button>
                                                    </div>
                                                </div>	
											</form>
      
@endsection