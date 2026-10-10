<?php

namespace models\entity;

class userRolsEntity
{
    private $idTipoDoc;
    private $tipoDoc;
    private $nroDoc;
    private $idUsuario;
    private $usuarioLogin;
    private $usuario;
    private $password;
    private $nombres;
    private $apellidos;
    private $celular;
    private $correo;
    private $id_rol;

    public function getIdTipoDoc()
    {
        return $this->idTipoDoc;
    }

    public function setIdTipoDoc($idTipoDoc)
    {
        $this->idTipoDoc = $idTipoDoc;
        return $this;
    }

    public function getTipoDoc()
    {
        return $this->tipoDoc;
    }

    public function setTipoDoc($tipoDoc)
    {
        $this->tipoDoc = $tipoDoc;
        return $this;
    }

    public function getNroDoc()
    {
        return $this->nroDoc;
    }

    public function setNroDoc($nroDoc)
    {
        $this->nroDoc = $nroDoc;
        return $this;
    }

    public function getIdUsuario()
    {
        return $this->idUsuario;
    }

    public function setIdUsuario($idUsuario)
    {
        $this->idUsuario = $idUsuario;
        return $this;
    }

    public function getUsuarioLogin()
    {
        return $this->usuarioLogin;
    }

    public function setUsuarioLogin($usuarioLogin)
    {
        $this->usuarioLogin = $usuarioLogin;
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

    public function getPassword()
    {
        return $this->password;
    }

    public function setPassword($password)
    {
        $this->password = $password;
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

    public function getCelular()
    {
        return $this->celular;
    }

    public function setCelular($celular)
    {
        $this->celular = $celular;
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

    public function getId_rol()
    {
        return $this->id_rol;
    }

    public function setId_rol($id_rol)
    {
        $this->id_rol = $id_rol;
        return $this;
    }
}