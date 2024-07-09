<?php

namespace App\Entity;

class Book extends Product
{
    private $weight;

    public function getAttributeName()
    {
        return "Book";
    }

    public function getAttributeValue()
    {
        return $this->weight;
    }

    public function setAttributeValue($weight)
    {
        $this->weight = $weight;
    }
}
