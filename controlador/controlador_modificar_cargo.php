<?php
if (!empty($_POST["btnmodificar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre = $_POST["txtnombre"];
        $id = $_POST["txtid"];
        $verificarNombre = $conexion->query("SELECT COUNT(*) as total FROM cargo WHERE nombre='$nombre'");
        if ($verificarNombre->fetch_object()->total > 0) { ?>
            <script>
                $(function() {  
                    new PNotify({
                        title: "INCORRECTO",
                        type: "error",
                        text: "El nombre <?= $nombre ?> ya existe",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php } else {
            $sql = $conexion->query("UPDATE cargo SET nombre='$nombre' WHERE id_cargo=$id");
            if ($sql==true) { ?>
                <script>
            $(function() {  
                new PNotify({
                    title: "CORRECTO",
                    type: "Success",
                    text: "Cargo modificado correctamente",
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
                    text: "Error al modificar los datos",
                    styling: "bootstrap3"
                });
            });
        </script>
            <?php }
            
        }
    } else { ?>
        <script>
            $(function() {  
                new PNotify({
                    title: "INCORRECTO",
                    type: "error",
                    text: "Los campos están vacíos",
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
