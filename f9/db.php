<?php
$servername = "localhost";
$username = "root";
$password = "12345678"; // Asegúrate de usar la contraseña correcta para tu configuración
$dbname = "formulario_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
