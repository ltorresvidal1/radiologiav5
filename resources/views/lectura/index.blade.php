@push('css')
<link href="/assets/js/plugins/datatables/css/dataTables.bootstrap4.min.css" rel="stylesheet" >
        <link href="/assets/js/plugins/datatables/css/responsive.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/datatables/css/buttons.bootstrap4.min.css" rel="stylesheet">
        <link href="/assets/js/plugins/summernote/css/summernote-lite.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/select/1.4.0/css/select.dataTables.min.css" rel="stylesheet" />

       <style>



.wrapper{
  user-select: none;
  width: 100%;
}
.wrapper .time{
  height: 20px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 6px;
  padding: 0 10px;
}
.wrapper .time span{
  width: 30px;
  text-align: center;
  font-size: 16px;
  font-weight: 500;
  color: #ffffff;
}
.time span.colon{
  width: 10px;
}
.time span.ms-colon,
.time span.millisecond{
  color: #e82a2a;
}
.wrapper .buttons{
  text-align: center;
  margin-top: 20px;
}
.buttons button{
  padding: 6px 16px;
  outline: none;
  border: none;
  margin: 0 5px;
  color: #ffffff;
  font-size: 12px;
  font-weight: 500;
  border-radius: 4px;
  cursor: pointer;
  box-shadow: 10px 10px 20px rgba(0,0,0,0.09);
}
.buttons button.active,
.buttons button.stopActive{
  pointer-events: none;
  color: #FEC35E;
}


.centrado-microfono {
    position: absolute;
    left: 50%;
    top: 55%;
    transform: translate(-50%, -50%);
    -webkit-transform: translate(-50%, -50%);
}
       </style>
@endpush



@extends('layouts.plantillaLectura')
@section('title','RADIOLOGIA')


@section('content')

<div id="content" class="app-content p-0">
  <div class="mailbox">

 
      <div class="mailbox-toolbar">
          <div class="mailbox-toolbar-item"><span class="mailbox-toolbar-text">Opciones de Lectura</span></div>
          <ul class="nav nav-pills mb-3" role="tablist">
              <li class="mailbox-toolbar-item" id='BtnAddLecturas' role="presentation"><a id="m1" href="#AddLectura" class="mailbox-toolbar-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Agregar Lecturas</a></li>
              <li class="mailbox-toolbar-item" id='BtnAdmLecturas' role="presentation"><a id="m2" href="#VerLecturas" class="mailbox-toolbar-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Lecturas Creadas</a></li>
              <li class="mailbox-toolbar-item" id='BtnEditLecturas' role="presentation"  style="display:none"><a id="m3" href="#EditLectura" class="mailbox-toolbar-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Editar Lecturas</a></li>
               
            </ul>
         
      </div>

