function getModalStatus() {
    const modalElement = document.getElementById('modalStatus');
    if (!modalElement) return null;
    return bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
}

function abrirModalStatus() {
    getModalStatus()?.show();
}

function cerrarModalStatus() {
    getModalStatus()?.hide();
}

function cargaModalStatus(status, title, message) {
    var dato = "status=" + status + "&title=" + title + "&message=" + message;
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


function getModalDetail() {
    const modalElement = document.getElementById('modalDetail');
    if (!modalElement) return null;
    return bootstrap.Modal.getInstance(modalElement) || new bootstrap.Modal(modalElement);
}

function abrirModalDetail() {
    getModalDetail()?.show();
}

function cerrarModalDetail() {
    getModalDetail()?.hide();
}

document.addEventListener('hide.bs.modal', (event) => {
    const modalEl = event.target;
    if (modalEl.contains(document.activeElement)) {
        document.activeElement.blur();
    }
});