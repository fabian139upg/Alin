<?php
include 'conexion.php';

// Función para generar un folio único de 5 dígitos
function generarFolio($conn) {
    do {
        $folio = 'FOLIO-' . mt_rand(10000, 99999);
        $sql = "SELECT COUNT(*) AS count FROM asignacion WHERE folio = '$folio'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
    } while ($row['count'] > 0);
    return $folio;
}

// Generar un folio único
$folio = generarFolio($conn);

// Recibir datos del formulario
$email = $_POST['email'];
$servicio = $_POST['servicio'];
$coditr = $_POST['Coditr'];
$cantidad_equipos = $_POST['cantidad_equipos'];
$message = $_POST['message'];

// Manejar el archivo subido
if (isset($_FILES['acuerdo_comercial']) && $_FILES['acuerdo_comercial']['error'] == UPLOAD_ERR_OK) {
    $acuerdo_comercial = $_FILES['acuerdo_comercial']['tmp_name'];
    $acuerdo_comercial_content = addslashes(file_get_contents($acuerdo_comercial));
} else {
    die("Error al subir el archivo.");
}

// Insertar datos en la base de datos
$sql = "INSERT INTO asignacion (folio, email, servicio, coditr, cantidad_equipos, acuerdo_comercial, message) 
        VALUES ('$folio', '$email', '$servicio', '$coditr', '$cantidad_equipos', '$acuerdo_comercial_content', '$message')";

if ($conn->query($sql) === TRUE) {
    echo "Solicitud enviada exitosamente con el folio: $folio. <a href='index.php'>Volver</a>";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
