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
@section('descripcionformulario','Editar salas')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rissalas.update',$sala)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    

                                                  
                                                <div class="row">	
                                                    <div class="form-group col-2 m-0">
                                                        <label class="form-label" for="codigo">Código</label><label class="obligatorio">*</label> 
                                                        <input type="text" class="form-control @error('codigo') is-invalid @enderror"  id="codigo" name="codigo"  value="{{old('codigo',$sala->codigo)}}" />
                                                            @error('codigo')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                    </div>
                                                    <div class="form-group col-6 m-0">
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
                                                        <select class="form-select  @error('sede_id') is-invalid @enderror" id="sede_id" name="sede_id">
                                                            @foreach ($sedes as $sede)
                                                            <option value="{{$sede->id}}" {{$sede->id == $sala->sede_id ? 'selected' : ''}}>{{$sede->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <br>
                                                    <div class="row">   
                                                        <div class="form-group col-3 m-0">
                                                            <label class="form-label" for="modalidad_id">Modalidad</label>
                                                            <select class="form-select" id="modalidad_id" name="modalidad_id">
                                                                @foreach ($modalidades as $modalidad)
                                                                <option value="{{$modalidad->id}}" {{$modalidad->id == $sala->modalidad_id ? 'selected' : ''}}>{{$modalidad->codigo}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-5 m-0">
                                                            <label class="form-label" for="aetitle">AE TITLE</label>
                                                            <input type="text" class="form-control"  id="aetitle" name="aetitle"  value="{{old('aetitle',$sala->aetitle)}}" />
                                                        </div>
                                                    <div class="form-group col-4 m-0">
                                                        <label class="form-label" for="idestado">Estado</label>
                                                        <select class="form-select" id="idestado" name="idestado">
                                                            @foreach ($estados as $estado)
                                                            <option value="{{$estado->id}}" {{$estado->id == $sala->idestado ? 'selected' : ''}}>{{$estado->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                            
                                                 
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar sala</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')


@endpush


