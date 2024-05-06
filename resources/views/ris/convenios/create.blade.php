@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Crear salas')

@section('nombrevista','Salas')
@section('hrefformulario')
{{route('rissalas.index')}}
@endsection

@section('tituloformulario','Salas')
@section('principalformulario','SALAS')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear nueva sala')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rissalas.store')}}" method="POST">
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
                                                                <label class="form-label" for="sede_id">Sedes</label>
                                                                <select class="form-select  @error('sede_id') is-invalid @enderror" id="sede_id" name="sede_id">
                                                                    <option value="0">Seleccionar</option>
                                                                    @foreach ($sedes as $sede)
                                                                    <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <br>
                                                            <div class="row">    
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="modalidad_id">Modalidad</label>
                                                                    <select class="form-select @error('modalidad_id') is-invalid @enderror" id="modalidad_id" name="modalidad_id">
                                                                        <option value="0">Seleccionar</option>
                                                                        @foreach ($modalidades as $modalidad)
                                                                        <option value="{{$modalidad->id}}">{{$modalidad->codigo}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-5 m-0">
                                                                    <label class="form-label" for="aetitle">AE TITLE</label>
                                                                    <input type="text" class="form-control"  id="aetitle" name="aetitle"  value="{{old('aetitle')}}" />
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
                                                            <button type="submit" class="btn btn-primary">Crear sala</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')




@endpush


