<?php

namespace repositories;
require_once $_SERVER['DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';

use security\conn\conection;
use models\Entity\comboEntity;

class combosRep
{
    public function listaDepartamentos()
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();
        $query = "select id_dep, nombre from tb_departamento";
        $result = $conect->execute_query($query);
        $departamentos = [];

        while ($row = $result->fetch_assoc()) {
            $departamento = new comboEntity();
            $departamento->setId($row['id_dep'])
                ->setNombre($row['nombre']);
            $departamentos[] = $departamento;
        }

        $result->free();
        $conect->close();

        return $departamentos;
    }

    public function listaProvincia(string $id_dep)
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();
        $query = "select id_prov, nombre from tb_provincia where id_dep = ?";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("s", $id_dep);
        $stmt->execute();

        $result = $stmt->get_result();
        $provincias = [];

        while ($row = $result->fetch_assoc()) {
            $provincia = new comboEntity();
            $provincia->setId($row['id_prov'])
                ->setNombre($row['nombre']);
            $provincias[] = $provincia;
        }

        $result->free();
        $stmt->close();
        $conect->close();

        return $provincias;
    }

    public function listaDistrito(string $id_dep, string $id_prov)
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();
        $query = "select id_dist, nombre from tb_distrito where id_dep = ? and id_prov = ?";
        $stmt = $conect->prepare($query);
        $stmt->bind_param("ss", $id_dep, $id_prov);
        $stmt->execute();

        $result = $stmt->get_result();
        $distritos = [];

        while ($row = $result->fetch_assoc()) {
            $distrito = new comboEntity();
            $distrito->setId($row['id_dist'])
                ->setNombre($row['nombre']);
            $distritos[] = $distrito;
        }

        $result->free();
        $stmt->close();
        $conect->close();

        return $distritos;
    }

    public function listaTipoDocumento()
    {
        $conn = new conection();
        $conect = $conn->connectDatabase();
        $query = "select id_tipo_doc, abreviatura  from tb_tipo_documento";
        $result = $conect->execute_query($query);
        $tipoDocumentos = [];

        while ($row = $result->fetch_assoc()) {
            $tipoDocumento = new comboEntity();
            $tipoDocumento->setId($row['id_tipo_doc'])
                ->setNombre($row['abreviatura']);
            $tipoDocumentos[] = $tipoDocumento;
        }

        $result->free();
        $conect->close();

        return $tipoDocumentos;
    }
}
