<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use plantillas\user\forms;

$new = new forms();

$js = '<script src="js/preloadImage.js"></script>';
$js .= '<script src="js/ubigeo.js"></script>';
$js .= '<script src="js/user/newUser.js"></script>';

echo $new->newUser()."<br>".$js;
