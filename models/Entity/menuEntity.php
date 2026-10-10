<?php

namespace models\Entity;

class menuEntity
{
    private $idModulo;
    private $nombre;
    private $icono;
    private $url;
    private $idPadre;
    private $idHijo;

    public function getIdModulo()
    {
        return $this->idModulo;
    }

    public function setIdModulo($idModulo)
    {
        $this->idModulo = $idModulo;
        return $this;
    }

    public function getNombre()
    {
        return $this->nombre;
    }

    public function setNombre($nombre)
    {
        $this->nombre = $nombre;
        return $this;
    }

    public function getIcono()
    {
        return $this->icono;
    }

    public function setIcono($icono)
    {
        $this->icono = $icono;
        return $this;
    }

    public function getUrl()
    {
        return $this->url;
    }

    public function setUrl($url)
    {
        $this->url = $url;
        return $this;
    }

    public function getIdPadre()
    {
        return $this->idPadre;
    }

    public function setIdPadre($idPadre)
    {
        $this->idPadre = $idPadre;
        return $this;
    }

    public function getIdHijo()
    {
        return $this->idHijo;
    }

    public function setIdHijo($idHijo)
    {
        $this->idHijo = $idHijo;
        return $this;
    }
}