<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use services\security\loginService;
use models\Entity\loginEntity;

$serv = new loginService();
$login = new loginEntity();

$login->setUsuario_login('admin');
$login->setPassword('admin123');

$login = $serv->login($login);

print_r($login);