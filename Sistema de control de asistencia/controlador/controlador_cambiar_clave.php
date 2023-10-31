<?php
if (!empty($_POST["btnmodificar"])) {
  if (!empty($_POST["txtclaveactual"]) && !empty($_POST["txtclavenueva"]) && !empty($_POST["txtid"])) {
      $claveactual = md5($_POST["txtclaveactual"]);
      $clavenueva = $_POST["txtclavenueva"];
      $id = $_POST["txtid"];
      $verificarclaveactual = $conexion->query("select password from usuario where id_usuario=$id");
      if ($verificarclaveactual->fetch_object()->password == $claveactual) { 
          $sql = $conexion->query("update usuario set password='$clavenueva' where id_usuario=$id");
          if ($sql == true) { ?>
        <script>
    $(function notificacion() {  
        new PNotify({
            title: "CORRECTO",
            type: "Success",
            text: "La contraseña se ha modificado correctamente",
            styling: "bootstrap3"
        })
    })
    </script>
      <?php } else { ?>
        <script>
    $(function notificacion() {  
        new PNotify({
            title: "INCORRECTO",
            type: "Error",
            text: "Error al modificar la contraseña",
            styling: "bootstrap3"
        })
    })
    </script>
      <?php }
      

     } else { ?>
          <script>
    $(function notificacion() {  
        new PNotify({
            title: "INCORRECTO",
            type: "Error",
            text: "La contraseña actual es incorrecta",
            styling: "bootstrap3"
        })
    })
    </script>
    <?php }
  } else { ?>
    <script>
    $(function notificacion() {  
        new PNotify({
            title: "INCORRECTO",
            type: "Error",
            text: "Los campos estan vacios",
            styling: "bootstrap3"
        })
    })
    </script>
  <?php } ?>
  <script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>
  
<?php }


?>
        
