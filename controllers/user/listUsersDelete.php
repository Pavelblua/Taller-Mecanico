<?php
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use services\userService;
use transformers\toolsGrid;

$search = $_POST['search'];
$serv = new userService();
$grid = new toolsGrid();

$col=['Tipo Documento', 'Nro Documento', 'Nombres', 'Apellidos', 'Celular', 'Direccion', 'Estado',''];
$dto = $serv->listUser($search);
$rows = [];

foreach ($dto as $user) {
    $value = is_array($user) ? reset($user) : $user;

    if (!is_object($value)) {
        continue;
    }

    $rows[] = [
        $value->tipo_doc,
        $value->nro_doc,
        $value->nombres,
        $value->apellidos,
        $value->celular,
        $value->direccion,
        $value->estado,
        '<button class="btn btn-outline-danger btn-sm" onclick="detailUserDelete('."'" . $value->tipo_doc."'".',' . $value->nro_doc . ')"><i class="bi bi-person-x fs-5"></i></button>'
    ];
}

$colBold = 2;
echo $grid->getTable($col, $rows, $colBold);


