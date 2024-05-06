@extends('layouts.plantillaFormularios')

@push('css')
<link href="/assets/js/plugins/summernote/css/summernote-lite.css" rel="stylesheet" />
@endpush
@section('title','Crear Plantillas')

@section('nombrevista','Plantillas')
@section('hrefformulario')
{{route('risplantillas.index')}}
@endsection

@section('tituloformulario','Plantillas')
@section('principalformulario','PLANTILLAS')
@section('accionformulario','CREAR')
@section('descripcionformulario','Crear nueva plantilla')
@section('classformulario','card')



@section('content') 



											<form action="{{route('risplantillas.store')}}" method="POST">
                                                @csrf
                                                
                                                    
                                                            <div class="row">	
                                                            <div class="form-group col-8 m-0">
                                                                <label class="form-label" for="nombre">Nombre</label><label class="obligatorio">*</label> 
                                                                <input type="text" class="form-control @error('nombre') is-invalid @enderror"  id="nombre" name="nombre"  value="{{old('nombre')}}" />
                                                                    @error('nombre')
                                                                    <br>
                                                                    <small>*{{$message}}</small>
                                                                    <br>
                                                                @enderror
                                                            </div>
                                                            <div class="form-group col-4 m-0">
                                                                <label class="form-label" for="idestado">Estado</label>
                                                                <select class="form-select" id="idestado" name="idestado">
                                                                    @foreach ($estados as $estado)
                                                                    <option value="{{$estado->id}}">{{$estado->nombre}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
<br>
                                                        <div class="row">			
                                                            <textarea name="plantilla" id='plantilla' class="summernote form-control  @error('plantilla') is-invalid @enderror" >{{old('plantilla')}}</textarea> 
                                                            @error('plantilla')
                                                                                                    <br>
                                                                                                    <small>*{{$message}}</small>
                                                                                                    <br>
                                                                                                @enderror
                                                         </div>
                                                    
                                                    <div class="row">    
                                                        
                                                        <div class="form-group col-3 m-0">   
                                                            <br>                                                     
                                                            <button type="submit" class="btn btn-primary">Crear plantilla</button>
                                                        </div>
                                                    </div>

											</form>
      
@endsection


@push('scripts')


<script src="/assets/js/plugins/summernote/js/summernote-lite.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-es-ES.min.js"></script>



<script>
    $(document).ready(function() {
	handleRenderSummernote1();
});

var handleRenderSummernote1 = function() {

    var totalHeight = ($(window).height() /2)-70;

    $('#plantilla').summernote({
        lang: 'es-ES' ,
        height: totalHeight,
        disableDragAndDrop: true,           
        placeholder:"Digite la plantilla",
        toolbar: [
            ['font', ['bold', 'italic',  'underline', 'clear']],
            ['para', ['ul', 'ol','paragraph']],
            ['table', ['table']],
            ['view', ['fullscreen']],
        ],
        callbacks: {
        onPaste: function (e) {
        
        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        e.preventDefault();
        document.execCommand('insertText', false, bufferText);
    }
    }
    });
    



};

</script>
@endpush


