<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mantenimiento</title>
    <link rel="stylesheet" href="style.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="icon" href="img/mantenimiento.png" type="image/x-icon"> <!--iCONO EN LA PESATAÑA DE CHROME-->
    <script>
document.addEventListener('DOMContentLoaded', function() {
    const form = document.querySelector('form');
    
    form.addEventListener('submit', function(event) {
        event.preventDefault(); // Evita el envío del formulario tradicional
        
        const formData = new FormData(form);
        
        fetch('guardar_solicitud.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            const folio = data.folio;
            
            // Mostrar notificación en el navegador
            if (Notification.permission === 'granted') {
                new Notification('Solicitud Enviada', {
                    body: `Tu folio es ${folio}`,
                    icon: 'img/mantenimiento.png' // Puedes cambiar el icono si lo deseas
                });
            } else if (Notification.permission !== 'denied') {
                Notification.requestPermission().then(permission => {
                    if (permission === 'granted') {
                        new Notification('Solicitud Enviada', {
                            body: `Tu folio es ${folio}`,
                            icon: 'img/mantenimiento.png'
                        });
                    }
                });
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
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

  <div class="capa"></div>
    <div class="container">
      <span class="big-circle"></span>
      <img src="img/shape.png" class="square" alt="" />
      <div class="form">
        <div class="contact-info">
          <h3 class="title">Mantenimiento</h3>
          <p class="text">
           Realiza el siguiente fomulario si requieres de;
           Asistencia via remota <br>

           <img class="logo" src="img/Logotipo-Control-Seguridad.png" alt="">
<br>
<br>
<br>
<br>
<br>
           <b>"Quick Support"</b>
          </p>

          <div class="info">
            <div class="information">
              <img src="img/despertador.png" class="icon" alt="" />
              <p>Hrs de Atencion; 16:00 - 18:00 hrs </p>
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
        <h3 class="title">Solicitud de Mantenimiento</h3>
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
            <input type="text" name="coditr" class="input" required />
            <label for="coditr">Código de Centro de Trabajo (Freematica)</label>
            <span>Código de Centro de Trabajo (Freematica)</span>
        </div>
    
        <div class="input-container">
            <select name="linea_telefonica" class="form-select" aria-label="Default select example" required>
                <option value="" disabled selected>Línea Telefónica</option>
                <option value="Nueva Asignación de línea">Nueva Asignación de línea</option>
                <option value="Con la misma línea">Con la misma línea</option>
                <option value="Recuperación de Línea">Recuperación de Línea</option>
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
