<html>
<?php
$fallo = false;
if ($_REQUEST)
    $fallo = $_REQUEST['fallo'];
?>

<body>
    <?php include_once "../../admin/encabezado.php" ?>
    <br>
    <br>
    <br>
    <div class="container">
        <?php
        if ($fallo) {
            echo "<div class='alert alert-danger' role='alert' id='alerta'>
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
                <strong>Error!</strong>    url del logo ingresado, ya exite.
            </div>";
        }
        ?>
        <?php include_once "../../admin/encabezado.php" ?>
        <br>

        <body>
            <div class="container">
                <div class="text-center">
                    <h1>Subir Logos</h1>
                    <br>
                    <br>
                    <div id="cargando" hidden class="spinner-border text-success" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                    <br>
                    <br>
                    <br>
                    <br>
                    <form enctype="multipart/form-data" action="listar_logos.php" method="POST">
                        <table class="table table-active">
                            <tr>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td>
                                    <h3><input name="archivo" id="logo" type="file" accept="image/png, image/jpeg" />
                                        <input name="subir" type="submit" onclick="activarCargando()" value="Subir archivo" /></h3>
                                </td>
                                <td></td>
                            </tr>
                        </table>
                    </form>

                </div>
            </div>
            <script>
                function activarCargando() {
                    document.getElementById("cargando").hidden = false;
                }
            </script>
        </body>
    </div>

</html>
<?php include_once "../../pie.php" ?>