<div class="tab-content">
      <div class="tab-pane fade active show" id="AddLectura" role="tabpanel">

      <div class="mailbox-body">
       
          <div class="mailbox-sidebar d-none d-lg-block">
              <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                 
                  <div class="mailbox-list">

                  
                      <div class="desktop-sticky-top d-none d-lg-block">
                          <div class="card mb-3">
                          <div class="list-group list-group-flush">
                          <div class="list-group-item fw-600 px-3 d-flex rounded-0">
                          <span class="flex-fill">Datos del Paciente</span>
                          </div>
                          <div class="list-group-item px-3">
                      
                          <div class="fw-600">Nombre: {{$datospaciente->nombrepaciente}}</div>
                          <div class="fw-600">Documento: {{$datospaciente->documento}}</div>
                          <div class="fw-600">Edad: {{$datospaciente->edad_a}} Años {{$datospaciente->edad_m}} Meses {{$datospaciente->edad_d}} Días </div>
                          <div class="fw-600">Sexo: {{$datospaciente->sexo}}</div>
                        
                          </div>
                    
                          <div class="list-group-item px-3">
                          <div class="text-decoration"><small><strong>Visor Web</strong></small></div>
                                                     
                          <div class="d-flex align-items-center mb-3">
                              <a href="{{$url}}/viewer?StudyInstanceUIDs={{$datospaciente->studyinstanceuids}}" target="_blank"  ><img src="/assets/img/usuarios/logo.jpg" alt="" width="50" class="rounded-circle"></a>
                             
                              <div class="flex-fill ps-2">
                              <div class="fw-600"><a href="{{$url}}/viewer?StudyInstanceUIDs={{$datospaciente->studyinstanceuids}}" target="_blank" class="text-decoration-none">Ver Estudio</a></div>
                              <input type="hidden" class="form-control" id="codigo_Estudio" autocomplete="off" value="{{$idestudio}}">
                              <div class="text-decoration-600 fs-13px"> {{$datospaciente->fecha}}</div>
                              </div>
                              </div>
                        
                          </div>
                          <div class="list-group-item px-3">
                            <div class="text-decoration"><small><strong>Soportes</strong></small></div>

                         
                            <table id="datatableDefault" class="table text-nowrap w-100">
                    
                                <tbody>
                            
                                    @foreach ($adjuntos as $adjunto)
                                    <tr>
                                        <td>
                                                <a class="dropdown-item" href="{{$url_adjuntos}}/storage/{{$adjunto->url}}" target="_blank" >{{$adjunto->soporte}}<i class="fas fa-lg fa-fw me-2 fa-file-pdf"></i></a>       
                                        </td>
                                     </tr>
                                    @endforeach
                                  
                                
                                </tbody>
                            </table>       
                            


                            
                          </div> 


                          <div class="list-group-item px-3">

                            <ul class="nav nav-tabs pt-3 px-3" role="tablist">
                                <li class="nav-item me-1" role="presentation"><a href="#homeWithCard" class="nav-link active" data-bs-toggle="tab" aria-selected="true" role="tab">Grabador</a></li>
                                <li class="nav-item me-1" role="presentation"><a href="#profileWithCard" class="nav-link" data-bs-toggle="tab" aria-selected="false" role="tab" tabindex="-1">Historial audio</a></li>
                                </ul>

                                <div class="tab-content">

                                    <div class="tab-pane fade active show" id="homeWithCard" role="tabpanel">
                                        <br>                 
                                        <div class="text-decoration"><small><strong>Grabador</strong></small></div>
                                        <br>
                                        <div class="d-flex align-items-center mb-3">
                                            <div class="wrapper">
                                                <div class="time">
                                                  <span class="hour">00</span>
                                                  <span class="colon">:</span>
                                                  <span class="minute">00</span>
                                                  <span class="colon">:</span>
                                                  <span class="second">00</span>
                                                  <span class="colon ms-colon">:</span>
                                                  <span class="millisecond">00</span>
                                                </div>
                                                <div class="buttons">
                                                  <button class="start" id="record" title="Grabar"><i class="fa fa-play" aria-hidden="true" ></i></button>
                                                  <button class="stop"  id="pause" title="Pausar"><i class="fa fa-pause" aria-hidden="true"></i></button>
                                                  <button class="reset" id="stop" title="Detener"><i class="fa fa-stop" aria-hidden="true" ></i></button>
                                                  <button class="save" id="subir_servidor" title="Guardar"><i class="fa fa-save" aria-hidden="true" ></i></button>
                                                </div>
                                              </div>
                                  
                                              
                                        </div>
                                        <div class="form-check form-switch">
                                            <input type="checkbox" class="form-check-input" id="autoplay" checked="">
                                            <label class="form-check-label">Auto Reproducir</label>
                                        </div>
                                        

                                           <br>
                                        <fieldset id="previewField" class="">

                                            <audio id="preview" class="audio-player" controls="" style="width: 100%"></audio> 
     
                                     </fieldset> 


                                    </div>
                                    
                                    
                                    <div class="tab-pane fade" id="profileWithCard" role="tabpanel">
                                
                                        <fieldset id="previewField" class="">

                                    
                                           
                                          @if($datospaciente->audio!==0)


                                         <br>
                                          <label class="form-check-label">Historial audio</label>               
                                          <br><br>
                                        
                                          <table class="table mb-0">
                                                <tbody>

                                                    @for ($i = 1; $i <=$datospaciente->audio; $i++)
                                                 
                                                        @livewire('ris-reproductor-component',["estudio"=>"$idestudio","reproductor"=>"$i"])
                                                        
                                                    @endfor
                                                </tbody>
                                            </table>
                                         
        
                                            
                                         @endif 
                                     </fieldset> 
                                        
                                    </div>
                                    
                                    </div>


                        
      

                                
                            </div>
                          </div>
                          </div>
                          </div>
           


                  </div>
              </div>
          </div>
          
          <div class="mailbox-content">
            <div class="form-group col-3 m-1">
            <select class="form-select" id="idplantilla" name="idplantilla" >
                <option value="">Selecionar plantilla</option>
                @foreach ($plantillas as $plantillas)
                <option value="{{$plantillas->id}}">{{$plantillas->nombre}}</option>
                @endforeach
            </select>
            </div>
              <!-- BEGIN scrollbar -->
              <div data-scrollbar="true" data-height="100%" data-skip-mobile="true">
                  <!-- BEGIN mailbox-detail -->
                  <div class="mailbox-detail">                           

                              <form id="AddForm" action="{{route('lectura.store')}}" method="POST">
                                  @csrf
                      
                                  <div class="row">	
                                  
                                      <div class="col-md-8">
                                        <input type="hidden" id="idestudio" name="idestudio" value="{{$idestudio}}">
                                      <div class="row mb-2">
                                          <label class="col-form-label w-80px px-2 fw-500">Estudio :</label>
                                          <div class="col">
                                              <input type="text"   @error('estudio') class="form-control is-invalid"  
                                              @enderror
                                              class="form-control"  id="estudio" name="estudio"  value="{{old('estudio',$datospaciente->study_desc)}}"/>
                                              @error('estudio')
                                              <br>
                                              <small>*{{$message}}</small>
                                              <br>
                                          @enderror	
                                          </div>
                                      </div>
                                  </div>
                                  <div class="col-md-4">
                                      <div class="row mb-2">
                                          <label class="col-form-label w-70px px-2 fw-500">Fecha :</label>
                                          <div class="col">
                                              <input type="date" class="form-control  @error('fechaestudio') is-invalid @enderror"  id="fechaestudio" name="fechaestudio" value="{{old('fechaestudio',$FechaActual->format('Y-m-d'))}}" />
                                                                      @error('fechaestudio')
                                                                          <br>
                                                                          <small>*{{$message}}</small>
                                                                          <br>
                                                                      @enderror
                                          </div>
                                      </div>
                                  </div>
                                  </div>
                                  <div class="row">	
                              
                                    
                                  <textarea name="informe" id='informe' class="summernote form-control  @error('informe') is-invalid @enderror" >{{old('informe')}}</textarea> 
                                  @error('informe')
                                                                          <br>
                                                                          <small>*{{$message}}</small>
                                                                          <br>
                                                                      @enderror
                                  </div>
                                  <br>
                                  <div class="row">	
                                  <div class="form-check form-switch">
                                    <input  name="validado" id='validado'  type="checkbox" class="form-check-input">
                                    <label class="form-check-label" for="validado">Continuara en validacion</label>
                                   </div>
                                  </div>
                                  
                                      <div class='text-right'>
                                      <button type="submit" id="boton_ok" class="btn btn-primary">Aceptar</button>
                                      </div>
                  
                              </form>
                      </div>
                      
                                
                  </div>
                  <!-- END mailbox-detail -->
              </div>
              <!-- END scrollbar -->
          </div>
          <!-- END mailbox-content -->
      </div>
     

      <div class="tab-pane fade" id="VerLecturas" role="tabpanel">

        <div class="row p-4">    
            <div class="table-responsive">
                <table id="datatableLecturas"  class="table table-hover">
                    <thead>
                        <tr>
                            <th>IdLectura</th>
                            <th>Estudio</th>
                            <th>Informe</th>  
                            <th>Informe_html</th>              
                            <th>Fecha</th>
                            <th>Acciones</th>                                                     
                        </tr>
                    </thead>
                    <tbody>
        
                    </tbody>
                </table>   
            </div> 
        </div>
                    
   
      </div> 
   
      <div class="tab-pane fade" id="EditLectura" role="tabpanel">
        
        <div class="row p-4">            
            <form id="EditForm" >
                @csrf
  
                <div class="row">	
                    <div class="alert alert-danger" style="display:none" onerror="(function(el){ setTimeout(function(){ $(el).parent().remove(); },500 ); })(this);"></div>
                    <div class="col-md-8">
                
                      <input type="hidden" id="idestudio2" name="idestudio2" value="{{old('idestudio2')}}">
                    
                    <div class="row mb-2">
                        <label class="col-form-label w-80px px-2 fw-500">Estudio :</label>
                        <div class="col">
                            <input type="text"   class="form-control"
                            class="form-control"  id="estudio2" name="estudio2"  value="{{old('estudio2')}}"/>
                            <small id="error_estudio2"  style="display:none" >*El campo estudio es obligatorio.</small>  
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="row mb-2">
                        <label class="col-form-label w-70px px-2 fw-500">Fecha :</label>
                        <div class="col">
                            <input type="date" class="form-control"  id="fechaestudio2" name="fechaestudio2" value="{{old('fechaestudio2')}}" />
                            <small id="error_fechaestudio2"  style="display:none">*El campo fecha estudio es obligatorio.</small>                       
                        </div>
                    </div>
                </div>
                </div>
                <div class="row">			
                <textarea name="informe2" id='informe2' class="summernote2 form-control">{{old('informe2')}}</textarea> 
                <small id="error_informe2"  style="display:none" >*El campo informe es obligatorio.</small>



                </div>
                <br>
            
                    <div class='text-right'>
                    <button   type="button" id="boton_ok2" class="btn btn-primary">Aceptar</button>
                    </div>
            </form>

        </div>
            
      </div> 

    </div>
  </div>
      <!-- END mailbox-body -->
  </div>
  <!-- END mailbox -->
