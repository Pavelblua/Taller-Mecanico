<?php 
    spl_autoload_register(function ($clase) {

    $base = $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/';

    $archivo = $base . str_replace('\\', '/', $clase) . '.php';

    if (file_exists($archivo)) {
        require_once $archivo;
        return;
    }

    // fallback (por si acaso)
    $archivo = $base . basename($clase) . '.php';

    if (file_exists($archivo)) {
        require_once $archivo;
    }
});