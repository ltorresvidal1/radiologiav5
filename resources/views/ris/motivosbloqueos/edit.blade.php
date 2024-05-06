@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Editar Motivos De Bloqueos')

@section('nombrevista','SeMotivos De Bloqueosdes')
@section('hrefformulario')
{{route('rismotivosbloqueos.index')}}
@endsection

@section('tituloformulario','Motivos De Bloqueos')
@section('principalformulario','MOTIVOS DE CANCELACIONES')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar Motivo De Bloqueo')
@section('classformulario','card')






@section('content') 



											<form action="{{route('rismotivosbloqueos.update',$motivobloqueo)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    

                                                  
                                                <div class="row">	
                                                    <div class="form-group col-8 m-0">
                                                        <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                        <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre',$motivobloqueo->nombre)}}" />
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
                                                            <option value="{{$estado->id}}" {{$estado->id == $motivobloqueo->idestado ? 'selected' : ''}}>{{$estado->nombre}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                       
                                            
                                                 
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar Motivo Bloqueo</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')


@endpush


