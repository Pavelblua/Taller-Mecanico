<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use models\entity\modalDetailEntity;
use modal\modal_status\modalStatus;
use repositories\userRep;
use models\Entity\UserEntity;
use repositories\aditionalsRep;
use plantillas\user\forms;
use security\configuration\config;
use transformers\tools;

$detailEntity = new modalDetailEntity();
$modal = new modalStatus();
$rep = new userRep();
$user = new UserEntity();
$ad = new aditionalsRep();
$form = new forms();
$config = new config();
$toolsIm = new tools();

$user->setid_Tipo_doc($ad->getIdTypeDocument($_POST['tipo_doc']));
$user->setNro_doc($_POST['num_doc']);

$user = $rep->detailUser($user);
$root= $config->rootImageUser();
$statusImage = $toolsIm->searchImage($root[0][0], $user->getNro_doc());
$patch="";
if($statusImage!=""){
    $patch=$root[0][2].$statusImage;
}

$detailEntity->setTitle('Detalle de Usuario');
$detailEntity->setBody($form->detailUser($user, $patch));
$detailEntity->setColortitle('bg-success-subtle text-success-emphasis');
$detailEntity->setIconTitle('bi-person-vcard');
echo $modal->detail($detailEntity);