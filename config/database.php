<?php
$host = "localhost";
$user = "root";
$pass = "";
$dbname = "apinative"; // ubah sesuai nama database kamu

$conn = new mysqli($host, $user, $pass, $dbname);

if ($conn->connect_error) {
    die(json_encode([
        "status" => "error",
        "message" => "Koneksi gagal: " . $conn->connect_error
    ]));
}
?>
