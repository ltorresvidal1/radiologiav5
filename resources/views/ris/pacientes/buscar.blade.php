
@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">

@endpush

@extends('layouts.plantillaFormularios')
@section('title','Pacientes')

@section('nombrevista','Buscar Pacientes')
@section('hrefformulario')
{{route('rispacientes.index')}}
@endsection

@section('tituloformulario','Buscar Pacientes')
@section('principalformulario','BUSCAR PACIENTES')
@section('accionformulario','TODOS')
@section('descripcionformulario','')
@section('classformulario','')


@section('content')
                  
        <div class="row">			
                    
                <div class="form-group col-3 m-0">
                    <input type="text" class="form-control" placeholder="Documento"   id="documento" name="documento" value="{{old('documento')}}"  />
        
                </div>
            </div>
                <div class="row">	
                <div class="form-group col-3 m-0">
                    <input type="text" class="form-control" placeholder="Primer Nombre"  id="primernombre" name="primernombre"  value="{{old('primernombre')}}" />
                </div>
                <div class="form-group col-3 m-0">
                    <input type="text" class="form-control"  placeholder="Segundo Nombre" id="segundonombre" name="segundonombre"  value="{{old('segundonombre')}}" />
                </div>
                <div class="form-group col-3 m-0">
                    <input type="text" class="form-control"  placeholder="Primer Apellido"  id="primerapellido" name="primerapellido"  value="{{old('primerapellido')}}" />
                </div>
                <div class="form-group col-3 m-0">
                    <input type="text" class="form-control" placeholder="Segundo Apellido" id="segundoapellido" name="segundoapellido"  value="{{old('segundoapellido')}}" />
                </div>
            </div>
        <br>
            
                <div class="row">	

                    <div class="form-group col-5 m-0">   
                        <div class="mb-3 row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Fecha Inicial</label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" id="fechainicial" name="fechainicial" value="{{old('fechainicial')}}"/>
                            </div>
                        </div>
                    </div>
                    <div class="form-group col-5 m-0">   
                        <div class="mb-3 row">
                            <label for="inputEmail3" class="col-sm-5 col-form-label">Fecha Final</label>
                            <div class="col-sm-7">
                                <input type="date" class="form-control" id="fechafinal" name="fechafinal" value="{{old('fechafinal')}}" max="{{$fechaactual->format('Y-m-d')}}" />
                            </div>
                      </div>
                    </div>  
                    <div class="form-group col-2 m-0">   
                        <button id="idbuscar" class="btn btn-primary" onclick="validarDocumento()">Buscar</button>
                        <button class="btn btn-default" onclick="limpiarCampos()">Limpiar</button>

                    </div>  
                    
                    </div>  
                </div>


<br><br>
<div class="row">    
    <table id="datatableDefault" class="table table-striped table-bordered table-condensed" style="width:100%" >
        <thead>
            <tr>
                <th>Id</th>
                <th>Nombre del paciente</th>
                <th>Edad</th>
                <th>Estudio</th>
                <th>Modalidad</th>
                <th>Procedencia</th>
                <th>Fecha</th>
                <th>Prioridad</th>
                <th></th>                                                     
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>       
</div>
                                
<div  class="modal fade"  id="modal_soportes"  >
    <div class="modal-dialog modal-dialog-centered modal-lg"> 
    <div class="modal-content">
    <div class="modal-header">
    <h5 class="modal-title">Soportes</h5>
   
    </div>
    <div class="modal-body">


    <div class="row"> 
        
         
        <div class="card-body pb-2">
            <form id="formulario_soportes" action="{{route('guardarsoportes.store')}}" method="POST" enctype="multipart/form-data" >
                @csrf
                <input  type="hidden"  id="admision" name="admision">                       
            <div class="row"> 
                <div class="form-control">
                <div class="form-group row">
                    <label class="col-sm-4 col-form-label">
                        Historia clinica</label>
                        <div class="col-sm-1">
                            <button type="button" id="btnHistoria" class="btn btn-primary" style="display: none;">Ver</button>
                        </div>
                            <div class="col-sm-7">
                            <div>
                             <input type="file" class="form-control" id="filehistoria"  name="filehistoria"  accept=".pdf" max="5120"> 
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
                        <div class="col-sm-1">
                            <button type="button" id="btnOrden" class="btn btn-primary" style="display: none;">Ver</button>
                        </div>
                    <div class="col-sm-7">
                            <div> <input type="file" class="form-control" id="fileordenmedica"  name="fileordenmedica" accept=".pdf" max="5120" >       
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
                        <div class="col-sm-1">
                            <button type="button" id="btnConsentimiento" class="btn btn-primary" style="display: none;">Ver</button>
                        </div>
                    <div class="col-sm-7">
                            <div> <input type="file" class="form-control" id="fileconsentimiento" name="fileconsentimiento" accept=".pdf" max="5120">       
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
                        <div class="col-sm-1">
                            <button type="button" id="btnVerificacion" class="btn btn-primary" style="display: none;">Ver</button>
                        </div>
                    <div class="col-sm-7">
                            <div> <input type="file" class="form-control" id="fileverificacion" name="fileverificacion" accept=".pdf" max="5120">       
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="preload" style="display: none;">
                <i class="fa fa-spinner fa-spin"></i> Cargando...
            </div>
            <div class="modal-footer">
                <button type="submit" id="enviar" class="btn btn-success">Cargar</button>
                <button type="button" id="cerrar" class="btn btn-primary" data-bs-dismiss="modal">Cerrar</button>
               
            </div>
    
        </form>
         </div>

   
    </div>
    </div>
