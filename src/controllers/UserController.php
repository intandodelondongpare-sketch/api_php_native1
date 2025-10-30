<?php
namespace Src\Controllers;

require_once __DIR__ . '/../../config/database.php';

use database;
use PDO;

class UserController {
    private $conn;

    public function __construct() {
        $database = new database();
        $this->conn = $database->getConnection();
    }

    public function index() {
        $query = "SELECT * FROM users";
        $stmt = $this->conn->prepare($query);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($data);
    }

    public function show($id) {
        $query = "SELECT * FROM users WHERE id = :id";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        header('Content-Type: application/json');
        echo json_encode($data);
    }
}
?>
