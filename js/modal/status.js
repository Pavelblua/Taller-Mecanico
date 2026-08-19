function getModalStatus() {
    const modalElement = document.getElementById('modalStatus');
    return bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
}

function abrirModalStatus() {
    getModalStatus().show();
}

function cerrarModalStatus() {
    getModalStatus().hide();
}

function cargaModalStatus(status, title, message){
    var dato = "status="+status+"&title="+title+"&message="+message;
    $.ajax({
            url: "./plantillas/modal/voidModalStatus.php",
            type: "POST",
            data: dato,
            success: (function (respuesta) {
                $("#modalstatus").html("");
                $("#modalstatus").append(respuesta);
            })
        });
}