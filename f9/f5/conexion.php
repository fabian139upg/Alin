<?php
$servername = "localhost";
$username = "root";  // Cambia esto si tu usuario es diferente
$password = "12345678";      // Cambia esto si tu contraseña es diferente
$dbname = "solicitudes_reemplazo";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}
?>
