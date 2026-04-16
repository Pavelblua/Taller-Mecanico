<?php

namespace repositories\security;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\conn\conection;
use models\Entity\loginEntity;
class loginRep
{
    public function login(loginEntity $login)
    {
        $conn = new conection();
        $connection = $conn->connectDatabase();

        $user = $connection->real_escape_string($login->getUsuario_login());
        $result = $connection->query("CALL search_login('$user', @id_usuario, @password_hash, @error_code, @error_message)");

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $result->free();

            // Debug: return row for inspection
            $login->setId_usuario($row['id_usuario']);
            $login->setPassword_hash($row['password_hash']);
            $login->setMessage($row['error_message']);
            $login->setMessage_code($row['error_code']);

            return $login;
        }

        $connection->close();
        $login->setId_usuario(0);
        $login->setPassword_hash(null);
        $login->setMessage("no se Encontro el Usuario");
        $login->setMessage_code(404);
        return $login;
    }
}
