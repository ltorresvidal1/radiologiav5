@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Crear Sedes')

@section('nombrevista','Sedes')
@section('hrefformulario')
{{route('rissedes.index')}}
@endsection

@section('tituloformulario','Sedes')
@section('principalformulario','SEDES')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear nueva sede')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rissedes.store')}}" method="POST">
                                                @csrf
                                                
                                                    
                                                            <div class="row">	
                                                                <div class="form-group col-2 m-0">
                                                                    <label class="form-label" for="codigo">Código</label><label class="obligatorio">*</label> 
                                                                    <input type="text" class="form-control @error('codigo') is-invalid @enderror"  id="codigo" name="codigo"  value="{{old('codigo')}}" />
                                                                        @error('codigo')
                                                                        <br>
                                                                        <small>*{{$message}}</small>
                                                                        <br>
                                                                    @enderror
                                                                </div>
                                                            <div class="form-group col-8 m-0">
                                                                <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre')}}" />
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
                                                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                         
                                                    
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Crear sede</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')




@endpush


