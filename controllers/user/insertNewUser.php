<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use models\entity\UserEntity;
use services\userService;
use models\Entity\statusEntity;
use modal\modal_status\modalStatus;
use models\Entity\modalStatusEntity;
use transformers\toolsModal;

$user = new UserEntity();
$serv = new userService();
$status = new statusEntity();

$entity = new modalStatusEntity();
$modal = new modalStatus();
$tools = new toolsModal();

$user->setId_tipo_doc($_POST['id_tipo_doc']);
$user->setNro_doc($_POST['nro_doc']);
$user->setNombres($_POST['nombres']);
$user->setApellidos($_POST['apellidos']);
$user->setCorreo($_POST['correo']);
$user->setCelular($_POST['celular']);
$user->setDireccion($_POST['direccion']);
$user->setReferencia($_POST['referencia']);
$user->setId_dep($_POST['id_dep']);
$user->setId_prov($_POST['id_prov']);
$user->setId_dist($_POST['id_dist']);

$status = $serv->createUserFront($user);

if ($status->getStatus() == 0) {
    $typeStatus = "error";
} else {
    $typeStatus = "success";
}

$entity->setTitle("Creacion de Usuarios");
$entity->setMessage($status->getMessage());
$entity->setColor($tools->typeModal($typeStatus));
$entity->setIcon($tools->iconModal($typeStatus));
$entity->setType_Button($tools->buttonModal($typeStatus));
$entity->setText_color($tools->textColorModal($typeStatus));

echo $modal->status($entity);
