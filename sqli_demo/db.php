<?php
// db.php
$host = "localhost";
$user = "root";
$pass = "";        // En XAMPP suele estar vacío
$db   = "lab_sqli";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}

$conn->set_charset("utf8mb4");