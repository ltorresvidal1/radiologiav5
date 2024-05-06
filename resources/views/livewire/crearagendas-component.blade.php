<div>
 
    <form wire:submit.prevent="store">
        
            
                    <div class="row">	
                        <div class="form-group col-6 m-0">
                            <label class="form-label" for="sede">Sedes</label>
                            <select class="form-select  @error('sede') is-invalid @enderror" id="sede" name="sede"  wire:model="sede" >
                                <option value="0">Seleccionar</option>
                                @foreach ($sedes as $sede)
                                <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-6 m-0">
                            <label class="form-label" for="sala">Salas</label>
                            <select class="form-select  @error('sala') is-invalid @enderror" id="sala" name="sala"  wire:model="sala" >
                                @if($salas->count() ==0 )
                                <option value="">selecionar una sede</option>
                                @endif
                                @foreach ($salas as $sala)
                                <option value="{{$sala->id}}">{{$sala->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">	

                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="fechainicial">Fecha Inicial </label><label class="obligatorio">*</label> 
                        <div class="col">
                            <input type="date" class="form-control  @error('fechainicial') is-invalid @enderror"  id="fechainicial" wire:model="fechainicial"  min="{{$fechaactual->format('Y-m-d')}}" />
                                              
                        </div>
                        
                    </div>
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="horainicial">Hora Inicial </label><label class="obligatorio">*</label> 
                        <div class="input-group bootstrap-timepicker timepicker">
                         
                            <input id="horainicial" type="text" class="form-control @error('horainicial') is-invalid @enderror" readonly  wire:model="horainicial" >
                            <span class="input-group-addon input-group-text">
                            <i class="fa fa-clock"></i>
                            </span>
                        </div>
                    </div>
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="fechafinal">Fecha Final </label><label class="obligatorio">*</label> 
                        <div class="col">
                            <input type="date" class="form-control  @error('fechafinal') is-invalid @enderror"  id="fechafinal" name="fechafinal" wire:model="fechafinal"  min="{{$fechaactual->format('Y-m-d')}}"    />
                                                  
                        </div>
                    </div>
                    <div class="form-group col-3 m-0">
                        <label class="form-label" for="horafinal">Hora Final </label><label class="obligatorio">*</label> 
                        <div class="input-group bootstrap-timepicker timepicker">
                         
                            <input id="horafinal" type="text" class="form-control  @error('horafinal') is-invalid @enderror" readonly wire:model="horafinal" >
                            <span class="input-group-addon input-group-text">
                            <i class="fa fa-clock"></i>
                            </span>
                        </div>
                    </div>
                </div>
                    <div class="row"> 
                        <div class="form-group col-8 m-0">
                            <label class="form-label">Dias</label><label class="obligatorio">*</label> 
                            <div class="col">
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="lunes" type="checkbox" value="1" wire:model.defer="dias">
                                    <label class="form-check-label" for="lunes" >Lunes</label>
                                    </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="martes" type="checkbox" value="2" wire:model.defer="dias">
                                    <label class="form-check-label" for="martes">Martes</label>
                                    </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="miercoles" type="checkbox" value="3" wire:model.defer="dias">
                                    <label class="form-check-label" for="miercoles">Miercoles</label>
                                </div>
                                
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="jueves" type="checkbox" value="4" wire:model.defer="dias">
                                    <label class="form-check-label" for="jueves">Jueves</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="viernes" type="checkbox" value="5" wire:model.defer="dias">
                                    <label class="form-check-label" for="viernes">Viernes</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="sabado" type="checkbox" value="6" wire:model.defer="dias">
                                    <label class="form-check-label" for="sabado">Sabado</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" id="domingo" type="checkbox" value="7" wire:model.defer="dias">
                                    <label class="form-check-label" for="domingo">Domingo</label>
                                </div>
                            </div>
                        </div>
                    <div class="form-group col-4 m-0">
                        <label class="form-label" for="estado">Estado</label>
                        <select class="form-control"  wire:model="estado" >
                            @foreach ($estados as $estado)
                            <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>


            
            <div class="row">    
                
                <div class="form-group col-3 m-0">   
                    <br>                                                     
                    <button type="submit" class="btn btn-primary">Crear Agenda</button>
                </div>
            </div>

    </form>
</div>
