<div>

    
<div wire:ignore >
                      
<table id="datatableDefault" class="table text-nowrap w-100">
    <thead>
        <tr>
            <th></th>  
            <th>Paciente</th>
            <th>Admision</th>
            <th>Fecha</th>
            <th>Estudio</th>
                                                               
        </tr>
    </thead>
    <tbody>
        @foreach ($transitos as $transito)
        <tr> <td>
                <a  wire:click="$emit('addatencion','{{$transito->id}}','{{$transito->fecha}}','{{$transito->idpaciente}}','{{$transito->admision}}','{{$transito->medico}}','{{$transito->prioridad}}','{{$transito->procedencia}}','{{$transito->convenio_id}}')" data-toggle="tooltip"  title="Procesar"><i class="fa fa-share fa-fw fa-lg"></i></a>
             </td>
             
            <td>{{$transito->nombre}}</td>
            <td>{{$transito->admision}} </td>
            <td>{{$transito->fecha}} </td>
            <td>{{$transito->estudio}} </td>
           
             
         </tr>
        
        @endforeach
    </tbody>    
</table>    
    
</div>

<div class="modal fade" id="modalatencionsinmediata"  style="display: none;"   wire:ignore.self>
        <div class="modal-dialog modal-fullscreen">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Atención Inmediata</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                   
                    <div id="contenidopaciente">
                        <div class="card">
                            <div class="card-body">
                                <div id="validation" class="mb-5">    
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h1 class="page-header mb-0">Datos Paciente</h1>
                                        </div>     
                                    </div>
                                    <div class="mb-5">
                                        <div>
                                            <div>
                                                <div class="card-body pb-2">
                                                    
                                                    <form wire:submit.prevent="storepaciente">                                             
                                                        <div class="row">			
                                                            <div class="form-group col-3 m-0">
                                                                <label class="form-label" for="idtipoid">Tipo Id</label><label class="obligatorio">*</label> 
                                                                <select class="form-select @error('idtipoid') is-invalid @enderror" wire:model.defer="idtipoid">
                                                                    <option value="">Seleccionar</option>
                                                                    @foreach ($tipoid as $tipo)
                                                                    <option value="{{$tipo->id}}">{{$tipo->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                            
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="documento">Documento</label>  <label class="obligatorio">*</label> 
                                                                
                                                                    <input type="text" class="form-control @error('documento') is-invalid @enderror"  wire:model.defer="documento" />

                                                                    @error('documento')
                                                                        <br>
                                                                        <small>*{{$message}}</small>
                                                                        <br>
                                                                    @enderror
                                                                </div>
                                                            </div>
                                                                <br>
                                                                <div class="row">	
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="primernombre">Primer Nombre</label><label class="obligatorio">*</label> 
                                                                    <input type="text" class="form-control @error('primernombre') is-invalid @enderror"  wire:model.defer="primernombre"  /> 
                                                                        @error('primernombre')
                                                                        <br>
                                                                        <small>*{{$message}}</small>
                                                                        <br>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="segundonombre">Segundo Nombre</label>
                                                                    <input type="text" class="form-control"    wire:model.defer="segundonombre"/>  
                                                                       
                                                                </div>
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="primerapellido">Primer Apellido</label><label class="obligatorio">*</label> 
                                                                    <input type="text" class="form-control @error('primerapellido') is-invalid @enderror"    wire:model.defer="primerapellido"/>    
                                                                        @error('primerapellido')
                                                                        <br>
                                                                        <small>*{{$message}}</small>
                                                                        <br>
                                                                    @enderror
                                                                </div>
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="segundoapellido">Segundo Apellido</label>
                                                                    <input type="text" class="form-control"  id="segundoapellido" name="segundoapellido"     wire:model.defer="segundoapellido"/>   
                                                                     
                                                                    
                                                                </div>
                                                            </div>
                                                        
                                                            <br>
                                                                <div class="row">	
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="fechanacimiento">Fecha Naciemiento </label><label class="obligatorio">*</label> 
                                                                    <div class="col">
                                                                        <input type="date" class="form-control  @error('fechanacimiento') is-invalid @enderror"   wire:model.defer="fechanacimiento" max="{{$fechaactual}}" />
                                                                                                @error('fechanacimiento')
                                                                                                    <br>
                                                                                                    <small>*{{$message}}</small>
                                                                                                    <br>
                                                                                                @enderror
                                                                    </div>
                                                                    
                                                                </div>
        
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="idsexo">Sexo</label><label class="obligatorio">*</label> 
                                                                    <select class="form-select  @error('idsexo') is-invalid @enderror" wire:model.defer="idsexo">
                                                                        <option value="">Seleccionar</option>
                                                                        @foreach ($sexos as $sexo)
                                                                        <option value="{{$sexo->id}}">{{$sexo->nombre}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                                <div class="form-group col-6 m-0">
                                                                        <label class="form-label" for="correo">Correo </label>
                                                                        <input type="text" class="form-control"  wire:model.defer="correo" />
                                                                </div>
                                                               
                                                            </div>
                                                       <br>
                                                            <div class="row">	
                                                                <div class="form-group col-6 m-0">
                                                                    <label class="form-label" for="direccion">Direccion </label>
                                                                    <input type="text" class="form-control"  wire:model.defer="direccion"/>
                                                                </div>
                                                                <div class="form-group col-6 m-0">
                                                                    <label class="form-label" for="barrio">Barrio </label>
                                                                    <input type="text" class="form-control"  wire:model.defer="barrio"/>  
                                                                </div>
                                                                            
                                                            </div>
                                                            <br>
                                                                 <div class="row">	
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="celular">Celular </label><label class="obligatorio">*</label> 
                                                                    <input type="text" class="form-control @error('celular') is-invalid @enderror"   wire:model.defer="celular"/>   
                                                                    @error('celular')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                              
                                                                </div>
                                                                <div class="form-group col-3 m-0">
                                                                    <label class="form-label" for="telefono">Telefono </label>
                                                                    <input type="text" class="form-control"  id="telefono" name="telefono" wire:model.defer="telefono"/> 
                                                                </div>
        
                                                                <div class="form-group col-6 m-0">
                                                                    <label class="form-label" for="políticaprivacidad">¿Se indicó al titular de datos personales sus derechos, canales de atención y cual será el tratamiento sobre la información que se da? ¿Autoriza el tratamiento de sus datos personales? <label class="obligatorio">*</label> </label>
                                                                    
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios1" value="Si" checked="" data-gtm-form-interact-field-id="1">
                                                                        <label class="form-check-label" for="gridRadios1">Si</label>
                                                                    </div>
                                                                    <div class="form-check">
                                                                        <input class="form-check-input" type="radio" name="gridRadios" id="gridRadios2" value="No" data-gtm-form-interact-field-id="0">
                                                                        <label class="form-check-label" for="gridRadios2"> No </label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">    
                                                                
                                                                <div class="form-group col-3 m-0">   
                                                                    <br>                                                     
                                                                    <button type="submit" class="btn btn-primary">Actualizar paciente</button>
                                                                </div>
                                                            </div>
        
                                                    </form>  
                                                    
                                                </div>
                                            </div>                                
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="contenidohistoria">
                        <div class="card">
                            <div class="card-body">
                                <div id="validation" class="mb-5">    
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h1 class="page-header mb-0">Datos clínicos </h1>
                                        </div>     
                                    </div>
                                    <div class="mb-5">
                                        <div>
                                            <div>
                                                <div class="card-body pb-2">
                                                  
                                                        
                                                        <div class="row">    
                                                            
                                                            <div class="form-group col-3 m-0">
                                                                <label class="form-label" for="políticaprivacidad">Trae información clínica <label class="obligatorio">*</label> </label>
                                                              
                                                                <div class="form-group mb-3">
                                                                    <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" name="default_radio" type="radio" id="inlineRadio1" value="option1" checked="">
                                                                    <label class="form-check-label" for="inlineRadio1">Si</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                    <input class="form-check-input" name="default_radio" type="radio" id="inlineRadio2" value="option2" >
                                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                                    </div>
                                                                    
                                                                    
                                                                    </div>
                                                            </div>
                                                            <div class="form-group col-3 m-0">
                                                                <label class="form-label"> Medico Remintente </label>
                                                              
                                                                <div class="form-control @error('idmedicoremintente') is-invalid @enderror">
                                                                    <div>
                                                                        <select class="form-select-sinborde" wire:model.defer="idmedicoremintente">
                                                                        <option value="">--- Seleccionar ---</option>
                                                                        @foreach ($medicosremintentes as  $medicoremintente)
                                                                        <option value="{{$medicoremintente->codigo}}">{{$medicoremintente->nombre}}</option>
                                                                        @endforeach
                                                                        </select>        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-3 m-0">
                                                                <label class="form-label"> Prioridad <label class="obligatorio">*</label> </label>
                                                              
                                                                <div class="form-control @error('idprioridad') is-invalid @enderror">
                                                                    <div>
                                                                        <select class="form-select-sinborde" wire:model.defer="idprioridad">
                                                                        <option value="">--- Seleccionar ---</option>
                                                                        @foreach ($prioridades as  $prioridad)
                                                                        <option value="{{$prioridad->id}}">{{$prioridad->nombre}}</option>
                                                                        @endforeach
                                                                        </select>        
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-3 m-0">
                                                                <label class="form-label"> Procedencia <label class="obligatorio">*</label> </label>
                                                              
                                                                <div class="form-control @error('idprocedencia') is-invalid @enderror">
                                                                    <div>
                                                                        <select class="form-select-sinborde" wire:model.defer="idprocedencia">
                                                                        <option value="">--- Seleccionar ---</option>
                                                                        @foreach ($procedencias as  $procedencia)
                                                                        <option value="{{$procedencia->codigo}}">{{$procedencia->nombre}}</option>
                                                                        @endforeach
                                                                        </select>        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            
                                                        </div>
                                                        <div class="row"> 
                                                            <div class="form-group col-4 m-0">
                                                                <label class="form-label"> Médico asignado <label class="obligatorio">*</label> </label>
                                                              
                                                                <div class="form-control @error('idmedico') is-invalid @enderror">
                                                                    <div>
                                                                        <select class="form-select-sinborde" wire:model.defer="idmedico">
                                                                        <option value="">--- Seleccionar ---</option>
                                                                        @foreach ($medicos as  $medico)
                                                                        <option value="{{$medico->id}}">{{$medico->nombre}}</option>
                                                                        @endforeach
                                                                        </select>        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="form-group col-4 m-0">
                                                                <label class="form-label"> Convenio <label class="obligatorio">*</label> </label>
                                                              
                                                                <div class="form-control @error('idconvenio') is-invalid @enderror">
                                                                    <div>
                                                                        <select class="form-select-sinborde" wire:model.defer="idconvenio">
                                                                        <option value="">--- Seleccionar ---</option>
                                                                        @foreach ($convenios as  $convenios)
                                                                        <option value="{{$convenios->id}}">{{$convenios->nombre}}</option>
                                                                        @endforeach
                                                                        </select>        
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-3 m-0">
                                                                <label class="form-label" >CIE 10</label>  <label class="obligatorio">*</label> 
                                                               
                                                            <div>
                                                                <input type="text" class="form-control form-control-lg @error('cie10') is-invalid @enderror"   maxlength="4" wire:model.defer="cie10"/>

                                                                @error('cie10')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                             </div>

                                                        </div>
                                                
                                                    
                                                </div>
                                            </div>                                
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>
                    <div id="contenidservicios">
                        <div class="card">
                            <div class="card-body">
                                <div id="validation" class="mb-5">    
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h1 class="page-header mb-0">Datos servicios </h1>
                                        </div>     
                                    </div>
                                    <div class="mb-5">
                                        <div>
                                            <div>
                                                <div class="card-body pb-2">
                                                    <form wire:submit.prevent="storeservicios">
                                                        
                                                        <div class="row"> 
                                                            
                                                            <div class="form-group col-8 m-0">

                                                                <div class="form-group row mb-3">
                                                                    <label for="staticEmail" class="col-sm-2 col-form-label">Servicio <label class="obligatorio">*</label></label>
                                                                    <div class="col-sm-10">
                                                                        <div class="form-control @error('idservicio') is-invalid @enderror">
                                                                            <div>
                                                                                <select class="form-select-sinborde" wire:model="idservicio">
                                                                                <option value="">--- Seleccionar ---</option>
                                                                                @foreach ($servicios as  $servicio)
                                                                                <option value="{{$servicio->id}}">{{$servicio->nombre}}</option>
                                                                                @endforeach
                                                                                </select>        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                         </div>            
                                                        <div class="form-group col-4 m-0">   
                                        

                                                                <div class="form-group row mb-3">
                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">Modalidad <label class="obligatorio">*</label></label>
                                                                    <div class="col-sm-8">
                                                                        <div class="form-control @error('idmodalidad') is-invalid @enderror">
                                                                            <div>
                                                                                <select class="form-select-sinborde"  wire:model="idmodalidad">
                                                                                @if ($modalidades->count()==0 )
                                                                                <option value="">Selecionar un servicio</option>
                                                                                @endif
                                                                                @foreach ($modalidades as  $modalidad)
                                                                                <option value="{{$modalidad->id}}">{{$modalidad->codigo}}</option>
                                                                                @endforeach
                                                                                </select>        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                         </div>                                  
                                                        </div>    
                                                        
                                                        
                                                        <div class="row"> 
                                                            
                                                            <div class="form-group col-8 m-0">

                                                                <div class="form-group row mb-3">
                                                                    <label for="staticEmail" class="col-sm-2 col-form-label">Salas <label class="obligatorio">*</label></label>
                                                                    <div class="col-sm-10">
                                                                        <div class="form-control @error('idsala') is-invalid @enderror">
                                                                            <div>
                                                                                <select class="form-select-sinborde"   wire:model="idsala">
                                                                                @if ($salas->count()==0 )
                                                                                    <option value="">Selecionar una modalidad</option>
                                                                                @endif
                                                                                @foreach ($salas as  $sala)
                                                                                <option value="{{$sala->id}}">{{$sala->nombre}}</option>
                                                                                @endforeach
                                                                                </select>        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>    
                                                            <div class="form-group col-4 m-0">   
                                        

                                                                <div class="form-group row mb-3">
                                                                    <label for="staticEmail" class="col-sm-4 col-form-label">
                                                                        Finalidad del procedimiento <label class="obligatorio">*</label></label>
                                                                    <div class="col-sm-8">
                                                                        <div class="form-control @error('idfinalidad') is-invalid @enderror">
                                                                            <div>
                                                                                <select class="form-select-sinborde" wire:model="idfinalidad">
                                                              
                                                                                @foreach ($finalidades as  $finalidad)
                                                                                <option value="{{$finalidad->id}}">{{$finalidad->nombre}}</option>
                                                                                @endforeach
                                                                                </select>        
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                         </div>  
                                                        </div>
                                                        
                                                        <div class="row"> 
                                                        <div class="form-group col-2 m-0">   
                                                            <br>                       
                                                            <button type="submit" class="btn btn-primary">Agregar</button>                                   
                                                        </div>    
                                                    </div>
                                                    
                                                    </form>  
                                                    <br><br>

                                                    <div wire:model.lazy>
                
                <table id="servicioscargados" style="width:100%" class="table text-nowrap w-100">
                    <thead>
                        <tr>
                            <th>Servicio</th>
                            <th>Modalidad</th>
                            <th>Sala</th>
                            <th>Finalidad</th>   
                            <th></th>                                                     
                        </tr>
                    </thead>
                    <tbody>     
                        @foreach ($relservicios as  $relservicio)
                        <tr>
                            <td>{{$relservicio->servicio}}</td>
                            <td>{{$relservicio->modalidad}}</td>
                            <td>{{$relservicio->sala}}</td>
                            <td>{{$relservicio->finalidad}}</td>

                            <td>
                                 <a href="#" class="dropdown-item" wire:click="$emit('elimarregistro','{{$relservicio->id}}')"><i class="far fa-trash-alt fa-fw fa-lg"></i> Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                        
                    </tbody>
                </table>  </div>
                                                </div>
                                            </div>                                
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br>
                    <div id="contenidosoporte">
                        <div class="card">
                            <div class="card-body">
                                <div id="validation" class="mb-5">    
                                    <div class="d-flex align-items-center mb-3">
                                        <div>
                                            <h1 class="page-header mb-0">Soportes clínicos </h1>
                                        </div>     
                                    </div>
                                    <div class="mb-5">
                                        <div>
                                            <div>
                                                <div class="card-body pb-2">
                                                        
                                                        <div class="row"> 
                                                            <div class="form-control">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">
                                                                    Historia clinica</label>
                                                                <div class="col-sm-8">
                                                                   
                                                                        <div> 
                                                                            
                                                                         <input type="file" class="form-control" wire:model.defer="filehistoria"  wire:change="cargarfilehistoria" accept=".pdf" max="5120">    
                                        
                                                                           
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row"> 
                                                            <div class="form-control">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">
                                                                    Orden medica</label>
                                                                <div class="col-sm-8">
                                                                   
                                                                        <div> <input type="file" class="form-control" wire:model.defer="fileordenmedica" accept=".pdf" max="5120" wire:change="cargarfileordenmedica">       
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row"> 
                                                            <div class="form-control">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">
                                                                    Consentimiento informado</label>
                                                                <div class="col-sm-8">
                                                                   
                                                                        <div> <input type="file" class="form-control" wire:model.defer="fileconsentimiento" accept=".pdf" max="5120" wire:change="cargarfileconsentimiento">       
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row"> 
                                                            <div class="form-control">
                                                            <div class="form-group row">
                                                                <label class="col-sm-4 col-form-label">
                                                                    Verificacion de derechos</label>
                                                                <div class="col-sm-8">
                                                                   
                                                                        <div> <input type="file" class="form-control" wire:model.defer="fileverificacion" accept=".pdf" max="5120" wire:change="cargarfileverificacion">       
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    
                                                </div>
                                            </div>                                
                                         </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>    
                    <div class="form-control">
                    <div class="row"> 
                   
                    <div class="form-group col-2 m-0">
                        <button class="btn btn-primary" wire:click="$emit('cerrarmodal')">Cancelar</button>
                    </div>
                    <div class="form-group col-2 m-0">
                        <form wire:submit.prevent="storeatencion">
                    
                         <button class="btn btn-success" >Enviar </button>
                     </form>
                     </div>
                     <div class="form-group col-8 m-0">
                        @error('idtipoid')<small>*{{$message}}</small><br>@enderror
                        @error('documento')<small>*{{$message}}</small><br>@enderror
                        @error('primernombre')<small>*{{$message}}</small><br>@enderror
                        @error('primerapellido')<small>*{{$message}}</small><br>@enderror
                        @error('fechanacimiento')<small>*{{$message}}</small><br>@enderror
                        @error('celular')<small>*{{$message}}</small><br>@enderror
                        @error('idprioridad')<small>*{{$message}}</small><br>@enderror
                        @error('idprocedencia')<small>*{{$message}}</small><br>@enderror
                        @error('idmedico')<small>*{{$message}}</small><br>@enderror
                        @error('idconvenio')<small>*{{$message}}</small><br>@enderror
                        @error('idconvenio')<small>*{{$message}}</small><br>@enderror
                        @error('cie10')<small>*{{$message}}</small><br>@enderror
                        @error('relservicios')<small>*Debe cargar un servicios</small><br>@enderror
                          
                    </div>
                   


                     </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

     
</div>



@push('scripts')


<script>

window.addEventListener('show-modal', () => {

    $('#modalatencionsinmediata').modal({backdrop: 'static', keyboard: false});
     $("#modalatencionsinmediata").modal("toggle");
     $('#modalatencionsinmediata').on('shown.bs.modal', function () { });

})
window.addEventListener('close-modal', () => {
    $('#modalatencionsinmediata').modal('hide');
});
    </script>
@endpush