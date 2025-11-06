<?php
require_once __DIR__ . '/Controller/UserController.php';

$method = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['REQUEST_URI'];

// Ambil koneksi database
require_once __DIR__ . '/../config/database.php';
$userController = new UserController($conn);

header("Content-Type: application/json");

if (preg_match('/\/users(\/(\d+))?/', $path, $matches)) {
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
                echo json_encode(["status" => "error", "message" => "ID diperlukan untuk menghapus user"]);
            }
            break;
        default:
            echo json_encode(["status" => "error", "message" => "Metode tidak didukung"]);
            break;
    }
} else {
    echo json_encode(["status" => "error", "message" => "Endpoint tidak ditemukan"]);
}
?>
