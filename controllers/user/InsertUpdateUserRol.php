<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use models\Entity\userRolsEntity;
use repositories\userRep;
use models\Entity\modalStatusEntity;
use modal\modal_status\modalStatus;
use security\configuration\config;
use transformers\toolsModal;

$user = new userRolsEntity();
$rep = new userRep();
$config = new config();
$tools = new toolsModal();

$user->setIdUsuario($_POST['id']);
$user->setUsuarioLogin($_POST['usuario']);
$user->setPassword( $config->generatePasswordHash($_POST['password']));
$user->setId_Rol($_POST['id_rol']);

$response = $rep->createUserRol($user);
$modalE = new modalStatusEntity();
$modalS = new modalStatus(); 
$modalE->setTitle('Creación y Actualización de Roles');

$typeStatus = null;

if ($response['success']) {
    $typeStatus = "success";
} else {
    $typeStatus = "error";
}

$modalE->setMessage($response['message']);
$modalE->setColor($tools->typeModal($typeStatus));
$modalE->setIcon($tools->iconModal($typeStatus));
$modalE->setType_Button($tools->buttonModal($typeStatus));
$modalE->setText_color($tools->textColorModal($typeStatus));

echo $modalS->status($modalE);