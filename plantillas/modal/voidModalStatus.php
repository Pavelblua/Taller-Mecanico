<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use modal\modal_status\modalStatus;
use models\Entity\modalStatusEntity;
use transformers\toolsModal;

$entity = new modalStatusEntity();
$modal = new modalStatus();
$tools = new toolsModal();

$status = $_POST['status'];
$entity->setTitle($_POST['title']);
$entity->setMessage($_POST['message']);

$entity->setColor($tools->typeModal($status));
$entity->setIcon($tools->iconModal($status));
$entity->setType_Button($tools->buttonModal($status));
$entity->setText_color($tools->textColorModal($status));



echo $modal->status($entity);