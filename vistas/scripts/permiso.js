var tabla;

//funcon que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();
}

//funcion mostrar formulario
function mostrarform(flag) {
    /*    limpiar(); */
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").hide();
    }
}

//funcion listar
function listar() {
    tabla = $('#tbllistado').dataTable({

        "aProcessing": true, //activamos el procesamiento del datatables
        "aServerSide": true, //paginacion y filtrado  realizados por el servidor
        dom: 'Bfrtip', //definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/permiso.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 10, //paginacion cada 5
        "order": [
                [0, "desc"]
            ] //ordernar

    }).DataTable();
}

init();