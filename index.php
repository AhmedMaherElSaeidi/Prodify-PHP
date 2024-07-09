<?php

require './headers.php';
require './autoload.php';
require_once "./Database/enviroment.php";

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
    switch ($_SERVER['REQUEST_METHOD']) {
        case 'OPTIONS':
            http_response_code(200);
            $database->close();
            break;
        case 'GET':
            echo json_encode($productRepository->fetchAll());
            http_response_code(201);
            $database->close();
            break;
        default:
            echo json_encode(['message' => 'Method not supported']);
            http_response_code(400);
            $database->close();
            break;
    }
} catch (Exception $err) {
    if ($database) {
        $database->close();
    }

    echo json_encode(['message' => $err->getMessage()]);
    http_response_code(500);
}