</div>
    
                                    
@endsection


@push('scripts')

<script src="/assets/js/btnEventos.js"></script>

<script src="/assets/js/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/assets/js/plugins/datatables/js/responsive.bootstrap4.min.js"></script>

<script>
    
    document.getElementById('formulario_soportes').addEventListener('submit', function(event) {
        event.preventDefault();
        
        $('#enviar, #cerrar').prop('disabled', true);

        $('#preload').show();


            $.ajax({
            url: $(this).attr('action'), 
            method: 'POST',
            data: new FormData(this), 
            processData: false,
            contentType: false,
            success: function(response) {
                $('#preload').hide();
                $('#enviar, #cerrar').prop('disabled', false);
            },
            error: function(xhr, status, error) {
                $('#preload').hide();
                $('#enviar, #cerrar').prop('disabled', false);
            }
        });
    });
</script>
  <script>


function validarDocumento() {

        var documento = document.getElementById("documento").value;

        if (documento.trim() === "") {
            alert("Por favor, ingresa un documento.");
        } else {
            
            $('#datatableDefault').DataTable().ajax.reload();

        }
}


function Versoportes(Admision){

     $('#modal_soportes').modal({backdrop: 'static', keyboard: false});
     $("#modal_soportes").modal("toggle");
     $('#modal_soportes').on('shown.bs.modal', function () { 
        $('#formulario_soportes')[0].reset();
        verificacionsoporte(Admision,'historia_clinica.pdf','btnHistoria');
        verificacionsoporte(Admision,'orden_medica.pdf','btnOrden');
        verificacionsoporte(Admision,'consenticonsentimiento_informado.pdf','btnConsentimiento');
        verificacionsoporte(Admision,'verificacion_derechos.pdf','btnVerificacion');
        document.getElementById("admision").value=Admision;
     });

}

function verificacionsoporte (admision,archivo,botonID){
    $.ajax({
            url: '/verificar-archivo/' + admision+'/' + archivo,
            type: 'GET',
            success: function(response) {
                if (response.existe) {
                    $("#" + botonID).show().click(function() {
                        window.open(response.url, '_blank');
                });
                } else {
                    $("#" + botonID).hide();
                }
            },
            error: function(xhr, status, error) {
                console.error('Error al verificar el archivo:', error);
            }
        });

}

function limpiarCampos() {
        var inputs = document.getElementsByTagName("input");
        for (var i = 0; i < inputs.length; i++) {
            inputs[i].value = "";
        }
    }


$('#datatableDefault').DataTable({
        language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
      dom: "<'row mb-3'<'col-sm-4'><'col-sm-4'l><'col-sm-4'f>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
      responsive: true,
      paging:false,
      autoWidth: false,
      ajax: {
            url: "{{route('datatable.buscarpacientes')}}",
            data: function (d){
                d.documento= document.getElementById("documento").value,
                d.primernombre= document.getElementById("primernombre").value,
                d.segundonombre= document.getElementById("segundonombre").value,
                d.primerapellido= document.getElementById("primerapellido").value,
                d.segundoapellido= document.getElementById("segundoapellido").value,
                d.fechainicial=$("#fechainicial").val().replaceAll('-', ''),
                d.fechafinal=$("#fechafinal").val().replaceAll('-', '')
            }
        },
        dataType:'json',
        type: "POST",
        order: [[0, 'desc']],
      
      "columnDefs": [
            { "visible": false, "targets": 0 },

        {
       className: '',
              "render": function ( data, type, row, meta ) {
                if(data=="1"){
                return '<span class="badge bg-info text-white rounded-sm fs-12px fw-500">Baja</span>';
                 }
                 if(data=="2"){
                return '<span class="badge bg-warning text-white rounded-sm fs-12px fw-500">Media</span>';
                 }
                 if(data=="3"){
                return '<span class="badge bg-danger text-white rounded-sm fs-12px fw-500">Alta</span>';
                 }
            },
            "targets": 7
        }
        ],
        columns:[
         {data:'id',orderable:false},
         {data:'nombre',orderable:false},
         {data:'edad',orderable:false},
         {data:'estudio',orderable:false},       
         {data:'modalidad',orderable:false},
        // {data:'modalidad',orderable:false},
         {data:'procedencia',orderable:false},
         {data:'fecha',orderable:false},
         {data:'prioridad',orderable:false},
         {data:'action',orderable:false},
          ]
          ,
      info:false,
    
    });  




</script>



  
@endpush