</div>


@endsection

@push('scripts')

<script src="/assets/js/btnEventos.js"></script>
<script src="/assets/js/convertiraudio.js"></script>
<script src="/assets/js/plugins/datatables/js/jquery.dataTables.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.buttons.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.select.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.colVis.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.html5.min.js"></script>
<script src="/assets/js/plugins/datatables/js/buttons.print.min.js"></script>
<script src="/assets/js/plugins/datatables/js/dataTables.responsive.min.js"></script>
<script src="/assets/js/plugins/datatables/js/responsive.bootstrap4.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-lite.min.js"></script>
<script src="/assets/js/plugins/summernote/js/summernote-es-ES.min.js"></script>

<script>

$(document).ready(function() {
	handleRenderSummernote1();
});



$(document).ready(function () {

let hr = min = sec = ms = "0" + 0,
  startTimer;

const startBtn = document.querySelector(".start"),
 stopBtn = document.querySelector(".stop"),
 resetBtn = document.querySelector(".reset");
 saveBtn = document.querySelector(".save");

 


function putValue() {
  document.querySelector(".millisecond").innerText = ms;
  document.querySelector(".second").innerText = sec;
  document.querySelector(".minute").innerText = min;
  document.querySelector(".hour").innerText = hr;
}
var numSentences = 1;

function getRandomInt(max) {
    min = 1;
    max++;
    return Math.floor(Math.random() * (max - min)) + min; 
}

function randomString() {
    return Math.random().toString(36).substring(5);
}

$("#codigo_Estudio").val();

if (navigator.mediaDevices) {
    var constraints = { audio: true };
    var chunks = [];
    var blob = null;
    var clipName = "";

    navigator.mediaDevices.getUserMedia(constraints)
        .then(function (stream) {

            var mediaRecorder = new MediaRecorder(stream);
            var estadorec=0;
            $("#record").click(function () {
                estadorec=estadorec+1;
             
                if(estadorec==1){
                $("#preview").trigger("stop");
                chunks = [];
                mediaRecorder.start();
                $("#record").attr("disabled", true);
                $("#pause").attr("disabled", false);
                $("#stop").attr("disabled", false);
                $("#subir_servidor").attr("disabled", true);


           


              } 
               if(estadorec>=2){
                mediaRecorder.resume();
              }

              startBtn.classList.add("active");
                stopBtn.classList.remove("stopActive");

                startTimer = setInterval(()=>{
                    ms++
                    ms = ms < 10 ? "0" + ms : ms;

                    if(ms == 100){
                    sec++;
                    sec = sec < 10 ? "0" + sec : sec;
                    ms = "0" + 0;
                    }
                    if(sec == 60){
                    min++;
                    min = min < 10 ? "0" + min : min;
                    sec = "0" + 0;
                    }
                    if(min == 60){
                    hr++;
                    hr = hr < 10 ? "0" + hr : hr;
                    min = "0" + 0;
                    }

                    putValue();
                },10); 
            
            });


            $("#pause").click(function () {
              mediaRecorder.pause();
              $("#record").attr("disabled", false);
                startBtn.classList.remove("active");
                stopBtn.classList.add("stopActive");
                clearInterval(startTimer);
            });
     
            
            
            $("#stop").click(function () {
                mediaRecorder.stop();
                $("#record").attr("disabled", false);
                $("#pause").attr("disabled", true);
                $("#reanudar").attr("disabled", true);
                $("#stop").attr("disabled", true);
                $("#subir_servidor").attr("disabled", false);
                
                startBtn.classList.remove("active");
                stopBtn.classList.remove("stopActive");
                clearInterval(startTimer);
                hr = min = sec = ms = "0" + 0;
                putValue();
                estadorec=0;
            });

            $("#subir_servidor").click(function () {
                var xhr = new XMLHttpRequest();
                xhr.onload = function (e) {
                    if (this.readyState === 4) {

                        console.log("Server returned: ", e.target.responseText);
                    }
                };
                var fd = new FormData();
              
                fd.append("name", $('#codigo_Estudio').val());
                fd.append("audio", blob, clipName);
                xhr.open("POST", "../upload.php", false);
                xhr.send(fd);

                
                if (xhr.responseText == "\nok") {
                    $('#sentenceNumber').val(getRandomInt(numSentences));
                    $("#record").attr("disabled", false);
                    $("#stop").attr("disabled", true);
                    $("#subir_servidor").attr("disabled", true);
                   
                    startBtn.classList.remove("active");
                    stopBtn.classList.remove("stopActive");
                    clearInterval(startTimer);
                    hr = min = sec = ms = "0" + 0;
                    putValue();
                    
                    $.ajax({

                    url: "/update_audio/"+$('#codigo_Estudio').val(),
                    type: 'GET',
                    data: {
                        _token: $("input[name=_token]").val(),
                    },
                    success: function (respuesta) {
                        swal({
                        icon: "success",
                        title: "Notificacion",
                        text: "Audio cargado con exito",
                      //  timer: 2000,
                      //  showConfirmButton: false
                        });
                        /*
                        swal({
                            title: "Audio cargado con exito",
                            icon: "success",
                          //  showConfirmButton: false,
                            timer: 2000
                        });*/
                    }
                    });




                }
                else {
                    alert('error durante la carga');
                }
            });

            mediaRecorder.onstop = function (e) {

                clipName = $("#dataset").val() + "_" + $("#sentenceNumber").val();

                blob = new Blob(chunks, { 'type': 'audio/ogg; codecs=opus' });
                chunks = [];
                var audioURL = URL.createObjectURL(blob);
                $("#preview").attr("src", audioURL);

                if ($("#autoplay").is(":checked"))
                    $("#preview").trigger("play");
            }

            mediaRecorder.ondataavailable = function (e) {
                chunks.push(e.data);
            }
        })
        .catch(function (err) {
            alert('The following error occurred: ' + err);
        })
}

});
</script>



