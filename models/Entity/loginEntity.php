<?php

namespace models\Entity;

require_once $_SERVER[ 'DOCUMENT_ROOT'] . '/tallerWeb/autoload.php';
use models\Entity\statusEntity;

class loginEntity extends statusEntity
{
    private int $id_usuario;
    private string $usuario_login;
    private string $password_hash;
    private string $password;

    public function getId_usuario(): int
    {
        return $this->id_usuario;
    }

    public function setId_usuario(int $id_usuario): self
    {
        $this->id_usuario = $id_usuario;
        return $this;
    }

    public function getUsuario_login(): string
    {
        return $this->usuario_login;
    }

    public function setUsuario_login(string $usuario_login): self
    {
        $this->usuario_login = $usuario_login;
        return $this;
    }

    public function getPassword_hash(): string
    {
        return $this->password_hash;
    }

    public function setPassword_hash(string $password_hash): self
    {
        $this->password_hash = $password_hash;
        return $this;
    }

    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;
        return $this;
    }
}