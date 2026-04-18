<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use api\users\authController;

$aut = new authController();

match (true){
    $method ==='POST' && $uri === '/create' => $aut->createUser(),
    default => response404()
};

function response404() {
    header('Content-Type: application/json');
    http_response_code(404);
    echo json_encode(['status' => false, 'message' => 'Ruta no encontrada']);
    exit;
}