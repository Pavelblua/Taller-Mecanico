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
    $js ='';
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
    
    <!-- JavaScript Bundle with Popper -->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
        <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>

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