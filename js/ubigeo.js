//funciones de ubigeo
function cargaProvincia(idDepa){
     var url = "./transformers/ubigeo/cargaProvincia.php";
    var data = "idDepa="+idDepa;
    var div = "#id_prov";
    ejectAjax(url, data, div);
}

function cargaDistrito(idProv){
    var idDepa = $("#id_dep").val(); 
    var url = "./transformers/ubigeo/cargaDistrito.php";
    var data = "idDepa="+idDepa+"&idProv="+idProv;
    var div = "#id_dist";
    ejectAjax(url, data, div);
}