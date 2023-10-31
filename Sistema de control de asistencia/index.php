<?php
error_reporting(0);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PAGINA DE BIENVENIDA</title>
    <link rel="stylesheet" href="public/estilos/estilos.css">
     <!-- pNotify -->
     <link href="public/pnotify/css/pnotify.css" rel="stylesheet" />
        <link href="public/pnotify/css/pnotify.buttons.css" rel="stylesheet" />
        <link href="public/pnotify/css/custom.min.css" rel="stylesheet" />
        <!-- pnotify -->
        <script src="public/pnotify/js/jquery.min.js">
        </script>
        <script src="public/pnotify/js/pnotify.js">
        </script>
        <script src="public/pnotify/js/pnotify.buttons.js">
        </script>

</head>
<body>

    <h1> BIENVENIDOS AL MPPPST, REGISTRA TU ASISTENCIA</h1>
    <h2 id="fecha"><?= date("d/m/Y, h:i:s") ?></h2>
    <?php
    include "modelo/conexion.php";
    include "controlador/controlador_registrar_asistencia.php";
    
    ?>
    <div class="container">
        <a class="acceso" href="vista/login/login.php">Ingresar al Sistema</a>
        <p class="cedula">Ingrese Su Cedula</p>
        <form action="" method="POST">
            <input type="number" placeholder="Cedula del Empleado" name="txtdni" id="txtdni">
            <div class="botones">

                <button class="salida" type="submit" name="btnsalida" value="ok">SALIDA</button>
                <button class="entrada" type="submit" name="btnentrada" value="ok">ENTRADA</button>

            </div>
        </form>
    </div>

    <script>
       

        setInterval(() => {
            let fecha=new Date();
        let fechaHora=fecha.toLocaleString();
        document.getElementById("fecha").textContent=fechaHora;
            
        }, 1000);
    </script>
<script>
    let dni = document.getElementById("txtdni");
    dni.addEventListener("input", function() {
        if (this.value.length > 8) {
            this.value = this.value.slice(0, 8);
        }
    });
</script>

</body>
</html>