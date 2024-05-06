@extends('layouts.plantillaFormularios')

@push('css')
<link rel="stylesheet" href="/assets/js/plugins/dropzone/dropzone.min.css" type="text/css" />
@endpush
@section('title','Editar Clientes')

@section('nombrevista','Clientes')
@section('hrefformulario')
{{route('clientes.index')}}
@endsection

@section('tituloformulario','Clientes')
@section('principalformulario','CLIENTES')
@section('accionformulario','EDITAR')
@section('descripcionformulario','Editar Cliente')
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
                               
                                <form action="{{route('imagenes.store')}}" method="POST" enctype="multipart/form-data" class="dropzone" id="dropzone">
                                    @csrf</form>
                            </div>  
                            
                            <div class="card border-top-0 rounded-top-0">
                                <div class="card-body py-2 px-3">
                                    <div class="row text-center">
                                        <div class="col-12">
                                            <div class="fw-600">Logo Cliente</div>
                                        </div>
                                    </div>
                                </div>
                            </div>                                                                          
                        </div>
                    </div>
                </div>
        </div>
    </div>  



											<form action="{{route('clientes.update',$cliente)}}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                    
                                                    <div class="row">													                                                    
                                                            <div class="form-group col-4 m-0">
                                                                <label class="form-label" for="nit">Nit</label>
                                                                <input type="text" class="form-control @error('nit') is-invalid @enderror" id="nit" name="nit" value="{{old('nit',$cliente->nit)}}"  />
                                                                @error('nit')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-8 m-0">
                                                                <label class="form-label" for="nombre">Empresa</label>
                                                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre',$cliente->nombre)}}" />
                                                                    @error('nombre')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                    </div>
                                                    <div class="row">													                                                    
                                                        <div class="form-group col-4 m-0">
                                                            <label class="form-label" for="direccion">Direccion</label>
                                                            <input type="text" class="form-control" id="direccion" name="direccion" value="{{old('direccion',$cliente->direccion)}}" />
                                                            @error('direccion')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-4 m-0">
                                                            <label class="form-label" for="telefono">Telefono</label>
                                                            <input type="text"   @error('telefono') class="form-control is-invalid"  
                                                            @enderror
                                                            class="form-control"  id="telefono" name="telefono"  value="{{old('telefono',$cliente->telefono)}}"/>
                                                            @error('telefono')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                        </div>
                                                        <div class="form-group col-4 m-0">
                                                            <label class="form-label" for="correo">Correo</label>
                                                            <input type="text"   @error('correo') class="form-control is-invalid"  
                                                            @enderror
                                                            class="form-control"  id="correo" name="correo"  value="{{old('correo',$cliente->correo)}}"/>
                                                            @error('correo')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror	
                                                        </div>
                                                    </div>
                                               
                                                    <div class="row">													                                                    
                                                        <div class="form-group col-4 m-0">
                                                            <label class="form-label" for="fechainicial">Fecha Inicial</label>
                                                            <input type="date" class="form-control  @error('fechainicial') is-invalid @enderror"  id="fechainicial" name="fechainicial" value="{{old('fechainicial',$cliente->fechainicial)}}" />
                                                            @error('fechainicial')
                                                                <br>
                                                                <small>*{{$message}}</small>
                                                                <br>
                                                            @enderror
                                                        </div>
                                                        <div class="form-group col-4 m-0">
                                                            <label class="form-label" for="fechafinal">Fecha Final</label>
                                                            <input type="date"   @error('fechafinal') class="form-control is-invalid"  
                                                            @enderror
                                                            class="form-control"  id="fechafinal" name="fechafinal"  value="{{old('fechafinal',$cliente->fechafinal)}}"/>
                                                            @error('fechafinal')
                                                            <br>
                                                            <small>*{{$message}}</small>
                                                            <br>
                                                        @enderror
                                                        </div>
                                                        <div class="form-group col-4 m-0">
                                                            <label class="form-label" for="idestado">Estado</label>
															<select class="form-select" id="idestado" name="idestado">
                                                                @foreach ($desplegables as $desplegable)
                                                                <option value="{{$desplegable->id}}" {{$desplegable->id == $cliente->idestado ? 'selected' : ''}}>{{$desplegable->nombre}}</option>
                                                                @endforeach
															</select>

                                                        </div>
                                                    </div>
                                                    

                                                    <div class="row">													                                                    
                                                        <div class="form-group col-4 m-0">
                                                         
                                                            <input type="hidden" class="form-control"  id="logo" name="logo" value="{{old('logo',$cliente->logo)}}" />
                                                        
                                                        </div>
                                                        
                                                    </div>
                                                    
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Editar Cliente</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')
<script src="/assets/js/plugins/dropzone/dropzone.min.js"></script>

<script>

    
       Dropzone.autoDiscover = false;
    const dropzone = new Dropzone('#dropzone',{
        dictDefaultMessage:'Buscar Logo Cliente',
        acceptedFiles:".pnh,.jpg,.jpeg,.png",
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
                this.options.thumbnail.call(this,imagenPublicada,`/storage/uploads/clienteslogos/${imagenPublicada.name}`);

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