<script>

 $( "#BtnAddLecturas" ).bind( "click", function() {
        document.getElementById("BtnEditLecturas").setAttribute("style","display:none");
     
    });

 $( "#BtnAdmLecturas" ).bind( "click", function() {
        document.getElementById("BtnEditLecturas").setAttribute("style","display:none");
     
    });

function ValidarLectura(){
 
    const idestudio = @json($idestudio);
    $.ajax({
    url: "/update_validado/"+idestudio,
    type: 'GET',
    data: {
        _token: $("input[name=_token]").val(),
    },
    success: function (respuesta) {
        swal({
                        icon: "success",
                        title: "Notificacion",
                        text: "Lectura validada con exito",
                        });
    }
    });
}
    
function EditarLectura(){

        document.getElementById("AddLectura").setAttribute("class","tab-pane fade");
        document.getElementById("m1").setAttribute("class","mailbox-toolbar-link");
        document.getElementById("m1").setAttribute("aria-selected","false");

        document.getElementById("VerLecturas").setAttribute("class","tab-pane fade");
        document.getElementById("m2").setAttribute("class","mailbox-toolbar-link");
        document.getElementById("m2").setAttribute("aria-selected","false");


        document.getElementById("BtnEditLecturas").removeAttribute("style");
        document.getElementById("EditLectura").setAttribute("class","tab-pane fade active show");
        document.getElementById("m3").setAttribute("aria-selected","true");
        document.getElementById("m3").setAttribute("class","mailbox-toolbar-link active");
     
}
function ImprimirLectura(){

    const idestudio = @json($idestudio);
    var host = window.location.origin;

    
    window.open(host+"/imprimirlectura/"+idestudio,"_blank")

}

 var handleRenderSummernote1 = function() {

    var totalHeight = ($(window).height() /2)-70;

    
   var editor = $('#informe').summernote({
        lang: 'es-ES' ,
		height: totalHeight,
        disableDragAndDrop: true, 
        placeholder:"Digite la lectura para este estudio",
        toolbar: [
            ['font', ['bold', 'italic',  'underline', 'clear']],
            ['para', ['ul', 'ol','paragraph']],
            ['view', ['fullscreen']],
            ['mybutton', ['dictado']],
            
        ],
        buttons: {
            dictado: DictadoButton
        },
        callbacks: {
        onPaste: function (e) {
        
        var bufferText = ((e.originalEvent || e).clipboardData || window.clipboardData).getData('Text');
        e.preventDefault();
        document.execCommand('insertText', false, bufferText);
    }
}
	});

    $("#idplantilla").change(function () {
    var idplantilla = $("#idplantilla").val();
    if(idplantilla!==''){
        $.ajax(
                    {
                        url: "/plantillascargar/"+idplantilla,
                        type: 'GET',
                        data: {
                            _token : $("input[name=_token]").val(),
                        },
                        success: function (respuesta){                           
                           editor.summernote('code',respuesta);
                        }
                    });
    }else{
        editor.summernote('code',"");
    }
});

  

    $('#informe2').summernote({
        lang: 'es-ES' ,
		height: totalHeight,
        disableDragAndDrop: true,    
        placeholder:"Digite la lectura para este estudio",
        toolbar: [
            ['font', ['bold', 'underline', 'clear']],
            ['para', ['ul', 'ol','paragraph']],
            ['view', ['fullscreen']],
        ]
	});


    

};




