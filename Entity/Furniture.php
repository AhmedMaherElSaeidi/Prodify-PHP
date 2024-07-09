<?php

namespace App\Entity;

class Furniture extends Product
{
    private $dimensions;

    public function getAttributeName()
    {
        return "Furniture";
    }

    public function getAttributeValue()
    {
        return $this->dimensions;
    }

    public function setAttributeValue($dimensions)
    {
        $this->dimensions = $dimensions;
    }
}
