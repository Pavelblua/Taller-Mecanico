<?php
namespace security\conn;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\switch\typeSwitch;
use security\configuration\config;
class conection
{
    function connectDatabase()
    {
        $ts = new typeSwitch();
        $ta = $ts->type_access;

        $conf = new config();
        $credentials = $conf->type_config($ta);
        $host = $credentials['DB_HOST'];
        $user = $credentials['DB_USER'];
        $password = $credentials['DB_PASSWORD'];
        $database = $credentials['DB_NAME'];

        try {
            $connection = new \mysqli($host, $user, $password, $database);

            if ($connection->connect_error) {
                throw new Exception("Error de conexión: " . $connection->connect_error);
            }

            $connection->set_charset("utf8mb4");
            return $connection;
        } catch (Exception $e) {
            die("Conexión fallida: " . $e->getMessage());
        }
    }

    //$db = connectDatabase();
    function disconnectDatabase($connection)
    {
        if ($connection) {
            $connection->close();
        }
    }

}



