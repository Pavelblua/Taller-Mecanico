<?php

namespace repositories;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\conn\conection;
use models\Entity\ubigeoEntity;
class ubigeoRep
{
    public function getIdDepartamento(ubigeoEntity $ubigeo): ubigeoEntity
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();

        $nombre = $ubigeo->getDepartamento();
        
        $query = "CALL ubigeo_dep(?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("s", $nombre);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $ubigeo->setId_dep($row['id_dep']);
        }
        
        $stmt->close();
        $conect->close();
        
        return $ubigeo;
    }

    public function getIdProvincia(ubigeoEntity $ubigeo):ubigeoEntity
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();

        $id_dep = $ubigeo->getId_dep();
        $nombre = $ubigeo->getProvincia();
        
        $query = "CALL ubigeo_prov(?, ?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("ss", $id_dep, $nombre);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $ubigeo->setId_prov($row['id_prov']);
        }
        
        $stmt->close();
        $conect->close();
        
        return $ubigeo;
    }

    public function getIdDistrito(ubigeoEntity $ubigeo): ubigeoEntity
    {
         $conn = new conection();
        $conect = $conn->connectDatabase();

        $id_dep = $ubigeo->getId_dep();
        $id_prov = $ubigeo->getId_prov();
        $nombre = $ubigeo->getDistrito();
        
        $query = "CALL ubigeo_dist(?, ?, ?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("sss", $id_dep, $id_prov, $nombre);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $ubigeo->setId_dist($row['id_dist']);
        }
        
        $stmt->close();
        $conect->close();
        
         return $ubigeo;
    }

    public function getTotalIdUbigeo(ubigeoEntity $ubigeo): ubigeoEntity
    {
        $ubigeo = $this->getIdDepartamento($ubigeo);
        $ubigeo = $this->getIdProvincia($ubigeo);
        $ubigeo = $this->getIdDistrito($ubigeo);

        return $ubigeo;
    }
}
