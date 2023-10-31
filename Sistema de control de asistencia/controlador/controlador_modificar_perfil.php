<?php
if (!empty($_POST["btnmodificar"])) {
   if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"]) ) {
    $nombre=$_POST["txtnombre"];
    $apellido=$_POST["txtapellido"];
    $usuario=$_POST["txtusuario"];
    $id=$_POST["txtid"];
    $sql=$conexion->query(" update usuario set nombre='$nombre', apellido='$apellido', usuario='$usuario' where id_usuario=$id ");
    if ($sql==true) { ?>
              <script>
        $(function() {  
            new PNotify({
                title: "CORRECTO",
                type: "Success",
                text: "Datos modificados correctamente",
                styling: "bootstrap3"
            });
        });
        </script>
    <?php } else { ?>
        <script>
        $(function() {  
            new PNotify({
                title: "INCORRECTO",
                type: "error",
                text: "error al modificar los datos",
                styling: "bootstrap3"
            });
        });
        </script>
   <?php }
    
   } else { ?>
      <script>
        $(function() {  
            new PNotify({
                title: "INCORRECTO",
                type: "error",
                text: "Los campos estan vacios",
                styling: "bootstrap3"
            });
        });
        </script>
   <?php } ?>
   <script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>
<?php }
?>