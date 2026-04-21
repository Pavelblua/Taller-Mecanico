<?php

namespace models\Entity;

class ubigeoEntity
{
    private $departamento;
    private $id_dep;
    private $provincia;
    private $id_prov;
    private $distrito;
    private $id_dist;

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
        return $this;
    }

    public function getId_dep()
    {
        return $this->id_dep;
    }

    public function setId_dep($id_dep)
    {
        $this->id_dep = $id_dep;
        return $this;
    }

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
        return $this;
    }

    public function getId_prov()
    {
        return $this->id_prov;
    }

    public function setId_prov($id_prov)
    {
        $this->id_prov = $id_prov;
        return $this;
    }

    public function getDistrito()
    {
        return $this->distrito;
    }

    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
        return $this;
    }

    public function getId_dist()
    {
        return $this->id_dist;
    }

    public function setId_dist($id_dist)
    {
        $this->id_dist = $id_dist;
        return $this;
    }
}