@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Editar sedes')

@section('nombrevista','Sedes')
@section('hrefformulario')
{{route('rissedes.index')}}
@endsection

@section('tituloformulario','Sedes')
@section('principalformulario','SEDES')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar sedes')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rissedes.update',$sede)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    

                                                  
                                                <div class="row">	
                                                    <div class="form-group col-2 m-0">
                                                        <label class="form-label" for="codigo">Código</label><label class="obligatorio">*</label> 
                                                        <input type="text" class="form-control @error('codigo') is-invalid @enderror"  id="codigo" name="codigo"  value="{{old('codigo',$sede->codigo)}}" />
                                                            @error('codigo')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-8 m-0">
                                                        <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre',$sede->nombre)}}" />
                                                            @error('nombre')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-2 m-0">
                                                        <label class="form-label" for="idestado">Estado</label>
                                                        <select class="form-control" id="idestado" name="idestado">
                                                            @foreach ($estados as $estado)
                                                            <option value="{{$estado->id}}" {{$estado->id == $sede->idestado ? 'selected' : ''}}>{{$estado->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                       
                                            
                                                 
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar sede</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')


@endpush


