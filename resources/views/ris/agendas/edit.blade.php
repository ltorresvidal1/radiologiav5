@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Editar Salas')

@section('nombrevista','Salas')
@section('hrefformulario')
{{route('rissalas.index')}}
@endsection

@section('tituloformulario','Salas')
@section('principalformulario','SALAS')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar Salas')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rissalas.update',$sala)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    

                                                  
                                                <div class="row">	
                                                    <div class="form-group col-8 m-0">
                                                        <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre',$sala->nombre)}}" />
                                                            @error('nombre')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                    </div>

                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="sede_id">Sedes</label>
                                                        <select class="form-control  @error('sede_id') is-invalid @enderror" id="sede_id" name="sede_id">
                                                            <option value="0">Seleccionar</option>
                                                            @foreach ($sedes as $sede)
                                                            <option value="{{$sede->id}}" {{$sede->id == $sala->sede_id ? 'selected' : ''}}>{{$sede->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="idestado">Estado</label>
                                                        <select class="form-control" id="idestado" name="idestado">
                                                            @foreach ($estados as $estado)
                                                            <option value="{{$estado->id}}" {{$estado->id == $sala->idestado ? 'selected' : ''}}>{{$estado->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                       
                                            
                                                 
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar Sede</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')


@endpush


