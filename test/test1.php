<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use services\security\loginService;
use models\Entity\loginEntity;
use models\Entity\ubigeoEntity;
use repositories\ubigeoRep;

$ubi = new ubigeoEntity();
$getUbigeo = new ubigeoRep();
$ubi->setDepartamento('Lima');
$ubi->setProvincia('Lima');
$ubi->setDistrito('Chorrillos');
$ubi = $getUbigeo->getTotalIdUbigeo($ubi);

print_r($ubi);