var DictadoButton = function (context) {
    var ui = $.summernote.ui;
    
    var button = ui.button({
        contents: '<i id="iinforme" class="fa fa-microphone fa-fw"/>',
        click: function () {
             GrabadorInforme();
        }
    });
    return button.render();   // return button as jquery object
    }   

////////con ajax
var idestudio = $("#idestudio").val();


datatableLecturas=$('#datatableLecturas').DataTable({
    language: {
    url: '/assets/js/plugins/datatables/es-ES.json',
    },
  dom: "<'row mb-3'<'col-sm-4'l><'col-sm-8 text-end'<'d-flex justify-content-end'fB>>>t<'d-flex align-items-center'<'me-auto'i><'mb-0'p>>",
  responsive: true,
  paging:false,
  autoWidth: false,
  ajax:"{{route('datatable.lecturasestudiosclientes',[''])}}"+"/"+idestudio,
  order: [[0, 'desc']],
  select:true,
  "columnDefs": [
    { "visible": false, "targets": 0 },
    { "visible": false, "targets": 3 }
  ],
  columns:[
  
     {data:'lecturas_id'},
     {"width": "20%",  data:'estudio',orderable:false},
     {"width": "60%",  data:'informe',orderable:false},
     {data:'informe_html'},
     {"width": "10%",  data:'fechaestudio',orderable:false},
     {"width": "10%",  data:'action',orderable:false},
      ], 
  info:false,
  buttons: [ {title: 'Lecturas', text: '<i class="fas fa-file-excel"></i>',  titleAttr: 'Exportar a Excel',extend: 'excelHtml5', className: 'btn btn-success', 
  exportOptions: {columns: [1,2,3] }}],
});  


