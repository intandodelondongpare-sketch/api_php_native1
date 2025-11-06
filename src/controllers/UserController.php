<?php
require_once __DIR__ . '/../../config/database.php';

class UserController {
    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
    }

    // GET - ambil semua user atau satu user
    public function get($id = null) {
        if ($id) {
            $sql = "SELECT * FROM users WHERE id = $id";
            $result = $this->conn->query($sql);
            echo json_encode($result->fetch_assoc());
        } else {
            $sql = "SELECT * FROM users";
            $result = $this->conn->query($sql);
            $users = [];
            while ($row = $result->fetch_assoc()) {
                $users[] = $row;
            }
            echo json_encode($users);
        }
    }

    // POST - tambah user baru
    public function create() {
        $data = json_decode(file_get_contents('php://input'), true);
        $username = $this->conn->real_escape_string($data['username']);
        $email = $this->conn->real_escape_string($data['email']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
        if ($this->conn->query($sql)) {
            echo json_encode(["status" => "success", "message" => "User berhasil ditambahkan"]);
        } else {
            echo json_encode(["status" => "error", "message" => $this->conn->error]);
        }
    }

    // PUT - update user
    public function update() {
        $data = json_decode(file_get_contents('php://input'), true);
        $id = intval($data['id']);
        $username = $this->conn->real_escape_string($data['username']);
        $email = $this->conn->real_escape_string($data['email']);
        $password = password_hash($data['password'], PASSWORD_DEFAULT);

        $sql = "UPDATE users SET username='$username', email='$email', password='$password' WHERE id=$id";
        if ($this->conn->query($sql)) {
            echo json_encode(["status" => "success", "message" => "User berhasil diperbarui"]);
        } else {
            echo json_encode(["status" => "error", "message" => $this->conn->error]);
        }
    }

    // DELETE - hapus user
    public function delete($id) {
        $sql = "DELETE FROM users WHERE id = $id";
        if ($this->conn->query($sql)) {
            echo json_encode(["status" => "success", "message" => "User berhasil dihapus"]);
        } else {
            echo json_encode(["status" => "error", "message" => $this->conn->error]);
        }
    }
}
?>
