<?php

namespace App\Entity;

class DVD extends Product
{
    private $size;

    public function getAttributeName()
    {
        return "DVD";
    }

    public function getAttributeValue()
    {
        return $this->size;
    }

    public function setAttributeValue($size)
    {
        $this->size = $size;
    }
}
