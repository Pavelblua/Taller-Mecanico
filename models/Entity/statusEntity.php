<?php

namespace models\Entity;

class statusEntity
{
    private int $status;
    private string $message;
    private int $message_code;
    private string $error_message;
    private int $error_code;

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): self
    {
        $this->status = $status;
        return $this;
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function setMessage(string $message): self
    {
        $this->message = $message;
        return $this;
    }

    public function getMessage_code(): int
    {
        return $this->message_code;
    }

    public function setMessage_code(int $message_code): self
    {
        $this->message_code = $message_code;
        return $this;
    }

    public function getError_message(): string
    {
        return $this->error_message;
    }

    public function setError_message(string $error_message): self
    {
        $this->error_message = $error_message;
        return $this;
    }

    public function getError_code(): int
    {
        return $this->error_code;
    }

    public function setError_code(int $error_code): self
    {
        $this->error_code = $error_code;
        return $this;
    }
}