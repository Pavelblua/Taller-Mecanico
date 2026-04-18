<?php
namespace models\entity;
class UserEntity
{
    private $id_usuario;
    private $id_tipo_doc;
    private $tipo_doc;
    private $nro_doc;
    private $nombres;
    private $apellidos;
    private $correo;
    private $celular;
    private $direccion;
    private $referencia;
    private $id_dist;
    private $distrito;
    private $id_prov;
    private $provincia;
    private $id_dep;
    private $departamento;
    private $id_estado;
    private $estado;

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function getId_tipo_doc()
    {
        return $this->id_tipo_doc;
    }

    public function setId_tipo_doc($id_tipo_doc)
    {
        $this->id_tipo_doc = $id_tipo_doc;
        return $this;
    }

    public function getTipo_doc()
    {
        return $this->tipo_doc;
    }

    public function setTipo_doc($tipo_doc)
    {
        $this->tipo_doc = $tipo_doc;
        return $this;
    }

    public function getNro_doc()
    {
        return $this->nro_doc;
    }

    public function setNro_doc($nro_doc)
    {
        $this->nro_doc = $nro_doc;
        return $this;
    }

    public function getNombres()
    {
        return $this->nombres;
    }

    public function setNombres($nombres)
    {
        $this->nombres = $nombres;
        return $this;
    }

    public function getApellidos()
    {
        return $this->apellidos;
    }

    public function setApellidos($apellidos)
    {
        $this->apellidos = $apellidos;
        return $this;
    }

    public function getCorreo()
    {
        return $this->correo;
    }

    public function setCorreo($correo)
    {
        $this->correo = $correo;
        return $this;
    }

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
        return $this;
    }

    public function getDireccion()
    {
        return $this->direccion;
    }

    public function setDireccion($direccion)
    {
        $this->direccion = $direccion;
        return $this;
    }

    public function getReferencia()
    {
        return $this->referencia;
    }

    public function setReferencia($referencia)
    {
        $this->referencia = $referencia;
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

    public function getDistrito()
    {
        return $this->distrito;
    }

    public function setDistrito($distrito)
    {
        $this->distrito = $distrito;
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

    public function getProvincia()
    {
        return $this->provincia;
    }

    public function setProvincia($provincia)
    {
        $this->provincia = $provincia;
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

    public function getDepartamento()
    {
        return $this->departamento;
    }

    public function setDepartamento($departamento)
    {
        $this->departamento = $departamento;
        return $this;
    }

    public function getId_estado()
    {
        return $this->id_estado;
    }

    public function setId_estado($id_estado)
    {
        $this->id_estado = $id_estado;
        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }

    public function setEstado($estado)
    {
        $this->estado = $estado;
        return $this;
    }
}

