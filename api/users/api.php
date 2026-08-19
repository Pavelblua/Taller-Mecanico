<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use api\users\authController;
use models\Entity\statusEntity;
use transformers\responses;

$aut = new authController();

$updateMatch = [];
$isUpdateRoute = preg_match(
    '#^/update/([^/]+)/([^/]+)$#',
    $uri,
    $updateMatch
);

match (true){
    $method ==='POST' && $uri === '/create' => $aut->createUser(),
    $method ==='PATCH' && $isUpdateRoute === 1
        => $aut->updateUser($updateMatch[1], $updateMatch[2]),
     $method === 'GET' && $uri === '/list'
        => $aut->listUser($_GET['search'] ?? null),
     $method === 'POST' && $uri === '/uploadimage'
        => $aut->uploadImage(),
    default => response404()
};

function response404() {
    $sts = new statusEntity();
    $res = new responses();

    //header('Content-Type: application/json');
    $sts->setStatus(0);
    $sts->setError_code(404);
    $sts->setError_message('Ruta no encontrada');
    $res->sendEntity($sts);
}