datatableLecturas.on('select', function (e, dt, type, indexes) {
  
        if ( type === 'row' ) {
          
            document.getElementById("idestudio2").value = datatableLecturas.rows(indexes).data().pluck('lecturas_id').toArray();
            document.getElementById("estudio2").value =datatableLecturas.rows(indexes).data().pluck('estudio').toArray();
            document.getElementById("fechaestudio2").value = datatableLecturas.rows(indexes).data().pluck('fechaestudio').toArray();
            var  informe_html= datatableLecturas.rows(indexes).data().pluck('informe_html').toArray();

            $('#informe2').summernote('reset');
            $('#informe2').summernote('pasteHTML', ConvetidorHtml(informe_html));
  
           }
         
  
    });


    function ConvetidorHtml(html){
        var tempDivElement = document.createElement("div");
        tempDivElement.innerHTML = html;
        return tempDivElement.textContent || tempDivElement.innerText || "";
    }


    
    $("#boton_ok2").on("click",function(e){
        e.preventDefault();


        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
            });

        let idestudio=$("#idestudio2").val();
        let estudio=$("#estudio2").val();
        let informe=$("#informe2").val();
        let fechaestudio=$("#fechaestudio2").val();
        let _token= $("input[name=_token]").val();
     
       $.ajax(
                    {
                        url: "{{route('lectura.update')}}",
                        type: "GET",
                        data: {

                            idestudio2:idestudio,
                            estudio2:estudio,
                            informe2:informe,
                            fechaestudio2:fechaestudio,
                            _token :_token,
                      
                        },
                        success: function (data){         
                            document.getElementById("estudio2").setAttribute("class","form-control");
                            document.getElementById("fechaestudio2").setAttribute("class","form-control");
                            document.getElementById("error_estudio2").setAttribute("style","display:none");
                            document.getElementById("error_fechaestudio2").setAttribute("style","display:none");
                            document.getElementById("error_informe2").setAttribute("style","display:none");

                            jQuery.each(data.errors, function(key, value){
                          console.log(data);
                            if(value=="El campo estudio2 es obligatorio."){
                                
                                document.getElementById("error_estudio2").removeAttribute("style");
                                document.getElementById("estudio2").setAttribute("class","form-control is-invalid");}
                            if(value=="El campo fechaestudio2 es obligatorio."){
                                
                                document.getElementById("error_fechaestudio2").removeAttribute("style");
                                document.getElementById("fechaestudio2").setAttribute("class","form-control is-invalid");}
                            if(value=="El campo informe2 es obligatorio."){
                                document.getElementById("error_informe2").removeAttribute("style");
                            }
                            
                  	        	});
                            datatableLecturas.ajax.reload(null,false);
                          
                        }
                    });


 });



