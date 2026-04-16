<?php

require_once __DIR__ . '/../Entity/UserEntity.php';

class UserDTO
{
    private int $id;
    private string $name;
    private string $email;

    public function __construct(UserEntity $entity)
    {
        $this->id = $entity->getId();
        $this->name = $entity->getName();
        $this->email = $entity->getEmail();
    }

    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
        ];
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }
}
