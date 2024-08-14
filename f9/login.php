<?php
session_start(); // Iniciar la sesión
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userEmail = $_POST['userEmail'];
    $userPassword = $_POST['userPassword'];
    $captcha = $_POST['g-recaptcha-response'];
    
    // reCAPTCHA secret key
    $secretKey = '6LebCvspAAAAAJG0ryuaOhAe2HZnKy7sGzg8qsNm';

    // Verify the CAPTCHA response
    $url = 'https://www.google.com/recaptcha/api/siteverify';
    $data = [
        'secret' => $secretKey,
        'response' => $captcha,
        'remoteip' => $_SERVER['REMOTE_ADDR']
    ];

    $options = [
        'http' => [
            'header' => "Content-Type: application/x-www-form-urlencoded\r\n",
            'method' => 'POST',
            'content' => http_build_query($data)
        ]
    ];

    $context = stream_context_create($options);
    $response = file_get_contents($url, false, $context);
    $result = json_decode($response, true);

    if ($result['success']) {
        if (!empty($userEmail) && !empty($userPassword)) {
            $stmt = $conn->prepare("SELECT id, userPassword FROM usuarios WHERE userEmail = ?");
            $stmt->bind_param("s", $userEmail);
            $stmt->execute();
            $stmt->store_result();

            if ($stmt->num_rows > 0) {
                $stmt->bind_result($id, $hashed_password);
                $stmt->fetch();

                if (password_verify($userPassword, $hashed_password)) {
                    // Inicio de sesión exitoso
                    $_SESSION['user_id'] = $id; // Guardar el ID del usuario en la sesión
                    header("Location: f4/index.php"); // Redirigir al dashboard
                    exit();
                } else {
                    echo "Contraseña incorrecta";
                }
            } else {
                echo "No existe una cuenta con este correo";
            }

            $stmt->close();
        } else {
            echo "Todos los campos son obligatorios";
        }
    } else {
        echo "La verificación del captcha falló. Por favor, intenta de nuevo.";
    }
}

$conn->close();
?>