</script>



@endpush

@push('scripts')
<script>
    function fmtMSS(s) {
  return (s - (s %= 60)) / 60 + (9 < s ? ":" : ":0") + s;
}

function initAudioPlayer(player) {

  if (player.readyState > 2) {
    var i = player.id;
    var playerId = i.replace(/(player)/gm, "");
    var formatted_dur = "" + fmtMSS(player.duration) + "";
    var dur = formatted_dur.slice(0, 4);
    //$("#maxTime" + playerId).html(dur);
    $(player).removeClass("notready");
  } else {
    $(player).addClass("notready");
  }
}

$(".eazy-play").on("click", function() {
  var playerId = $(this).data("id");
  var audioEl = $("body").find("#player" + playerId);

  if ($(this).hasClass("fa-play")) {
    $(this).toggleClass("fa-play fa-pause");
    audioEl[0].play();
    audioEl[0].addEventListener("timeupdate", function() {
      var formatted_curTime = "" + fmtMSS(audioEl[0].currentTime) + "";
      var curTime = formatted_curTime.slice(0, 4);
      $("#curTime" + playerId).html(curTime);

      var seekTime = parseInt(audioEl[0].currentTime, 10);
      var seekPerc = parseInt(seekTime) / parseInt(audioEl[0].duration, 10) * 100;
      $("#seek"+playerId+" .eazy-seek_dot").css("left","" + seekPerc + "%");

      if (audioEl[0].currentTime == audioEl[0].duration) {
        $("#seek"+playerId+" .eazy-seek_dot").css("left", "0");
        $('.eazy-play[data-id="'+playerId+'"]').toggleClass("fa-play fa-pause");
      }
    });
  } else {
    $(this).toggleClass("fa-play fa-pause");
    audioEl[0].pause();
  }
});

$(document).ready(function() {
  var allPlayers = $("body").find("audio");
  $.each(allPlayers, function(index, value) {
    initAudioPlayer(this);
  });

  setTimeout(function() {
    var notreadyPlayers = $("body").find("audio.notready");
    $.each(notreadyPlayers, function(index, value) {
      initAudioPlayer(this);
    });
  }, 3000);
});

</script>

@endpush