<?php

namespace repositories;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use security\conn\conection;
use models\entity\UserEntity;

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
}
