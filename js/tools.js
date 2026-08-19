function ejectAjax(url_in, data_in, div_in){
    $.ajax({
            url: url_in,
            type: "POST",
            data: data_in,
            success: (function (respuesta) {
                $(div_in).html("");
                $(div_in).append(respuesta);
            })
        });
}