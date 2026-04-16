<?php
//esta clase es unicamente pas wchitch que definen el tipo de acceso u otros parametros sensibles
namespace security\switch;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
class typeSwitch
{
        public $type_access = "test"; //solo se acepta valores de test y produccion
}
