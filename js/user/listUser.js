function searchUser(search) {
  if (search.length > 3) {
    var url = "./controllers/user/listUsers.php";
    var data = "search=" + search;
    var div = "#table";
    ejectAjax(url, data, div);
  }
}

function detailUser(tipo_doc, num_doc){
  var url = "./controllers/user/detailUser.php";
    var data = "tipo_doc=" + tipo_doc + "&num_doc=" + num_doc;
    var div = "#result";
    ejectAjax(url, data, div);
}
