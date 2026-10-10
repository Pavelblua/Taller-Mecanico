<?php

namespace repositories;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\conn\conection;

class aditionalsRep
{
    public function getIdTypeDocument($docuemnt)
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();
        $idDocument = null;

        $query = "CALL tipo_doc(?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("s", $docuemnt);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $idDocument = $row['id_tipo_doc'];
        }
        
        $stmt->close();
        $conect->close();

        return $idDocument;
    }

    public function getNameTypeDocument($Iddocument)
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();
        $Document = null;

        $query = "CALL Name_tipo_doc(?)";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("s", $Iddocument);
        $stmt->execute();
        
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        
        if ($row) {
            $Document = $row['abreviatura'];
        }
        
        $stmt->close();
        $conect->close();

        return $Document;
    }

}
