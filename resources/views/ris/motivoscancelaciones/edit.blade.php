@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Editar motivos de cancelaciones')

@section('nombrevista','Motivos de cancelaciones')
@section('hrefformulario')
{{route('rismotivoscancelaciones.index')}}
@endsection

@section('tituloformulario','Motivos de cancelaciones')
@section('principalformulario','MOTIVOS DE CANCELACIONES')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar motivos de Cancelaciones')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rismotivoscancelaciones.update',$motivocancelacion)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    

                                                  
                                                <div class="row">	
                                                    <div class="form-group col-8 m-0">
                                                        <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre',$motivocancelacion->nombre)}}" />
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
                                                            <option value="{{$estado->id}}" {{$estado->id == $motivocancelacion->idestado ? 'selected' : ''}}>{{$estado->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                       
                                            
                                                 
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar motivo cancelacion</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')


@endpush


