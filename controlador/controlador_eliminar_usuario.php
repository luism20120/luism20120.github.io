<?php
if (!empty($_GET["id"])) {
    $id=$_GET["id"];
    $sql=$conexion->query("delete from usuario where id_usuario=$id");
    if ($sql == true) { ?>
        <script>
        $(function() {  
            new PNotify({
                title: "CORRECTO",
                type: "SUCCESS",
                text: "usuario eliminado correctamente",
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
                text: "error al eliminar el usuario",
                styling: "bootstrap3"
            });
        });
        </script>
    <?php }  ?>

    <script>
    setTimeout(() => {
        window.history.replaceState(null, null, window.location.pathname);
    }, 0);
</script>

<?php }
?>