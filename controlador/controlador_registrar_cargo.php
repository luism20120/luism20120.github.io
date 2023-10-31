<?php
if (!empty($_POST["btnregistrar"])) {
    if (!empty($_POST["txtnombre"])) {
        $nombre = $_POST["txtnombre"];
        $verificarNombre = $conexion->query("SELECT COUNT(*) AS total FROM cargo WHERE nombre='$nombre'");
        
        if ($verificarNombre->fetch_object()->total > 0) { ?>
            <script>
                $(function() {  
                    new PNotify({
                        title: "ERROR",
                        type: "error",
                        text: "El cargo '<?= $nombre ?>' ya existe",
                        styling: "bootstrap3"
                    });
                });
            </script>
        <?php } else {
            $sql = $conexion->query("INSERT INTO cargo (nombre) VALUES ('$nombre')");
            if ($sql == true) { ?>
                <script>
                    $(function() {  
                        new PNotify({
                            title: "CORRECTO",
                            type: "success",
                            text: "El cargo ha sido registrado correctamente",
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
                            text: "Error al registrar el cargo",
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
    <?php }
    ?>
    <script>
        setTimeout(() => {
            window.history.replaceState(null, null, window.location.pathname);
        }, 0);
    </script>
<?php }
?>