function insertNewUser() {
    var formulario = document.getElementById("frmUsuario");
    var data = new FormData(formulario);
    var url = "./controllers/user/insertNewUser.php";
    var div = "#modalstatus";
    ejectAjaxImage(url, data, div);
}