<?php

namespace models\entity;

class UserEntity extends ubigeoEntity
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