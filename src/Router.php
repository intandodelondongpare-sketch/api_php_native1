<?php
require_once __DIR__ . '/Controller/UserController.php';
require_once __DIR__ . '/../config/database.php';

header("Content-Type: application/json");

$method = $_SERVER['REQUEST_METHOD'];
$requestUri = $_SERVER['REQUEST_URI'];

$userController = new UserController($conn);

if (preg_match('/\/users(\/(\d+))?/', $requestUri, $matches)) {
    $id = isset($matches[2]) ? intval($matches[2]) : null;

    switch ($method) {
        case 'GET':
            $userController->get($id);
            break;
        case 'POST':
            $userController->create();
            break;
        case 'PUT':
            $userController->update();
            break;
        case 'DELETE':
            if ($id) {
                $userController->delete($id);
            } else {
                echo json_encode(["status" => "error", "message" => "ID diperlukan untuk hapus user"]);
            }
            break;
        default:
            echo json_encode(["status" => "error", "message" => "Method tidak didukung"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Endpoint tidak ditemukan"]);
}
?>
