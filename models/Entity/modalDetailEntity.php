<?php

namespace models\Entity;

class modalDetailEntity
{
    private $title;
    private $body;
    private $colortitle;
    private $buttons;
    private $iconTitle;

    public function getTitle()
    {
        return $this->title;
    }

    public function setTitle($title)
    {
        $this->title = $title;
        return $this;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

    public function getColortitle()
    {
        return $this->colortitle;
    }

    public function setColortitle($colortitle)
    {
        $this->colortitle = $colortitle;
        return $this;
    }

    public function getButtons()
    {
        return $this->buttons;
    }

    public function setButtons($buttons)
    {
        $this->buttons = $buttons;
        return $this;
    }

    public function getIconTitle()
    {
        return $this->iconTitle;
    }

    public function setIconTitle($iconTitle)
    {
        $this->iconTitle = $iconTitle;
        return $this;
    }
}