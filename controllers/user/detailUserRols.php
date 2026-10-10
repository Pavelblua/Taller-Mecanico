<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use models\entity\modalDetailEntity;
use modal\modal_status\modalStatus;
use repositories\userRep;
use models\Entity\userRolsEntity;
use repositories\aditionalsRep;
use plantillas\user\forms;
use security\configuration\config;
use transformers\tools;

$detailEntity = new modalDetailEntity();
$modal = new modalStatus();
$rep = new userRep();
$user = new userRolsEntity();
$ad = new aditionalsRep();
$form = new forms();
$config = new config();
$toolsIm = new tools();

$user->setidtipoDoc($ad->getIdTypeDocument($_POST['tipo_doc']));
$user->setTipoDoc($_POST['tipo_doc']);
$user->setNroDoc($_POST['num_doc']);

$user = $rep->detailUserRols($user);
$root= $config->rootImageUser();
$statusImage = $toolsIm->searchImage($root[0][0], $user->getNroDoc());
$patch="";
if($statusImage!=""){
    $patch=$root[0][2].$statusImage;
}

$userName = $user->getUsuarioLogin();
if($userName==""){
    $userName = $toolsIm->userName($user->getNombres(), $user->getApellidos());
}

$buttonOK='<button type="button" class="btn btn-success" onclick="CreateUpdateUserRols('."'".$user->getIdUsuario()."'".')">
          <i class="bi bi-floppy2-fill"></i>
          Guardar Rol
          </button>';

$detailEntity->setTitle('Detalle Rol de Usuario');
$detailEntity->setBody($form->detailUserRols($user, $patch, $userName));
$detailEntity->setColortitle('bg-success-subtle text-success-emphasis');
$detailEntity->setIconTitle('bi-person-lock');
$detailEntity->setButtons($buttonOK);
echo $modal->detail($detailEntity);