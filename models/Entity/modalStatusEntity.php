<?php

namespace models\Entity;

class modalStatusEntity
{
    private $title;
    private $message;
    private $color;
    private $icon;
    private $type_button;
    private $text_color;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($message)
    {
        $this->message = $message;
        return $this;
    }

    public function getColor()
    {
        return $this->color;
    }

    public function setColor($color)
    {
        $this->color = $color;
        return $this;
    }

    public function getIcon()
    {
        return $this->icon;
    }

    public function setIcon($icon)
    {
        $this->icon = $icon;
        return $this;
    }

    public function getType_button()
    {
        return $this->type_button;
    }

    public function setType_button($type_button)
    {
        $this->type_button = $type_button;
        return $this;
    }

    public function getText_color()
    {
        return $this->text_color;
    }

    public function setText_color($text_color)
    {
        $this->text_color = $text_color;
        return $this;
    }
}