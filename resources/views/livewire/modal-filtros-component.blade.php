<div>
  
<div  class="modal fade" id="modal_filtro"   wire:ignore.self>
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Opciones</h5>
   
    </div>
    <div class="modal-body">

        @if($sedes->count() >0 )
            <div class="widget-reminder">
                <div class="widget-reminder-item">
                        <div class="widget-reminder-time">Sedes</div>
                        <div class="widget-reminder-content">
                            <div class="fs-13px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="todassedes" onClick="todos_sedes();" value="%" checked>
                                    <label class="form-check-label">Todo</label>
                                </div>
                                @foreach ($sedes as $sede)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$sede->codigo}}" name="sedes" onClick="check_sedes(this);"  checked>
                                    <label class="form-check-label">{{$sede->nombre}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
               </div>
            </div>
        @endif

        @if($salas->count() >0 )
            <div class="widget-reminder">
                <div class="widget-reminder-item">
                        <div class="widget-reminder-time">Salas</div>
                        <div class="widget-reminder-content">
                            <div class="fs-13px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="todassalas" onClick="todos_salas();" value="%" checked>
                                    <label class="form-check-label">Todo</label>
                                </div>
                                @foreach ($salas as $sala)
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" value="{{$sala->codigo}}" name="salas" onClick="check_salas(this);" checked>
                                    <label class="form-check-label">{{$sala->nombre}}</label>
                                </div>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        @endif


        @if($modalidades->count() >0 )
            <div class="widget-reminder">
                <div class="widget-reminder-item">
                        <div class="widget-reminder-time">Modalidades</div>
                        <div class="widget-reminder-content">
                            <div class="fs-13px">
                                <form name="Fmodalidades"> 
                                <div class="form-check">
                                    <input class="form-check-input"  id="todasmodalidades" onClick="todos_modalidades();"  value="%"  type="checkbox" checked>
                                    <label class="form-check-label">Todo</label>
                                </div>
                                @foreach ($modalidades as $modalidad)
                                <div class="form-check">
                                    <input class="form-check-input"  type="checkbox" name="modalidades" onClick="check_modalidades(this);" value="{{$modalidad->codigo}}" checked >
                                    <label class="form-check-label">{{$modalidad->codigo}}</label>
                                </div>
                            </form>
                                @endforeach
                            </div>
                        </div>
                </div>
            </div>
        @endif 
        @if($prioridades->count() >0 )
            <div class="widget-reminder">
                <div class="widget-reminder-item">
                        <div class="widget-reminder-time">Prioridades</div>
                        <div class="widget-reminder-content">
                            <div class="fs-13px">
                                <div class="col-xl-12">
                                    <div class="form-group mb-3">
                                        @foreach ($prioridades as $prioridad)
                                       
                                            <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="checkbox"  name="prioridades" onClick="check_prioridades(this);"  value="{{$prioridad->id}}" checked>
                                            <label class="form-check-label"><span class="{{$prioridad->color}}">{{$prioridad->nombre}}</span></label>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
            </div>
        @endif


        <div class="row"> 
        
            <div class="form-group col-9 m-0">   </div>                      
            <div class="form-group col-2 m-0">                        
                <button type="button" onclick="actulizar_filtros();" data-bs-dismiss="modal" class="btn btn-primary">Aceptar</button>
            </div>
        </div>
    </div>
    </div>
</div>
    
</div>
