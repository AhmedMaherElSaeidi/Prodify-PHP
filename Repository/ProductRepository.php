<?php

namespace App\Repository;

use App\Database\Database;
use App\Entity\Product;

class ProductRepository
{
    private $db;

    public function __construct(Database $db)
    {
        $this->db = $db;
    }

    public function fetchAll()
    {
        // Fetch All products
        $sql = "SELECT p.id, p.sku, p.name, p.price, a.attribute_name, a.attribute_value
                FROM products p
                JOIN product_attributes a ON p.id = a.product_id";
        return $this->db->fetchAll($sql);
    }
	
	public function save(Product $product)
	{
		// Save product
		$sql = "INSERT INTO products (sku, name, price) VALUES (?, ?, ?)";
		$params = [
			$product->getSku(),
			$product->getName(),
			$product->getPrice()
		];
		$result = $this->db->insert($sql, $params);
		
		// Save product attributes
		$attributeSql = "INSERT INTO product_attributes (product_id, attribute_name, attribute_value) VALUES (?, ?, ?)";
		$attributeParams = [
			$result,
			$product->getAttributeName(),
			$product->getAttributeValue()
		];
		$this->db->insert($attributeSql, $attributeParams);
	}

	public function delete($id)
	{
		// Delete product
		$sql = "DELETE FROM products WHERE id = ?";
		$params = [$id];
		return $this->db->delete($sql, $params);
	}

}
