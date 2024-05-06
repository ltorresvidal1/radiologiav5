@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Crear modalidades')

@section('nombrevista','Modalidades')
@section('hrefformulario')
{{route('rismodalidades.index')}}
@endsection

@section('tituloformulario','Modalidades')
@section('principalformulario','MODALIDADES')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear nueva modalidad')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rismodalidades.store')}}" method="POST">
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
                                                            <div class="form-group col-6 m-0">
                                                                <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre')}}" />
                                                                    @error('nombre')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-4 m-0">
                                                                <label class="form-label" for="idestado">Estado</label>
                                                                <select class="form-select" id="idestado" name="idestado">
                                                                    @foreach ($estados as $estado)
                                                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                         
                                                    
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Crear modalidad</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')




@endpush


