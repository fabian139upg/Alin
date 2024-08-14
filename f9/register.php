<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userName = $_POST['userName'];
    $userEmail = $_POST['userEmail'];
    $userPassword = password_hash($_POST['userPassword'], PASSWORD_BCRYPT);
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
        if (!empty($userName) && !empty($userEmail) && !empty($userPassword)) {
            $stmt = $conn->prepare("INSERT INTO usuarios (userName, userEmail, userPassword) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $userName, $userEmail, $userPassword);
            
            if ($stmt->execute()) {
                // Redirige a otra página después del registro exitoso
                header("Location: f4/index.php");
                exit(); // Asegura que el script se detenga aquí
            } else {
                echo "Error: " . $stmt->error;
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
