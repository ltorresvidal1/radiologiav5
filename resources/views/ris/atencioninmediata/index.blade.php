@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">
		<link href="/assets/js/plugins/summernote/css/summernote-lite.css" rel="stylesheet" />
        
        
@endpush



@extends('layouts.plantillaAtencioninmediata')

@section('title','RADIOLOGIA')
@section('tituloformulario','Atención inmediata')



@section('content')

<div class="d-flex align-items-center mb-2">
                    
  <div class="form-group col-11 m-0">
 
  </div>     
  <div class="form-group col-1 m-0">
      <div>
          <button type="button" class="btn btn-primary mb-1 btn-sm" onclick="AbrirModalFiltros()">
              <i class="fa fa-cog"></i> Filtros
          </button>

      </div>     
      </div>     
 
</div>


@livewire('ris-atencion')     

@livewire('modal-filtrossalas-component')                                  
@endsection


@push('scripts')


<script src="/assets/js/btnEventos.js"></script>
<script src="/assets/js/funcionesAtencioninmediata.js"></script>



{{-- @vite('resources/js/app.js') --}}

<script type="module">
/*
    Echo.channel('escuchandoestudiosporvalidar').listen('estudioporvalidarEvent',(e) => {
        console.log("estudioporvalidarEvent"+e.message);
         if(e.message=="actualizar"){
          $('#tabletab4').DataTable().ajax.reload();
         }
         
      });
*/
  </script>

@endpush
