<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use controllers\comboCont;

$combo = new comboCont();
$idDep = $_POST['idDepa'] ?? '';
$idProv = $_POST['idProv'] ?? '';

echo $combo->cboDistrito($idDep, $idProv, '');