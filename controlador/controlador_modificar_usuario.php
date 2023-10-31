<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"]) and !empty($_POST["txtapellido"]) and !empty($_POST["txtusuario"]) and !empty($_POST["txtpassword"])) {
        $nombre=$_POST["txtnombre"];
        $apellido=$_POST["txtapellido"];
        $usuario=$_POST["txtusuario"];
        $password= md5($_POST["txtpassword"]);
        $id=$_POST["txtid"];
        $sql =$conexion->query("select count(*) as ' total' from usuario where usuario='$usuario' and id_usuario!=$id");
        if ($sql->fetch_object()->total >0) { ?>
            <script>
        $(function() {  
            new PNotify({
                title: "ERROR",
                type: "error",
                text: "El usuario <?= $usuario ?> ya existe",
                styling: "bootstrap3"
            });
        });
        </script>
       <?php } else {
            $modificar = $conexion->query(" update usuario set nombre='$nombre', apellido='$apellido', usuario='$usuario', password='$password' where id_usuario=$id ");
            if ($modificar == true) { ?>
                <script>
        $(function() {  
            new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "El usuario se ha modificado correctamente",
                styling: "bootstrap3"
            });
        });
        </script>
            <?php 
        } else { 
            ?>
                <script>
        $(function() {  
            new PNotify({
                title: "INCORRECTO",
                type: "error",
                text: "error al modificar el usuario",
                styling: "bootstrap3"
            });
        });
        </script>
           <?php }
            
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
} ?>
    
    <script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>

 <?php }
 ?>
