function searchUser(search) {
  if (search.length > 3) {
    var url = "./controllers/user/listUsers.php";
    var data = "search=" + search;
    var div = "#table";
    ejectAjax(url, data, div);
  }
}

function searchUserEdit(search) {
  if (search.length > 3) {
    var url = "./controllers/user/listUsersEdit.php";
    var data = "search=" + search;
    var div = "#table";
    ejectAjax(url, data, div);
  }
}

function searchUserDelete(search) {
  if (search.length > 3) {
    var url = "./controllers/user/listUsersDelete.php";
    var data = "search=" + search;
    var div = "#table";
    ejectAjax(url, data, div);
  }
}

function detailUser(tipo_doc, num_doc) {
  var url = "./controllers/user/detailUser.php";
  var data = "tipo_doc=" + tipo_doc + "&num_doc=" + num_doc;
  var div = "#result";
  ejectAjax(url, data, div);
}

function detailUserEdit(tipo_doc, num_doc) {
  var url = "./controllers/user/detailUserEdit.php";
  var data = "tipo_doc=" + tipo_doc + "&num_doc=" + num_doc;
  var div = "#result";
  ejectAjax(url, data, div);
}

function detailUserDelete(tipo_doc, num_doc) {
  var url = "./controllers/user/detailUserDelete.php";
  var data = "tipo_doc=" + tipo_doc + "&num_doc=" + num_doc;
  var div = "#result";
  ejectAjax(url, data, div);
}

function UpdateUser() {
  var formulario = document.getElementById("frmUsuario");
  var data = new FormData(formulario);

  var url = "./controllers/user/UpdateUser.php";
  var div = "#modalstatus";
  ejectAjaxImage(url, data, div);
}

function deleteUser() {
  var tipo_doc = $("#tipo_doc").val();
  var num_doc = $("#nro_doc").val();
  var data = "tipo_doc=" + tipo_doc + "&num_doc=" + num_doc;
  var url = "./controllers/user/deleteUser.php";
  var div = "#modalstatus";
  ejectAjax(url, data, div);
}
