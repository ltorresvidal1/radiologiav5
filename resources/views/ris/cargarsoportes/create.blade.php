@extends('layouts.plantillaFormularios')

@push('css')

@endpush
@section('title','Crear salas')

@section('nombrevista','Salas')

@section('tituloformulario','Salas')
@section('principalformulario','SALAS')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear nueva sala')
@section('classformulario','card')



@section('content') 



											<form action="{{route('cargarsoportes.store')}}" method="POST" enctype="multipart/form-data" >
                                                @csrf
                                                
                                                    
                                                            <div class="row">	
                                                                <div class="form-group col-12 m-0">
                                                                    <label class="form-label" for="codigo">Archivo</label><label class="obligatorio">*</label> 
                                                                    <input type="file" class="form-control" name="file">
                                                                    
                                                                </div>
                                                            </div> 
                         
                                                    
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Cargar docuemnto</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')




@endpush


