<?php

namespace App\Entity;

use App\Entity\Furniture;
use App\Entity\Book;
use App\Entity\DVD;

class ProductFactory
{
    public static function create($type, $sku, $name, $price, $attribute)
    {
        switch ($type) {
            case 'DVD':
                $product = new DVD($sku, $name, $price);
                break;
            case 'Book':
                $product = new Book($sku, $name, $price);
                break;
            case 'Furniture':
                $product = new Furniture($sku, $name, $price);
                break;
            default:
                throw new \InvalidArgumentException('Invalid product type');
        }

        $product->setAttributeValue($attribute);
        return $product;
    }
}
