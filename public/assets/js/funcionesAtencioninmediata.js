var buscar_salas = [];

check_salas();

function AbrirModalFiltros() {
    $('#modal_filtrosalas').modal({ backdrop: 'static', keyboard: false })
    $('#modal_filtrosalas').modal('show');
}

function check_salas(cb) {

    let checkboxes = document.querySelectorAll('input[name="salas"]:checked');
    let todos = document.querySelectorAll('input[name="salas"]');
    buscar_salas = [];
    if (checkboxes.length >= 1) {
        checkboxes.forEach((checkbox) => {
            buscar_salas.push("" + checkbox.value + "");
        });
        if (checkboxes.length < todos.length) {
            document.getElementById("todassalas").checked = false;
        } else {
            document.getElementById("todassalas").checked = true;
        }
    } else {
        buscar_salas.push("" + cb.value + "");
        cb.checked = true;
    }

}

function todos_salas() {
    document.getElementById("todassalas").checked = true;
    buscar_salas = [];
    let checkboxes = document.querySelectorAll('input[name="salas"]');
    checkboxes.forEach((checkbox) => {
        checkbox.checked = true;
        buscar_salas.push("" + checkbox.value + "");
    });

}



