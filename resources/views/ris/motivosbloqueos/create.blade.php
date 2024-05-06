@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Crear Motivos De Bloqueos')

@section('nombrevista','Motivos De Bloqueos')
@section('hrefformulario')
{{route('rismotivosbloqueos.index')}}
@endsection

@section('tituloformulario','Motivos De Bloqueos')
@section('principalformulario','MOTIVOS DE CANCELACIONES')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear Nuevo Motivo De Bloqueo')
@section('classformulario','card')



@section('content') 



											<form action="{{route('rismotivosbloqueos.store')}}" method="POST">
                                                @csrf
                                                
                                                    
                                                            <div class="row">	
                                                            <div class="form-group col-8 m-0">
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
                                                            <button type="submit" class="btn btn-primary">Crear Motivos Bloqueo</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')




@endpush


