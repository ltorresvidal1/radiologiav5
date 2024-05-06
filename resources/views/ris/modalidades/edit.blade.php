@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Editar modalidades')

@section('nombrevista','Modalidades')
@section('hrefformulario')
{{route('rismodalidades.index')}}
@endsection

@section('tituloformulario','Modalidades')
@section('principalformulario','MODALIDADES')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar modalidades')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rismodalidades.update',$modalidad)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="row">	
                                                <div class="form-group col-2 m-0">
                                                    <label class="form-label" for="codigo">Código</label><label class="obligatorio">*</label> 
                                                    <input type="text" class="form-control @error('codigo') is-invalid @enderror"  id="codigo" name="codigo"  value="{{old('codigo',$modalidad->codigo)}}" />
                                                        @error('codigo')
                                                        <br>
                                                        <small>*{{$message}}</small>
                                                        <br>
                                                    @enderror
                                                </div>
                                                  
                                              
                                                    <div class="form-group col-6 m-0">
                                                        <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre',$modalidad->nombre)}}" />
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
                                                            <option value="{{$estado->id}}" {{$estado->id == $modalidad->idestado ? 'selected' : ''}}>{{$estado->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                       
                                            
                                                 
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar modalidad</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')


@endpush


