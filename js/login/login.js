function login() {
  var usuario = $("#usuario").val();
  var password = $("#password").val();

  var status;
  var title;
  var message;
  var statusLog;
  var messageLog;

  if (usuario.length == 0 || password.length == 0) {
    status = "warning";
    title = "Error de Acceso";
    message = "Verifique que haya ingresado el usuario y/o contraseña.";
    cargaModalStatus(status, title, message);
  } else {
    sentLogin(usuario, password,1).then((data) => {
      statusLog = data.status;
      messageLog = data.message;
      accesType = data.accesType;
     
      if (statusLog) {
         location.reload();
      } else {
        status = "error";
        title = "Error de Acceso";
        message = messageLog;
        cargaModalStatus(status, title, message);
      }
    });
  }
}
