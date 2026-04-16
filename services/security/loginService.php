<?php

namespace services\security;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use repositories\security\loginRep;
use models\Entity\loginEntity;

class loginService
{
    public function login(loginEntity $login){
        $rep = new loginRep();
        $login = $rep->login($login);
        if(password_verify($login->getPassword(), $login->getPassword_Hash())){
            $login->setMessage("Login exitoso");
            $login->setMessage_code(200);
        } else {
            $login->setMessage("Credenciales incorrectas");
            $login->setMessage_code(401);
        }
        return $login;
    }
}
