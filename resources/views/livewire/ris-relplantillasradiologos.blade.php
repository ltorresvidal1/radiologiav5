<div>


<div wire:ignore >
                      
<table id="datatableDefault" class="table text-nowrap w-100">
    <thead>
        <tr>
            <th>Nombre</th>
            <th>Estado</th>
            <th>Usuarios</th>
            <th></th>                                                     
        </tr>
    </thead>
    <tbody>
        @foreach ($plantillas as $plantilla)
        <tr>
            <td>{{$plantilla->nombre}}</td>
            <td>{{$plantilla->estado}} </td>
            <td>
                <a  wire:click="$emit('addradiologo','{{$plantilla->id}}')" data-toggle="tooltip"  title="Agregar Radiologo"><i class="fa fa-user-md fa-fw fa-lg"></i></a>
             </td>
            <td>
             
                <div class="dropdown text-center">
                    <a href="#" data-bs-toggle="dropdown" class="text-decoration-none"><i class="fa fa-ellipsis-v fa-fw fa-lg"></i> </a>
                    <div class="dropdown-menu">
                       
                        <a href="{{ route('risplantillas.edit', $plantilla->id) }}" class="dropdown-item"><i class="far fa-edit fa-fw fa-lg"></i> Editar</a>
                        <form id="delete-{{$plantilla->id}}" action="{{route('risplantillas.destroy',$plantilla)}}" method="POST">
                            @csrf
                            @method('DELETE')
                        </form>
                        <a href="#" class="dropdown-item"  onclick="EliminarPlantilla('{{ $plantilla->id }}')"><i class="far fa-trash-alt fa-fw fa-lg"></i> Eliminar</a>
                    </div>
                </div>

       
            </td>
         </tr>
        
        @endforeach
    </tbody>    
</table>    
    
</div>

<div class="modal fade" id="modalasignarradiologo"  style="display: none;"   wire:ignore.self>
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Agregar Radiólogos a Plantillas</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
                </div>
                <div class="modal-body">
                   
                <form wire:submit.prevent="store">
                    
                    <div class="row"> 
                        <div class="form-group col-10 m-0">
                            
                            <label class="form-label" for="idradiologo">Radiólogos</label><label class="obligatorio">*</label> 
                            <div class="form-control @error('idradiologo') is-invalid @enderror">
                                <div>
                                    <select class="form-select-sinborde" wire:model="idradiologo">
                                    <option value="">--- Seleccionar ---</option>
                                    @foreach ($radiologos as  $radiologo)
                                    <option value="{{$radiologo->id}}">{{$radiologo->nombre}}</option>
                                    @endforeach
                                 </select>        
                          </div>
                        </div>
                      
                        </div>
                        <div class="form-group col-2 m-0">   
                                            <br>                       
                            <button type="submit" class="btn btn-primary">Asociar</button>
                        </div>
                    </div>
                </form>
                <br><br>

                
                <table id="relplantillasradiologos" style="width:100%" class="table text-nowrap w-100">
                    <thead>
                        <tr>
                            <th>Radiólogo</th>
                            <th>Acciones</th>                                                     
                        </tr>
                    </thead>
                    <tbody>     
                        @foreach ($relplantillas as  $relplantilla)
                        <tr>
                            <td>{{$relplantilla->nombre}}</td>
                            <td>
                                 <a href="#" class="dropdown-item" wire:click="$emit('elimarregistro','{{$relplantilla->id}}')"><i class="far fa-trash-alt fa-fw fa-lg"></i> Eliminar</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>      
       
                </div>
            </div>
        </div>
    </div>

     
</div>



@push('scripts')

    <script>

window.addEventListener('show-modal', () => {

    $('#modalasignarradiologo').modal({backdrop: 'static', keyboard: false});
     $("#modalasignarradiologo").modal("toggle");
     $('#modalasignarradiologo').on('shown.bs.modal', function () { });

})

    </script>
@endpush