<?php
include 'conexion.php';  // Incluye la conexión a la base de datos

// Verificar si el formulario fue enviado
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Recoger datos del formulario
    $email = $_POST['email'];
    $servicio = $_POST['servicio'];
    $Coditr = $_POST['Coditr'];
    $linea_telefonica = $_POST['linea_telefonica'];
    $message = $_POST['message'];

    // Generar un folio único y más corto
    $folio = 'FOLIO-' . mt_rand(100000, 999999);

    // Inicializar variable para el acuerdo comercial
    $acuerdo_comercial = null;

    // Verificar si se ha subido un archivo
    if (isset($_FILES['acuerdo_comercial']) && $_FILES['acuerdo_comercial']['error'] == UPLOAD_ERR_OK) {
        $fileTmpPath = $_FILES['acuerdo_comercial']['tmp_name'];
        $fileName = $_FILES['acuerdo_comercial']['name'];
        $fileSize = $_FILES['acuerdo_comercial']['size'];
        $fileType = $_FILES['acuerdo_comercial']['type'];

        // Leer el archivo como un string binario
        $acuerdo_comercial = file_get_contents($fileTmpPath);
    }

    // Preparar la consulta SQL
    $stmt = $conn->prepare("INSERT INTO reemplazo (folio, email, servicio, Coditr, linea_telefonica, acuerdo_comercial, message) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssbss", $folio, $email, $servicio, $Coditr, $linea_telefonica, $acuerdo_comercial, $message);

    // Ejecutar la consulta y verificar el resultado
    if ($stmt->execute()) {
        // Mostrar mensaje de éxito y el folio generado
        echo "Solicitud enviada exitosamente con el folio: $folio. <a href='index.php'>Volver</a>";
    } else {
        // Mostrar mensaje de error
        echo "Error al guardar la solicitud: " . $stmt->error;
    }

    // Cerrar la conexión
    $stmt->close();
    $conn->close();
}
?>
