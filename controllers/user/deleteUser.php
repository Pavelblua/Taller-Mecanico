<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use models\entity\UserEntity;
use repositories\aditionalsRep;
use repositories\userRep;
use services\userService;
use models\Entity\modalStatusEntity;
use modal\modal_status\modalStatus;
use transformers\toolsModal;
use models\Entity\statusEntity;

$ad = new aditionalsRep();
$user = new UserEntity();
$rep = new userRep();
$serv = new userService();
$entity = new modalStatusEntity();
$modal = new modalStatus();
$tools = new toolsModal();
$status = new statusEntity();

$user->setTipo_doc($_POST['tipo_doc']);
$user->setId_tipo_doc($ad->getIdTypeDocument($_POST['tipo_doc']));
$user->setNro_doc($_POST['num_doc']);
$user=$rep->detailUser($user);

$user->setId_estado(2);

$status = $serv->updateUserFront($user);

if ($status->getStatus() == 0) {
    $typeStatus = "error";
} else {
    $typeStatus = "success";
}

$entity->setTitle("Baja de Usuarios");
$entity->setMessage($status->getMessage());
$entity->setColor($tools->typeModal($typeStatus));
$entity->setIcon($tools->iconModal($typeStatus));
$entity->setType_Button($tools->buttonModal($typeStatus));
$entity->setText_color($tools->textColorModal($typeStatus));

echo $modal->status($entity);
