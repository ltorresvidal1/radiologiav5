@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Editar Pacientes')

@section('nombrevista','Pacientes')
@section('hrefformulario')
{{route('rispacientes.index')}}
@endsection

@section('tituloformulario','Pacientes')
@section('principalformulario','PACIENTES')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar pacientes')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rispacientes.update',$paciente)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    

                                                  
                                                <div class="row">			
                                                        
                                                    <div class="form-group col-3 m-0">
                                                        <label class="form-label" for="idtipoid">Tipo Id</label><label class="obligatorio">*</label> 
                                                        <select class="form-select @error('idtipoid') is-invalid @enderror" id="idtipoid" name="idtipoid">
                                                            <option value="0">Seleccionar</option>
                                                            @foreach ($tipoid as $tipo)
                                                            <option value="{{$tipo->id}}" {{$tipo->id == $paciente->idtipoid ? 'selected' : ''}}>{{$tipo->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                    
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="documento">Documento</label>  <label class="obligatorio">*</label> 
                                                            <input type="text" class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento" value="{{old('documento',$paciente->documento)}}"  />
                                                            @error('documento')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                        <br>
                                                        <div class="row">	
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="primernombre">Primer Nombre</label><label class="obligatorio">*</label> 
                                                            <input type="text" class="form-control @error('primernombre') is-invalid @enderror"  id="primernombre" name="primernombre"  value="{{old('primernombre',$paciente->primernombre)}}" />
                                                                @error('primernombre')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="segundonombre">Segundo Nombre</label>
                                                            <input type="text" class="form-control"  id="" name="segundonombre"  value="{{old('segundonombre',$paciente->segundonombre)}}" />
                                                               
                                                        </div>
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="primerapellido">Primer Apellido</label><label class="obligatorio">*</label> 
                                                            <input type="text" class="form-control @error('primerapellido') is-invalid @enderror"  id="primerapellido" name="primerapellido"  value="{{old('primerapellido',$paciente->primerapellido)}}" />
                                                                @error('primerapellido')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="segundoapellido">Segundo Apellido</label>
                                                            <input type="text" class="form-control"  id="segundoapellido" name="segundoapellido"  value="{{old('segundoapellido',$paciente->segundoapellido)}}" />
                                                             
                                                            
                                                        </div>
                                                    </div>
                                                
                                                    <br>
                                                        <div class="row">	
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="fechanacimiento">Fecha Naciemiento </label><label class="obligatorio">*</label> 
                                                            <div class="col">
                                                                <input type="date" class="form-control  @error('fechanacimiento') is-invalid @enderror"  id="fechanacimiento" name="fechanacimiento" value="{{old('fechanacimiento',$paciente->fechanacimiento)}}" max="{{$fechaactual->format('Y-m-d')}}" />
                                                                                        @error('fechanacimiento')
                                                                                            <br>
                                                                                            <small>*{{$message}}</small>
                                                                                            <br>
                                                                                        @enderror
                                                            </div>
                                                            
                                                        </div>

                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="idsexo">Sexo</label><label class="obligatorio">*</label> 
                                                            <select class="form-select  @error('idsexo') is-invalid @enderror" id="idsexo" name="idsexo">
                                                                <option value="0">Seleccionar</option>
                                                                @foreach ($sexos as $sexo)
                                                                <option value="{{$sexo->id}}" {{$sexo->id == $paciente->idsexo ? 'selected' : ''}}>{{$sexo->nombre}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-6 m-0">
                                                                <label class="form-label" for="correo">Correo </label>
                                                                <input type="text" class="form-control"  id="correo" name="correo"  value="{{old('correo',$paciente->correo)}}" />
                                                        </div>
                                                       
                                                    </div>
                                               <br>
                                                    <div class="row">	
                                                        <div class="form-group col-6 m-0">
                                                            <label class="form-label" for="direccion">Direccion </label>
                                                            <input type="text" class="form-control"  id="direccion" name="direccion"  value="{{old('direccion',$paciente->direccion)}}" />
                                                        </div>
                                                        <div class="form-group col-6 m-0">
                                                            <label class="form-label" for="barrio">Barrio </label>
                                                            <input type="text" class="form-control"  id="barrio" name="barrio"  value="{{old('barrio',$paciente->barrio)}}" />
                                                        </div>
                                                                    
                                                    </div>
                                                    <br>
                                                         <div class="row">	
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="celular">Celular </label><label class="obligatorio">*</label> 
                                                            <input type="text" class="form-control @error('celular') is-invalid @enderror"  id="celular" name="celular"  value="{{old('celular',$paciente->celular)}}" />
                                                            @error('celular')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                      
                                                        </div>
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="telefono">Telefono </label>
                                                            <input type="text" class="form-control"  id="telefono" name="telefono"  value="{{old('telefono',$paciente->telefono)}}" />
                                                        </div>

                                                        <div class="form-group col-6 m-0">
                                                            <label class="form-label" for="políticaprivacidad">¿Se indicó al titular de datos personales sus derechos, canales de atención y cual será el tratamiento sobre la información que se da? ¿Autoriza el tratamiento de sus datos personales? <label class="obligatorio">*</label> </label>
                                                            
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Si" checked="" data-gtm-form-interact-field-id="1">
                                                                <label class="form-check-label" for="gridRadios1">Si</label>
                                                            </div>
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="No" data-gtm-form-interact-field-id="0">
                                                                <label class="form-check-label" for="gridRadios2"> No </label>
                                                            </div>
                                                        </div>
                                                    </div>




                                                                
                                                    
                                                

                                                       
                                            
                                                 
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar paciente</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')


@endpush


