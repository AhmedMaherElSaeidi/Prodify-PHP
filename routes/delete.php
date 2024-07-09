<?php

require '../headers.php';
require '../autoload.php';
require_once "../Database/enviroment.php";

use App\Repository\ProductRepository;
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

        if ($input === null && json_last_error() !== JSON_ERROR_NONE) {
            echo json_encode(['message' => 'Invalid JSON data']);
            exit;
        }

        if (isset($input['id'])) {
            $affected_rows = $productRepository->delete($input['id']);
            echo json_encode(['message' => "$affected_rows rows affected."]);
            http_response_code(200);
        } else {
            echo json_encode(['message' => 'Missing or invalid ID']);
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