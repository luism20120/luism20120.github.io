
<?php
if (!empty($_GET["id"])) {
    $id = $_GET["id"];
    $sql = $conexion->query("DELETE FROM asistencia WHERE id_asistencia = $id");

    if ($sql == true) {
        ?>
        <script>
        $(function() {  
            new PNotify({
                title: "CORRECTO",
                type: "success",
                text: "ASISTENCIA ELIMINADA CORRECTAMENTE",
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
                text: "ERROR AL ELIMINAR",
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
