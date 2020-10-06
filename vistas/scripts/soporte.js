var tabla;

//Función que se ejecuta al inicio
function init() {
    mostrarform(false);
    listar();

    $("#formulario").on("submit", function(e) {
        guardaryeditar(e);
    })

    $("#adjuntarmuestra").hide();
    
}

//Función limpiar
function limpiar() {
    $("#nombres").val("");
    $("#apellidos").val("");
    $("#fechaentrada").val("");
    $("#direccion").val("");
    $("#cantidadequipos").val("");
    $("#valortotal").val("");
    $("#identificador").val("");
    $("#codigo").val("");
    $("#telefono").val("");
    $("#tipopago").val("");
    $("#descripcion").val("");
    $("#valorunidad").val("");
    $("#adjuntar").val("");
    $("#idsoporte").val("");
}

//Función mostrar formulario
function mostrarform(flag) {
    limpiar();
    if (flag) {
        $("#listadoregistros").hide();
        $("#formularioregistros").show();
        $("#btnGuardar").prop("disabled", false);
        $("#btnagregar").hide();
    } else {
        $("#listadoregistros").show();
        $("#formularioregistros").hide();
        $("#btnagregar").show();
    }
}

//Función cancelarform
function cancelarform() {
    limpiar();
    mostrarform(false);
}

//Función Listar
function listar() {
    tabla = $('#tbllistado').dataTable({
        "aProcessing": true, //Activamos el procesamiento del datatables
        "aServerSide": true, //Paginación y filtrado realizados por el servidor
        dom: 'Bfrtip', //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax": {
            url: '../ajax/soporte.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "iDisplayLength": 5, //Paginación
        "order": [
                [0, "desc"]
            ] //Ordenar (columna,orden)
    }).DataTable();
}
//Función para guardar o editar

function guardaryeditar(e) {
    e.preventDefault(); //No se activará la acción predeterminada del evento
    $("#btnGuardar").prop("disabled", true);
    var formData = new FormData($("#formulario")[0]);

    $.ajax({
        url: "../ajax/soporte.php?op=guardaryeditar",
        type: "POST",
        data: formData,
        contentType: false,
        processData: false,

        success: function(datos) {
            bootbox.alert(datos);
            mostrarform(false);
            tabla.ajax.reload();
        }

    });
    limpiar();
}


function mostrar(idsoporte) {
    $.post("../ajax/soporte.php?op=mostrar", { idsoporte: idsoporte }, function(data, status) {
        data = JSON.parse(data);
        mostrarform(true);

        $("#nombres").val(data.nombres);
        $("#apellidos").val(data.apellidos);
        $("#fechaentrada").val(data.fechaentrada);
        $("#direccion").val(data.direccion);
        $("#cantidadequipos").val(data.cantidadequipos);
        $("#valortotal").val(data.valortotal);
        $("#identificador").val(data.identificador);
        $("#codigo").val(data.codigo);
        $("#telefono").val(data.telefono);
        $("#tipopago").val(data.tipopago);
        $("#descripcion").val(data.descripcion);
        $("#valorunidad").val(data.valorunidad);
        $("#adjuntarmuestra").show();
        $("#adjuntarmuestra").attr("src", "../files/soporte/" + data.adjuntar);
        $("#adjuntaractual").val(data.adjuntar);
        $("#idsoporte").val(data.idsoporte);

    });
}




init();