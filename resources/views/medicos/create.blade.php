@extends('layouts.plantillaFormularios')

@push('css')
<link rel="stylesheet" href="/assets/js/plugins/dropzone/dropzone.min.css" type="text/css" />
@endpush
@section('title','Crear radiologos')

@section('nombrevista','Radiologos')
@section('hrefformulario')
{{route('medicos.index')}}
@endsection

@section('tituloformulario','Radiólogos')
@section('principalformulario','RADIOLOGOS')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear nuevo radiólogo')
@section('classformulario','card')



@section('content') 




    <div class="row">		
                                                
        <div id="profileWidget" class="mb-5">
            
            <div class="card-body">
                    <div class="row">
                        <div class="form-group col-4 m-0">
                        </div>
                        <div class="form-group col-4 m-0">
                            <div class="card border-1 rounded-bottom-0" >
                               
                                <form action="{{route('firmaradiologo.store')}}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    @csrf</form>
                            </div>  
                            
                            <div class="card border-top-0 rounded-top-0">
                                <div class="card-body py-2 px-3">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="fw-600">Firma Radiólogo</div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                          
                        </div>
                    </div>
                </div>
        </div>
    </div>  



											<form action="{{route('medicos.store')}}" method="POST">
                                                @csrf
                                                
                                                    
                                                    <div class="row">													                                                    
                                                            <div class="form-group col-2 m-0">
                                                                <label class="form-label" for="documento">Documento</label>
                                                                <input type="text" class="form-control @error('documento') is-invalid @enderror" id="documento" name="documento" value="{{old('documento')}}"  />
                                                                @error('documento')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-5 m-0">
                                                                <label class="form-label" for="nombre">Nombre</label>
                                                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre')}}" />
                                                                    @error('nombre')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-2 m-0">
                                                                <label class="form-label" for="registromedico">Registro Médico</label>
                                                                <input type="text" class="form-control @error('registromedico') is-invalid @enderror"  id="registromedico" name="registromedico"  value="{{old('registromedico')}}" />
                                                                    @error('registromedico')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-3 m-0">
                                                                <label class="form-label" for="usuario">Usuario</label>
                                                                <input type="text"  class="form-control @error('usuario') is-invalid @enderror"                                                              
                                                                class="form-control"  id="usuario" name="usuario"  value="{{old('usuario')}}"/>
                                                                @error('usuario')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                                @enderror
                                                            </div>
                                                           
                                                    </div>
                                                    <br>
                                                    <div class="row">													                                                    
                                                        <div class="form-group col-4 m-0">
                                                            <label class="form-label" for="password">Contraseña</label>
                                                            <input type="password" class="form-control @error('password') is-invalid @enderror" id="password" name="password" value="{{old('password')}}" />
                                                            @error('password')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-4 m-0">
                                                            <label class="form-label" for="password_confirmation">Confirmar Contraseña</label>
                                                            <input type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" name="password_confirmation"  value="{{old('password_confirmation')}}"/>
                                                            @error('password_confirmation')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                        </div>
                                                        <div class="form-group col-2 m-0">
                                                            <label class="form-label" for="idperfil">Perfil</label>
                                                            <input type="hidden" class="form-control"  id="temperfil" name="temperfil" value="{{old('temperfil')}}" />
                                                            <div>
                                                               
                                                                <select class="select2 form-select" id="idperfil" name="idperfil" >
                                                                      @foreach($perfiles as $perfil)                                                     
                                                                        <option value="{{ $perfil->id }}">{{ $perfil->nombre }}</option>
                                                                    @endforeach
                                                                </select>
                                                                
                                                            </div>
                                                          
                                                            
                                                        </div>


                                                        <div class="form-group col-2 m-0">
                                                            <label class="form-label" for="idestado">Estado</label>
                                                            <select class="form-select" id="idestado" name="idestado">
                                                                @foreach ($desplegables as $desplegable)
                                                                <option value="{{$desplegable->id}}">{{$desplegable->nombre}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>

                                                    <div class="row">													                                                    
                                                        <div class="form-group col-4 m-0">
                                                         
                                                            <input type="hidden" class="form-control"  id="logo" name="logo" value="{{old('logo')}}" />
                                                        
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Crear radiólogo</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')
<script src="/assets/js/plugins/dropzone/dropzone.min.js"></script>

<script>
       Dropzone.autoDiscover = false;
    const dropzone = new Dropzone('#dropzone',{
        dictDefaultMessage:'Buscar Firma Radiologo',
        acceptedFiles:".pnh,.jpg,.jpeg",
        addRemoveLinks:true,
        dictRemoveFile:'Borrar Archivo',
        maxFiles:1,
        uploadMultiple:false,
        init: function(){
            if(document.querySelector('[name="logo"]').value.trim()){
                const imagenPublicada={};
                imagenPublicada.size=1234;
                imagenPublicada.name=document.querySelector('[name="logo"]').value;
                this.options.addedfile.call(this,imagenPublicada);
                this.options.thumbnail.call(this,imagenPublicada,`/uploads/firmasradiologos/${imagenPublicada.name}`);

                imagenPublicada.previewElement.classList.add("dz-success","dz-complete");
            }
        },
    });
 
    dropzone.on("success",function (file,response){
        document.querySelector('[name="logo"]').value=response.imagen;
    });

     
    dropzone.on("removedfile",function (){
        document.querySelector('[name="logo"]').value='';
    });


    </script>



@endpush


