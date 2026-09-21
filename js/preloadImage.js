$(document).on("change", "#imagen_usuario", function () {
    var archivo = this.files[0];
    var imagenPreview = document.getElementById("imagenPreview");
    var mensajeImagen = document.getElementById("mensajeImagen");

    if (!archivo || !archivo.type.startsWith("image/")) {
        imagenPreview.removeAttribute("src");
        imagenPreview.classList.add("d-none");
        mensajeImagen.classList.remove("d-none");
        return;
    }

    imagenPreview.src = URL.createObjectURL(archivo);
    imagenPreview.classList.remove("d-none");
    mensajeImagen.classList.add("d-none");
});

$(document).on("reset", "#frmUsuario", function () {
    var imagenPreview = document.getElementById("imagenPreview");
    var mensajeImagen = document.getElementById("mensajeImagen");

    imagenPreview.removeAttribute("src");
    imagenPreview.classList.add("d-none");
    mensajeImagen.classList.remove("d-none");
});

