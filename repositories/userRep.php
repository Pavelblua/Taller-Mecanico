<?php

namespace repositories;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\conn\conection;
use models\entity\UserEntity;
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
    
}
