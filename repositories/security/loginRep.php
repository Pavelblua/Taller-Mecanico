<?php
namespace repositories\security;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\conn\conection;
use models\Entity\loginEntity;

class loginRep
{
    public function login(loginEntity $login): loginEntity
    {
        $conn = new conection();
        $connection = $conn->connectDatabase();

        $stmt = $connection->prepare(
            "CALL search_login(?, @id_usuario, @password_hash, @error_code, @error_message)"
        );
        $user = $login->getUsuario_login();
        $stmt->bind_param("s", $user);
        $stmt->execute();
        $stmt->close();
        $result = $connection->query(
            "SELECT @id_usuario    AS id_usuario,
                    @password_hash AS password_hash,
                    @error_code    AS error_code,
                    @error_message AS error_message"
        );

        if ($result && $result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $result->free();
            if ($row['error_code'] == 0 && $row['id_usuario'] !== null) {
                $login->setId_usuario((int)$row['id_usuario']);
                $login->setPassword_hash($row['password_hash']);
                $login->setMessage($row['error_message'] ?? 'ok');
                $login->setMessage_code(0);
                return $login;
            }
        }

        $connection->close();
        $login->setId_usuario(null);
        $login->setPassword_hash(null);
        $login->setMessage("No se encontró el usuario");
        $login->setMessage_code(404);
        return $login;
    }
}