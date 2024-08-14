<?php
include 'conexion.php';

// Generar un folio único y más corto
$folio = 'FOLIO-' . mt_rand(1000, 9999);

// Recibir datos del formulario
$email = $_POST['email'];
$servicio = $_POST['servicio'];
$coditr = $_POST['coditr'];
$linea_telefonica = $_POST['linea_telefonica'];
$message = $_POST['message'];

// Manejar el archivo subido
$acuerdo_comercial = $_FILES['acuerdo_comercial']['tmp_name'];
$acuerdo_comercial_content = addslashes(file_get_contents($acuerdo_comercial));


// Insertar datos en la base de datos
$sql = "INSERT INTO mantenimiento (folio, email, servicio, coditr, linea_telefonica, acuerdo_comercial, message) 
        VALUES ('$folio', '$email', '$servicio', '$coditr', '$linea_telefonica', '$acuerdo_comercial_content', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Solicitud enviada exitosamente con el folio: $folio. <a href='index.php'>Volver</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
