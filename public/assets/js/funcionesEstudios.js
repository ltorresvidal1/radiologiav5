
    
    var buscar_sedes=[];
    var buscar_salas=[];
    var buscar_modalidades=[];
    var buscar_prioridades=[];
    
    check_sedes() ;
    check_salas() ;
    check_modalidades() ;
    check_prioridades() ;


function AbrirModalFiltros() {
    $('#modal_filtro').modal({backdrop: 'static', keyboard: false})
    $('#modal_filtro').modal('show'); 
    }
    
function check_sedes(cb) {
   
    let checkboxes = document.querySelectorAll('input[name="sedes"]:checked');
    let todos = document.querySelectorAll('input[name="sedes"]');
    buscar_sedes=[];
 
    if(checkboxes.length>=1){   
 
        checkboxes.forEach((checkbox) => {
          buscar_sedes.push(""+checkbox.value+"");
        });
        if(checkboxes.length<todos.length){
            document.getElementById("todassedes").checked = false;
        }else{
            document.getElementById("todassedes").checked = true;
        }
  
     }else{
         buscar_sedes.push(""+cb.value+"");
         cb.checked = true;
     }
 }
 
 function todos_sedes() {
    buscar_sedes=[];
    document.getElementById("todassedes").checked = true;
 let checkboxes = document.querySelectorAll('input[name="sedes"]');
     checkboxes.forEach((checkbox) => {
        checkbox.checked = true;
        buscar_sedes.push(""+checkbox.value+"");
     });
 
 }
 
 
 function check_salas(cb) {
    
    let checkboxes = document.querySelectorAll('input[name="salas"]:checked');
    let todos = document.querySelectorAll('input[name="salas"]');
    buscar_salas=[];
    if(checkboxes.length>=1){   
        checkboxes.forEach((checkbox) => {
          buscar_salas.push(""+checkbox.value+"");
        });
        if(checkboxes.length<todos.length){
            document.getElementById("todassalas").checked = false;
        }else{
            document.getElementById("todassalas").checked = true;
        }
     }else{
         buscar_salas.push(""+cb.value+"");
         cb.checked = true;
     }
     
 }
 
 function todos_salas() {
     document.getElementById("todassalas").checked = true;
     buscar_salas=[];
 let checkboxes = document.querySelectorAll('input[name="salas"]');
     checkboxes.forEach((checkbox) => {
        checkbox.checked = true;
        buscar_salas.push(""+checkbox.value+"");
     });
 
 }
 
     function check_modalidades(cb) {
    
         let checkboxes = document.querySelectorAll('input[name="modalidades"]:checked');
         let todos = document.querySelectorAll('input[name="modalidades"]');
         buscar_modalidades=[];
         if(checkboxes.length>=1){   
             checkboxes.forEach((checkbox) => {
               buscar_modalidades.push(""+checkbox.value+"");
             });
             if(checkboxes.length<todos.length){
                 document.getElementById("todasmodalidades").checked = false;
             }else{
                 document.getElementById("todasmodalidades").checked = true;
             }
         }else{
         buscar_modalidades.push(""+cb.value+"");
         cb.checked = true;
     }
          
     }
 
     function todos_modalidades() {
         document.getElementById("todasmodalidades").checked = true;
         buscar_modalidades=[];
      let checkboxes = document.querySelectorAll('input[name="modalidades"]');
          checkboxes.forEach((checkbox) => {
             checkbox.checked = true;
             buscar_modalidades.push(""+checkbox.value+"");
          });
 
  }
 
  function check_prioridades(cb) {
    
    let checkboxes = document.querySelectorAll('input[name="prioridades"]:checked');
    let todos = document.querySelectorAll('input[name="prioridades"]');
    buscar_prioridades=[];
    if(checkboxes.length>=1){   
        checkboxes.forEach((checkbox) => {
         buscar_prioridades.push(""+checkbox.value+"");
        });
    }else{
     buscar_prioridades.push(""+cb.value+"");
    cb.checked = true;
 }
     
 }