<?php

namespace models\entity;

class sessionUser
{
    private $id_usuario;
    private $usuario;
    private $hash;
    private $nombres;
    private $correo;
    private $celular;
    private $rol;
    private $id_rol;
    private $autenticado;

    public function getId_usuario()
    {
        return $this->id_usuario;
    }

    public function setId_usuario($id_usuario)
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function getUsuario()
    {
        return $this->usuario;
    }

    public function setUsuario($usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getHash()
    {
        return $this->hash;
    }

    public function setHash($hash)
    {
        $this->hash = $hash;
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

    public function getRol()
    {
        return $this->rol;
    }

    public function setRol($rol)
    {
        $this->rol = $rol;
        return $this;
    }

    public function getId_rol()
    {
        return $this->id_rol;
    }

    public function setId_rol($id_rol)
    {
        $this->id_rol = $id_rol;
        return $this;
    }

    public function getAutenticado()
    {
        return $this->autenticado;
    }

    public function setAutenticado($autenticado)
    {
        $this->autenticado = $autenticado;
        return $this;
    }
}