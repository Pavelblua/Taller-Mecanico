<?php

namespace repositories;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\conn\conection;
use models\entity\UserEntity;
use models\entity\userRolsEntity;

class userRep
{
    public function createUser(UserEntity $user): UserEntity
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();
        $id_tipo_doc = $user->getId_tipo_doc();
        $nro_doc = $user->getNro_doc();
        $nombres = $user->getNombres();
        $apellidos = $user->getApellidos();
        $correo = $user->getCorreo();
        $celular = $user->getCelular();
        $direccion = $user->getDireccion();
        $referencia = $user->getReferencia();
        $id_dep = $user->getId_dep();
        $id_prov = $user->getId_prov();
        $id_dist = $user->getId_dist();
        $id_estado = $user->getId_estado();
        
        $query = "CALL crea_usuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param(
            "issssssssssi",
            $id_tipo_doc,
            $nro_doc,
            $nombres,
            $apellidos,
            $correo,
            $celular,
            $direccion,
            $referencia,
            $id_dep,
            $id_prov,
            $id_dist,
            $id_estado
        );
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $user->setId_usuario($row['id_usuario']);
        }
        
        $stmt->close();
        $conect->close();

        return $user;
    }

    public function detailUser(UserEntity $user):UserEntity
    {
         $conn = new conection();
        $conect = $conn->connectDatabase();

        $id_tipo_doc = $user->getId_tipo_doc();
        $nro_doc = $user->getNro_doc();
        
        $query = "CALL detalle_usuario(?, ?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("ss", $id_tipo_doc, $nro_doc);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $user->setId_usuario($row['id_usuario']);
            $user->setTipo_doc($row['tipo_doc']);
            $user->setId_tipo_doc($row['id_tipo_doc']);
            $user->setNro_doc($row['nro_doc']);
            $user->setNombres($row['nombres']);
            $user->setApellidos($row['apellidos']);
            $user->setCorreo($row['correo']);
            $user->setCelular($row['celular']);
            $user->setDireccion($row['direccion']);
            $user->setReferencia($row['referencia']);
            $user->setId_dep($row['id_dep']);
            $user->setDepartamento($row['departamento']);
            $user->setId_prov($row['id_prov']);
            $user->setProvincia($row['provincia']);
            $user->setId_dist($row['id_dist']);
            $user->setDistrito($row['distrito']);
            $user->setId_estado($row['id_estado']);
            $user->setEstado($row['estado']);
        }
        
        $stmt->close();
        $conect->close();

        return $user;
    }

    public function updateUser(UserEntity $user)
    {
        $estadoUpdate=null;

        try {
            $conn = new conection();
            $conect = $conn->connectDatabase();

            $id_tipo_doc = $user->getId_tipo_doc();
            $nro_doc = $user->getNro_doc();
            $nombres = $user->getNombres();
            $apellidos = $user->getApellidos();
            $correo = $user->getCorreo();
            $celular = $user->getCelular();
            $direccion = $user->getDireccion();
            $referencia = $user->getReferencia();
            $id_dep = $user->getId_dep();
            $id_prov = $user->getId_prov();
            $id_dist = $user->getId_dist();
            $id_estado = $user->getId_estado();
            
            $query = "CALL actualiza_usuario(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $conect->prepare($query);
            $stmt->bind_param(
                "issssssssssi",
                $id_tipo_doc,
                $nro_doc,
                $nombres,
                $apellidos,
                $correo,
                $celular,
                $direccion,
                $referencia,
                $id_dep,
                $id_prov,
                $id_dist,
                $id_estado
            );
            $stmt->execute();
            $result = $stmt->get_result();
            
            $estadoUpdate="Error Desconocido";
            
            if ($result && $row = $result->fetch_assoc()) {
                $estadoUpdate= $row['mensaje'];
            }
            
            $stmt->close();
            $conect->close();
            
            
        } catch (\Exception $e) {
            $estadoUpdate = "Error codigo: ".$e->getCode()." Mensaje: ".$e->getMessage();
        }

        return $estadoUpdate;
    }
    
    public function listUser($search = null)
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();
        if ($search === null) {
            $search = "";
        }
        $query = "CALL lista_usuario(?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("s", $search);
        $stmt->execute();
        $result = $stmt->get_result();
        
        $users = [];
        if ($result) {
            while ($row = $result->fetch_object()) {
                $users[] = $row;
            }
        }
        
        $stmt->close();
        $conect->close();
        
        return $users;
    }

     public function detailUserRols(userRolsEntity $user):userRolsEntity
    {
         $conn = new conection();
        $conect = $conn->connectDatabase();

        $id_tipo_doc = $user->getIdTipoDoc();
        $nro_doc = $user->getNroDoc();
        
        $query = "CALL userRolsDetail(?, ?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("ss", $id_tipo_doc, $nro_doc);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $user->setidTipoDoc($row['id_tipo_doc']);
            $user->setNroDoc($row['nro_doc']);
            $user->setIdUsuario($row['id_usuario']);
            $user->setUsuarioLogin($row['usuario_login']);
            $user->setNombres($row['nombres']);
            $user->setApellidos($row['apellidos']);
            $user->setCelular($row['celular']);
            $user->setCorreo($row['correo']);
            $user->setId_rol($row['id_rol']);

        }
        
        $stmt->close();
        $conect->close();

        return $user;
    }

    public function searchUserName($userName)
    {
         $conn = new conection();
        $conect = $conn->connectDatabase();

        $query = "CALL searchUser(?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("s", $userName);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        $data = [];
        if ($row) {
            $data[0] =$row['id_usuario'];
            $data[1] =$row['usuario_login'];

        }
        
        $stmt->close();
        $conect->close();

        return $data;
    }

    public function createUserRol(userRolsEntity $user): array
    {
        $conect = null;
        $stmt = null;

        try {
            $conn = new conection();
            $conect = $conn->connectDatabase();
            $idUsuario = $user->getIdUsuario();
            $usuarioLogin = $user->getUsuarioLogin();
            $password = $user->getPassword();
            $idRol = $user->getId_rol();

            $query = "CALL InsertUpdateUserRol(?, ?, ?, ?)";
            $stmt = $conect->prepare($query);
            if (!$stmt) {
                throw new \RuntimeException($conect->error);
            }

            if (!$stmt->bind_param(
                "issi",
                $idUsuario,
                $usuarioLogin,
                $password,
                $idRol
            )) {
                throw new \RuntimeException($stmt->error);
            }

            if (!$stmt->execute()) {
                throw new \RuntimeException($stmt->error);
            }

            return [
                'success' => true,
                'message' => 'Ejecucion exitosa'
            ];
        } catch (\Throwable $exception) {
            return [
                'success' => false,
                'message' => "Error codigo: " . $exception->getCode() . " Mensaje: " . $exception->getMessage()
            ];
        } finally {
            if ($stmt) {
                $stmt->close();
            }
            if ($conect) {
                $conect->close();
            }
        }
    }
    
}
