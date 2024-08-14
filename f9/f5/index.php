<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Asignación</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="img/movil.png" type="image/x-icon"> <!--iCONO EN LA PESATAÑA DE CHROME-->
    <script
      src="https://kit.fontawesome.com/64d58efce2.js"
      crossorigin="anonymous"
    ></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Solicitar permiso para notificaciones
            if (Notification.permission !== 'granted') {
                Notification.requestPermission();
            }
        });

        function sendNotification() {
            if (Notification.permission === 'granted') {
                new Notification('¡Formulario Enviado!', {
                    body: 'Tu solicitud de Asignación ha sido enviada correctamente.',
                    icon: 'img/notification-icon.png' // Puedes usar un icono opcional para la notificación
                });
            }
        }

        document.addEventListener('DOMContentLoaded', function() {
            const form = document.querySelector('form');
            form.addEventListener('submit', function(event) {
                event.preventDefault(); // Evitar el envío del formulario para fines de demostración

                // Aquí normalmente enviarías el formulario con AJAX o lo enviarías de manera tradicional
                sendNotification();

                // Para fines de demostración, se puede enviar el formulario de manera tradicional después de la notificación
                setTimeout(() => {
                    form.submit();
                }, 1000);
            });
        });
    </script>

</head>
<body>
     <!--barra de navegacion-->
  	<header class="header">
      <div class="container1">
      <div class="btn-menu">
        <label for="btn-menu">☰</label>
      </div>
        
        <nav class="menu">
          <a href="#">Volver al menú</a>
        </nav>
      </div>
    </header>
    <div class="capa"></div>
  <!--menu desplegable -->
  <input type="checkbox" id="btn-menu">
  <div class="container1-menu">
    <div class="cont-menu">
      <nav>
        <a href="../f4/index.php">Mantenimiento</a>
        <a href="../f5/index.php">Asignacion</a>
        <a href="../f6/index.php">Reemplazo</a>
        <a href="../f-1/index.php">Busqueda</a>
        <a href="../index.html">Cerrar Sesion</a>
  
      </nav>
      <label for="btn-menu">✖️</label>
    </div>
  </div>
  <!--inicion del formulario-->

  <div class="container">
    <span class="big-circle"></span>
    <img src="img/shape.png" class="square" alt="" />
    <div class="form">
      <div class="contact-info">
        <h3 class="title">Asignacion</h3>
        <p class="text">
         Para nuevos montajes rellene el siguiente formulairo incluida la linea telefonica <br>
         <br>-
         <b>"Nuevos montajes"</b>
         <img class="logo" src="img/Logotipo-Control-Seguridad.png" alt="">
         <br>
  
         
        </p>
  <br>
  <br>
  <br>
        <div class="info">
          <div class="information">
            <img src="img/despertador.png" class="icon" alt="" />
            <p>Hrs de Atencion: 09:00 - 16:00 hrs </p>
          </div>
          <div class="information">
            <img src="img/red-mundial.png" class="icon" alt="" />
            <p>Sobre nosotros <a href="https://seguridadcontrol.com.mx/">Control Seguidad Privada Integral</a></p>
          </div>
          <div class="information">
            <img src="img/phone.png" class="icon" alt="" />
            <p>55 43-31-24-27</p>
          </div>
        </div>
  
        <div class="social-media">
          <p>Conocenos mas :</p>
          <div class="social-icons">
            <a href="https://www.facebook.com/segcontrol">
              <i class="fab fa-facebook-f"></i>
            </a>
            <a href="https://x.com/i/flow/login?redirect_after_login=%2Fsegcontrol">
              <i class="fab fa-twitter"></i>
            </a>
            <a href="https://www.instagram.com/segcontrol/">
              <i class="fab fa-instagram"></i>
            </a>
            <a href="https://www.linkedin.com/company/control-seguridad-privada-integral">
              <i class="fab fa-linkedin-in"></i>
            </a>
          </div>
        </div>
      </div>
  
      <div class="contact-form">
        <span class="circle one"></span>
        <span class="circle two"></span>

    <form method="POST" action="guardar_solicitud.php" enctype="multipart/form-data">
      <h3 class="title">Solicitud de Asignación Telefónica</h3>
      <br>
  
      <div class="input-container">
          <input type="email" name="email" class="input" required />
          <label for="email">Email</label>
          <span>Email</span>
      </div>
  
      <div class="input-container">
          <input type="text" name="servicio" class="input" required />
          <label for="servicio">Centro de Trabajo (Servicio)</label>
          <span>Servicio</span>
      </div>
  
      <div class="input-container">
          <input type="text" name="Coditr" class="input" required />
          <label for="Coditr">Código de Centro de Trabajo (Freematica)</label>
          <span>Código de Centro de Trabajo (Freematica)</span>
      </div>
  
      <div class="input-container">
          <select name="cantidad_equipos" class="form-select" aria-label="Default select example" required>
              <option value="" disabled selected>Cantidad Equipos</option>
              <option value="1">Uno</option>
              <option value="2">Dos</option>
              <option value="3">Tres</option>
              <option value="4">Cuatro</option>
              <option value="5">Más de 4</option>
          </select>
      </div>
  
      <div class="input-group">
          <p style="color: #000; text-align: center;">Adjuntar Acuerdo Comercial (firmado por el cliente)</p>
          <input type="file" name="acuerdo_comercial" class="form-control" aria-describedby="inputGroupFile04" aria-label="Upload" required>
      </div>
  
      <div class="input-container textarea">
          <textarea name="message" class="input" required></textarea>
          <label for="message">Describa el puesto que va a desempeñar</label>
          <span>Message</span>
      </div>
      <br>
      <input type="submit" value="Enviar" class="btn" />
  </form>
    <script src="app.js"></script>
   
</body>
</html>
