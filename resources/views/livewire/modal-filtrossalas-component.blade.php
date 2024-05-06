<div>
  
<div  class="modal fade" id="modal_filtrosalas"   wire:ignore.self>
    <div class="modal-dialog">
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Opciones</h5>
   
    </div>
    <div class="modal-body">

        @if($salasfiltro->count() >0 )
            <div class="widget-reminder">
                <div class="widget-reminder-item">
                        <div class="widget-reminder-time">Salas</div>
                        <div class="widget-reminder-content">
                            <div class="fs-13px">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="todassalas" onClick="todos_salas();" value="%" checked>
                                    <label class="form-check-label">Todo</label>
                                </div>
                                @foreach ($salasfiltro as $sala)
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
