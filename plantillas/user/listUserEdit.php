<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use plantillas\user\forms;

$new = new forms();

$js = '<script src="js/user/listUser.js"></script>';

$title ='Lista de Usuarios para Editar';

echo $new->listUserEdit($title)."<br>".$js;