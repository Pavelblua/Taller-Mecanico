<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use plantillas\principal;
session_start();

$principal_page = new principal();

$page = null;
$style = null;

if (isset($_SESSION["token"]) && !empty($_SESSION["token"])) {
    $page = $principal_page->index_body($_SESSION["nombres"]);
    $style = $principal_page->index_css();
    $add_div = $principal_page->add_div();
    $js =$principal_page->index_js();
} else{
    $page = $principal_page->login_body();
    $style = $principal_page->login_css();
    $add_div = $principal_page->add_div();
    $js = $principal_page->login_js();
}

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    
    <!-- titulo -->
    <title>SystemWebTaller</title>
    
    <!-- hoja de estilo -->
    <?php echo $style; ?>

    <!-- js -->
     <?php echo $js; ?>
    
</head>
<body>
    <?php echo $page; ?>
    <?php echo $add_div; ?>
</body>
</html>