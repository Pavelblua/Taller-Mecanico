<?php
namespace services\security;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use repositories\security\loginRep;
use models\Entity\loginEntity;
use security\JwtHelper;
class loginService
{
    public function login(loginEntity $login): loginEntity
    {
        $rep = new loginRep();
        $login = $rep->login($login);

        if ($login->getMessage_code() !== 0) {
            return $login;
        }

        if (
            $login->getPassword_hash() !== null &&
            password_verify($login->getPassword(), $login->getPassword_hash())
        ) {
            $token = JwtHelper::generate($login->getId_usuario());
            $login->setToken($token);
            $login->setMessage("Login exitoso");
            $login->setMessage_code(200);
        } else {
            $login->setId_usuario(null); 
            $login->setMessage("Credenciales incorrectas");
            $login->setMessage_code(401);
        }

        return $login;
    }

}