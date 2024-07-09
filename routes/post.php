<?php

require '../headers.php';
require '../autoload.php';
require_once "../Database/enviroment.php";

use App\Repository\ProductRepository;
use App\Entity\ProductFactory;
use App\Database\Database;

// DB Variable
$database = null;

try {
    // Intialising DB object, and productRepository ORM.
    $database = new Database($HOSTNAME, $DBNAME, $USERNAME, $PASSWORD);
    $productRepository = new ProductRepository($database);

    // Handle the incoming request
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $input = json_decode(file_get_contents('php://input'), true);
        $product = ProductFactory::create($input['attribute_name'], $input['sku'], $input['name'], $input['price'], $input['attribute_value']);

        if ($product) {
            $productRepository->save($product);
            echo json_encode(['message' => 'Product saved']);
            http_response_code(200);
        } else {
            echo json_encode(['message' => 'Invalid product type']);
            http_response_code(400);
        }

        $database->close();
    }
} catch (Exception $err) {
    if ($database) {
        $database->close();
    }

    echo json_encode(['message' => $err->getMessage()]);
    http_response_code(500);
}