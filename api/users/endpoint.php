<?php

require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
$method = $_SERVER['REQUEST_METHOD'];
$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$uri = str_replace('/tallerWeb/api/users', '', $uri);
$uri = rtrim($uri, '/');
require_once __DIR__ . '/api.php';

