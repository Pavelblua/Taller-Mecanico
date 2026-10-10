<?php

namespace security\configuration;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

class config
{
    public function type_config($ta){
        $credentials = array();
        if($ta =="test"){
            $credentials['DB_HOST'] = 'localhost';
            $credentials['DB_USER'] ='root';
            $credentials['DB_PASSWORD'] ='';
            $credentials['DB_NAME'] ='taller_pro';
        } else if ($ta =="produccion"){
           $credentials['DB_HOST'] = '162.241.62.141';
            $credentials['DB_USER'] ='lacampin_preb';
            $credentials['DB_PASSWORD'] ='Preb06112427@';
            $credentials['DB_NAME'] ='lacampin_taller_pro';
        } else {
            $credentials['DB_HOST'] ='';
            $credentials['DB_USER'] ='';
            $credentials['DB_PASSWORD'] ='';
            $credentials['DB_NAME'] ='';
        }
        return $credentials;
    }

    public function rootImageUser()
    {
        $root[] = ['../../imageUser/', 'imagen', './imageUser/'];
        return $root;
    }

    public function generatePasswordHash(string $password): string
    {
        if ($password === '') {
            throw new \InvalidArgumentException('La contraseña no puede estar vacía');
        }

        $hash = password_hash($password, PASSWORD_DEFAULT);
        if ($hash === false) {
            throw new \RuntimeException('No se pudo generar el hash de la contraseña');
        }

        return $hash;
    }

    public function getParticulas(){
        $particulas = ['del', 'de', 'la', 'las', 'los'];
        return $particulas;
    }

    
}
