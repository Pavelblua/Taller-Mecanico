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

    public function getNameDepartamento(ubigeoEntity $ubigeo): ubigeoEntity
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();

        $id = $ubigeo->getId_dep();
        
        $query = "CALL ubigeo_depDet(?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $ubigeo->setDepartamento($row['nombre']);
        }
        
        $stmt->close();
        $conect->close();
        
        return $ubigeo;
    }

    public function getNameProvincia(ubigeoEntity $ubigeo):ubigeoEntity
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();

        $id_dep = $ubigeo->getId_dep();
        $Id_prov = $ubigeo->getId_prov();
        
        $query = "CALL ubigeo_provDet(?, ?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("ii", $id_dep, $id_prov);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $ubigeo->setProvincia($row['nombre']);
        }
        
        $stmt->close();
        $conect->close();
        
        return $ubigeo;
    }

    public function getNameDistrito(ubigeoEntity $ubigeo): ubigeoEntity
    {
         $conn = new conection();
        $conect = $conn->connectDatabase();

        $id_dep = $ubigeo->getId_dep();
        $id_prov = $ubigeo->getId_prov();
        $id_dist = $ubigeo->getId_dist();
        
        $query = "CALL ubigeo_distDet(?, ?, ?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("iii", $id_dep, $id_prov, $id_dist);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $ubigeo->setDistrito($row['nombre']);
        }
        
        $stmt->close();
        $conect->close();
        
         return $ubigeo;
    }

    public function getTotalnameUbigeo(ubigeoEntity $ubigeo): ubigeoEntity
    {
        $ubigeo = $this->getNameDepartamento($ubigeo);
        $ubigeo = $this->getNameProvincia($ubigeo);
        $ubigeo = $this->getNameDistrito($ubigeo);

        return $ubigeo;
    }
}
