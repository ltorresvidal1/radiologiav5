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
                    
                    <th></th>                                                     
                </tr>
            </thead>
            <tbody>
                @foreach ($tansitos as $tansito)
                <tr>
                    <td>{{$tansito->id}}</td>
                    <td>{{$tansito->nombre}}</td>
                    <td>{{$tansito->admision}}</td>
                    <td>{{$tansito->fecha}}</td>
                    <td>{{$tansito->estudio}}</td>
                    
                    <td>
                        <a  wire:click="$emit('addatencion','{{$tansito->id}}')" data-toggle="tooltip"  title="Procesar"><i class="fa fa-share fa-fw fa-lg"></i></a>
            
                    </td>
                 </tr>
                
                @endforeach
              
            
            </tbody>
        </table>       
        
        
    </div>
    


<div class="modal fade" id="modalatencionsinmediata"  style="display: none;"   wire:ignore.self>
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Atención Inmediata</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">X</button>
            </div>
            <div class="modal-body">
               <h1>holaa</h1>
            </div>
        </div>
    </div>
</div>

 

</div>
     

@push('scripts')

    <script>
console.log("cargado");
    window.addEventListener('show-modal', () => {
console.log("entrando");
        $('#modalatencionsinmediata').modal({backdrop: 'static', keyboard: false});
        $("#modalatencionsinmediata").modal("toggle");
        $('#modalatencionsinmediata').on('shown.bs.modal', function () { });

    })

    </script>
@endpush
    