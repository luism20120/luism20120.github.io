<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtcargo"]) and !empty($_POST["txtcedula"])) {
        $nombre=$_POST["txtnombre"];
        $apellido=$_POST["txtapellido"];
        $cargo=$_POST["txtcargo"];
        $dni=$_POST["txtcedula"];
        $sql = $conexion->query("INSERT INTO empleado (nombre, apellido, cargo, dni) VALUES ('$nombre', '$apellido', '$cargo', '$dni')");

        if ($sql==true) { ?>
            <script>
        $(function() {  
            new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "Empleado registrado correctamente",
                styling: "bootstrap3"
            });
        });
        </script>
        <?php } else { 
            ?>
            <script>
        $(function() {  
            new PNotify({
                title: "INCORRECTO",
                type: "error",
                text: "Error al registrar empleado",
                styling: "bootstrap3"
            });
        });
        </script>
        <?php 
        }
        
    } else { 
        ?>
         <script>
        $(function() {  
            new PNotify({
                title: "ERROR",
                type: "error",
                text: "LOS CAMPOS ESTAN VACIOS",
                styling: "bootstrap3"
            });
        });
        </script>
   <?php 
   }  ?>
   
   <script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>

<?php }
?>