


function RestablecerClave(idusuario){

    
    swal({
        title: "Desea Restablecer la contraseña?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('restablecer-'+idusuario).submit()
            }
        });

   
  }

  function RestablecerMedico(idmedico){

    
    swal({
        title: "Desea Restablecer la contraseña?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('restablecer-'+idmedico).submit()
            }
        });

   
  }

function EliminarCliente(idcliente){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idcliente).submit()
            }
        });

   
  }





 
  function EliminarUsuario(idusuario){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idusuario).submit()
            }
        });

   
  }




function EliminarMedico(idmedico){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idmedico).submit()
            }
        });

   
  }

  function EliminarPaciente(idpaciente){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idpaciente).submit()
            }
        });

   
  }
  
  function EliminarSede(idsede){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idsede).submit()
            }
        });

   
  }
  
  function EliminarSala(idsala){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idsala).submit()
            }
        });

   
  }
  
  function EliminarMotivocancelacion(idotivocancelacion){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idotivocancelacion).submit()
            }
        });

   
  }
  
  
  function EliminarMotivobloqueo(idotivobloqueo){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idotivobloqueo).submit()
            }
        });

   
  }


  function EliminarPlantilla(idplantilla){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                
                document.getElementById('delete-'+idplantilla).submit();
             
            }
        });

   
  }





  function EliminarRelplantillasradiologo(idrelacion){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                document.getElementById('delete-'+idrelacion).submit()
            }
        });

   
  }

  function EliminarLectura(idlectura){

    
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {
                
                document.getElementById('delete-'+idlectura).submit();
             
            }
        });

   
  }


  function EliminarLectura2(idlectura){
   
    swal({
        title: "Desea eliminar este registro?",
        icon: "warning",
        dangerMode: true,
        buttons: {
            confirm: { text: "OK", value: true, visible: true, className: "", closeModal: true },
            cancel: { text: "Cancel", value: null, visible: true, className: "", closeModal: true }
        }
    })
        .then((willDelete) => {

            if (willDelete) {


                $.ajax(
                    {
                        url: "/lectura/"+idlectura,
                        type: 'DELETE',
                        data: {
                            _token : $("input[name=_token]").val(),
                        },
                        success: function (){                           
                            datatableLecturas.ajax.reload(null,false);
                          
                        }
                    });

            }
        });
  }



  function ActualizarLectura(idlectura){
console.log("vamos casi");
$.get("/lectura/"+idlectura,{ name: "John", time: "2pm" } );

/*$.get("/lectura/"+idlectura,function (){
  //     $("#idestudio2").val('23');
    // $("#estudio2").val('CASO');
        //$("#fechaestudio2").val(lectura.fechaestudio2);
});
*/
datatableLecturas.ajax.reload(null,false);
/*
             $.ajax(
                    {
                    
                        url: "/lectura/"+idlectura,
                        type: 'post',
                        data: {
                            _token : $("input[name=_token]").val(),
                        },
                        success: function (){                           
                            //datatableLecturas.ajax.reload(null,false);
                          console.log("yes1111");
                        }
                    });       

                    */


                 
                    
  }

  

  function RealizarLecturas(idestudio){
  window.open("lecturas/"+idestudio);
  }

  function ImprimirLecturas(idestudio){
    window.open("imprimirlectura/"+idestudio);
  }

  function ImprimirLecturaspaciente(idestudio){
    window.open("imprimirlecturapaciente/"+idestudio);
  }
   
   // window.location.href = "<?php echo URL::to('lectura/20'); ?>";
 //   window.location.href = "{{URL::to('lectura')}}"
     // window.location = "{{route('lectura.index', '')}}"+"/"+idestudio;
 //   window.open("informes","nuevo2");

 
  //$('#modal_lecturas').modal({backdrop: 'static', keyboard: false});
  //$("#modal_lecturas").modal("show"); 
  //$("#modal_lecturas")[0].reset(); 


/*
                $.ajax(
                    {
                        url: "users/"+id,
                        type: 'DELETE',
                        data: {
                            "id": id,
                            "_token": token,
                        },
                        success: function (){
                            console.log("it Works");
                        }
                    });

                    /*
                $.ajax({
                    type: 'post',
                    url: 'clases/Borrar.php',
                    data: 'ventana=BorrarLectura&idlectura=' + id,

                    success: function (respuesta) {

                        

                        if (respuesta == "ok") {
                          //Tabla_Htm_EstudiosPorSerie.row(fila.parents('tr')).remove().draw();
                          //Tabla_Htm_Estudios.ajax.reload(null, false);
                        }


                    }

                });*/
             //   console.log("Yes"+idlectura);
                //window.location = "{{route('lectura.destroy', '')}}"+"/"+idlectura;  
            
            //    document.getElementById('delete-'+idlectura).submit();
             //  document.getElementById('delete').submit();