<div>
                    
<div class="row">

    <div class="col-xl-3 mb-3">
        <div class="card h-100">
            <div class="card-body">
                <div class="d-flex align-items-center mb-4">
                    <div class="flex-grow-1">
                        <h5 class="mb-1">Asignar citas</h5>
                        <div class="fs-13px">Diligenciar todos los datos</div>
                    </div>
                </div>
                <!--
                    <div class="row">
                        <div class="d-flex align-items-center">     
                            <div class="input-group input-daterange" id="datepicker">
                                <input type="text" class="form-control" name="start" placeholder="fecha inicio">
                                <span class="input-group-text">A</span>
                                <input type="text" class="form-control" name="end" placeholder="fecha fin">
                            </div>
                         </div>
                    </div>
                    <br> --->
                    <div class="row">
                        <div class="d-flex align-items-center">     
                            <div class="form-group row mb-2">
                                <label for="documento" class="col-sm-4 col-form-label">Paciente</label>
                                <div class="col-sm-8">
                             
                                <input wire:keydown.enter="buscar_p" wire:model="search" type="text" name="serch" placeholder="Documento" class="form-control"/>
                                    
                                
                                </div>
                            </div>
                         </div>
                    </div>
                    <div class="row">	
                        <div class="form-group col-12 m-0">
                            <label class="form-label" for="sede">Sedes</label>
                            <select class="form-select  @error('sede') is-invalid @enderror" id="sede" name="sede"  wire:model="sede" >
                                <option value="0">Seleccionar</option>
                                @foreach ($sedes as $sede)
                                <option value="{{$sede->id}}">{{$sede->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="row">	
                        <div class="form-group col-12 m-0">
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
            </div>
        </div>
    </div>
    
    
    <div class="col-xl-9 mb-3">
        <div class="card h-100">
            <div class="card-body" wire:ignore>
                    <div class="calendar">
                        <div class="calendar-body">
                         <div id="calendar"></div>
                        </div>
                    </div>
            </div>
        </div>
    </div>
    
</div>
                                

</div>



<!-- modal -->
<div id="asignarcita" class="modal fade"  style="display: none;"   wire:ignore.self>

  <!-- dialog -->
  <div class="modal-dialog  modal-xl">

    <!-- content -->
    <div class="modal-content">

      <!-- header -->
      <div class="modal-header">
        <h1 id="myModalLabel" class="modal-title">Asignar Cita</h1>
      </div>
      <!-- header -->
      
      <!-- body -->
      <div class="modal-body">
        <div class="row">

      <div class="form-group col-6 m-0">
                                         
     
            
      </div>
        </div>
      </div>
      <!-- body -->


      <!-- footer -->
      <div class="modal-footer">
        <button class="btn btn-secondary" data-dismiss="modal">close </button>
        <button class="btn btn-default"> Default </button>
        <button class="btn btn-primary"> Primary </button>
      </div>
      <!-- footer -->

    </div>
    <!-- content -->

  </div>
  <!-- dialog -->

</div>
<!-- modal -->



@push('scripts')

    <script>

window.addEventListener('paciente-no-encontrado', () => {

  swal({
        title: "Documento no encontrado",
        text: "Desea crear paciente?",
        icon: "info",
        dangerMode: false,
        buttons: {
            confirm: { text: "Si", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "No", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {


            

            }
        });

})

window.addEventListener('paciente-encontrado', () => {



})

</script>
@endpush
<script>


window.addEventListener('buscaragenda', () => {
    var  idcliente=@this.get('idcliente');
    var  idsede=@this.get('sede');
    var  idsala=@this.get('sala');

   
    if(idcliente!==null && idsede!==null && idsala!==null){
        handleRenderFullcalendar();
    }

	//

 // @this.set('idventana',ventana);
/*
    var  matches= document.querySelectorAll('a.nav-link.active');
    let ventana=matches[0].hash;
   
*/
})


  
      
var handleRenderFullcalendar = function() {

    
    
    var d = new Date();
	var month = d.getMonth() + 1;
	month = (month < 10) ? '0' + month : month;
	var year = d.getFullYear();
	var day = d.getDate();
	var calendarElm = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarElm, {
        locale:'es',
        initialView: 'timeGridFourDay',
        slotDuration: '00:10:00',
        slotLabelInterval:   10,
        headerToolbar: {
        left: '',
        center: 'title',
        right: 'prev,next'
        //right: 'custom2,prev,next'
      },
      views: {
        
        timeGridFourDay: {
          type: 'timeGrid',
          allDaySlot:false,
          displayEventTime:false,
          duration: { days: 10 },
        }
      },
 
        slotLabelFormat:     [{
            hour: '2-digit',
            minute: '2-digit',
            }],

        themeSystem: 'bootstrap',
/*
        eventDidMount: function(info) {
    
            $(info.el).tooltip({ 
              title: info.event.extendedProps.description,
              //placement: "top",
            // trigger: "hover",
            //  container: "body"
            });
          }, 
  
*/
      eventClick: function(info) {
        var estado=   info.event.title;
     
   
    if(estado=="Turno disponible"){
    alert('Event: ' + info.event.title);
    }
   // alert('Coordinates: ' + info.jsEvent.pageX + ',' + info.jsEvent.pageY);
   // alert('View: ' + info.view.type);
$('#asignarcita').modal('show'); // abrir
  },

      loading: function(isLoading) {
                    if (!isLoading) {
                        this.getEvents().forEach(function(e){
                            if (e.source === null) {
                                e.remove();
                            }
                        });
                    }
                },
                   
                events: function(fetchInfo, successCallback, failureCallback) {
            
                    @this.getEvents().then(results => {
                        successCallback(results);
                    });
                },
            
       
    

        
	});
	
	calendar.render();
    
};

  /*   eventRender: function (event, element) {       

//if(event.rendering=='background'){
    $('.fc-day[data-date="' +'luis' + '"]').html('&nbsp;<span style="float:left">' +'hola'+ '</span>');
//}
},
       
        //navLinks: true,
        //editable: true,
        //droppable: false,
        
        //dayMaxEvents: true, 
        //dayMaxEvents: 2, */
        /*buttonText: {
            today:    'Today',
            month:    'Mes',
            week:     'Semana',
            day:      'Dia'
        },
        headerToolbar: {
        left: 'dayGridMonth,timeGridWeek,timeGridDay',
        center: 'title',
        right: 'prev,next today'
        },*/





/*
    document.addEventListener('DOMContentLoaded', function() {
      var calendarEl = document.getElementById('calendar');
  
      var calendar = new FullCalendar.Calendar(calendarEl, {
        defaultView: "dayGridMonth",

     plugins: ["dayGrid"],
   
    defaultDate: "2019-06-12",

    eventRender: function(info) {
      $(info.el).tooltip({ 
        title: info.event.extendedProps.description,
        placement: "top",
        trigger: "hover",
        container: "body"
      });
    },
        events: [
          {
            title: 'All Day Event',
            description: 'description for All Day Event',
            start: '2023-07-01'
          },
          {
            title: 'Long Event',
            description: 'description for Long Event',
            start: '2023-07-07',
            end: '2023-07-10'
          },
          {
            groupId: '999',
            title: 'Repeating Event',
            description: 'description for Repeating Event',
            start: '2023-07-09T16:00:00'
          },
          {
            groupId: '999',
            title: 'Repeating Event',
            description: 'description for Repeating Event',
            start: '2023-07-16T16:00:00'
          },
          {
            title: 'Conference',
            description: 'description for Conference',
            start: '2023-07-11',
            end: '2023-07-13'
          },
          {
            title: 'Meeting',
            description: 'description for Meeting',
            start: '2023-07-12T10:30:00',
            end: '2023-07-12T12:30:00'
          },
          {
            title: 'Lunch',
            description: 'description for Lunch',
            start: '2023-07-12T12:00:00'
          },
          {
            title: 'Meeting',
            description: 'description for Meeting',
            start: '2023-07-12T14:30:00'
          },
          {
            title: 'Birthday Party',
            description: 'description for Birthday Party',
            start: '2023-07-13T07:00:00'
          },
          {
            title: 'Click for Google',
            description: 'description for Click for Google',
            url: 'https://google.com/',
            start: '2023-07-28'
          }
        ]
      });
  
      calendar.render();
    });
    */
  
  </script>