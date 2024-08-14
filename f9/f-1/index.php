<?php
include 'conexion.php';  // Incluye la conexión a la base de datos

$folio = '';
$result = '';
$table = 'mantenimiento';  // Tabla por defecto

// Lista de tablas permitidas para prevenir inyecciones SQL
$allowed_tables = ['mantenimiento', 'asignacion', 'reemplazo'];

if (isset($_POST['buscar'])) {
    $folio = $_POST['folio'];
    $table = $_POST['table'];  // Obtener la tabla seleccionada

    // Validar la tabla para prevenir inyecciones SQL
    if (in_array($table, $allowed_tables)) {
        // Usar consultas preparadas para mayor seguridad
        $stmt = $conn->prepare("SELECT * FROM $table WHERE folio = ?");
        if ($stmt) {
            $stmt->bind_param("s", $folio);  // Vincular el parámetro
            $stmt->execute();  // Ejecutar la consulta
            $query = $stmt->get_result();  // Obtener los resultados

            if ($query->num_rows > 0) {
                // Mostrar los resultados
                $result = $query->fetch_assoc();
            } else {
                $result = "No se encontraron resultados para el folio: $folio.";
            }
            $stmt->close();
        } else {
            $result = "Error en la preparación de la consulta.";
        }
    } else {
        $result = "La tabla seleccionada no es válida.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Buscar Solicitud por Folio</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            background-color: #f9f9f9;
        }
        h1 {
            text-align: center;
        }
        .result {
            margin-top: 20px;
        }
        .button-container {
            text-align: center;
            margin-top: 20px;
        }
        .button-container button {
            padding: 10px 20px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            text-decoration: none;
            font-size: 16px;
        }
        .button-container button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Buscar Solicitud</h1>
        <form method="post" action="">
            <label for="folio">Ingrese el Folio:</label>
            <input type="text" name="folio" id="folio" required value="<?php echo htmlspecialchars($folio); ?>">

            <label for="table">Seleccione la Tabla:</label>
            <select name="table" id="table" required>
                <option value="mantenimiento" <?php if ($table === 'mantenimiento') echo 'selected'; ?>>Mantenimiento</option>
                <option value="asignacion" <?php if ($table === 'asignacion') echo 'selected'; ?>>Asignación</option>
                <option value="reemplazo" <?php if ($table === 'reemplazo') echo 'selected'; ?>>Reemplazo</option>
            </select>

            <button type="submit" name="buscar">Buscar</button>
        </form>

        <div class="result">
            <?php if ($result): ?>
                <?php if (is_array($result)): ?>
                    <h2>Resultados:</h2>
                    <p><strong>Folio:</strong> <?php echo htmlspecialchars($result['folio']); ?></p>
                    <p><strong>Email:</strong> <?php echo htmlspecialchars($result['email']); ?></p>
                    <p><strong>Servicio:</strong> <?php echo htmlspecialchars($result['servicio']); ?></p>
                    <p><strong>Coditr:</strong> <?php echo htmlspecialchars($result['coditr']); ?></p>
                    
                    <?php if (isset($result['cantidad_equipos'])): ?>
                        <p><strong>Cantidad Equipos:</strong> <?php echo htmlspecialchars($result['cantidad_equipos']); ?></p>
                    <?php endif; ?>

                    <?php if ($table === 'reemplazo'): ?>
                        <p><strong>Línea Telefónica:</strong> <?php echo htmlspecialchars($result['linea_telefonica']); ?></p>
                    <?php endif; ?>

                    <p><strong>Mensaje:</strong> <?php echo htmlspecialchars($result['message']); ?></p>
                    
                    <?php if (!empty($result['acuerdo_comercial'])): ?>
                        <p><strong>Acuerdo Comercial:</strong></p>
                        <a href="data:application/octet-stream;base64,<?php echo base64_encode($result['acuerdo_comercial']); ?>" download="acuerdo_comercial">Descargar Acuerdo Comercial</a>
                    <?php endif; ?>
                <?php else: ?>
                    <p><?php echo htmlspecialchars($result); ?></p>
                <?php endif; ?>
            <?php endif; ?>
        </div>

        <div class="button-container">
        <a href="../f4/index.php">
                <button type="button">Regresar</button>
            </a>
        </div>
    </div>
</body>
</html>

<?php
$conn->close();  // Cerrar la conexión a la base de datos
?>
