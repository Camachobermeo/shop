<!DOCTYPE html>
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
                <strong>Error!</strong>    $fallo
            </div>";
                }
        ?>
        <div class="text-center">
            <h1>Registrar Persona</h1>
        </div>
        <br>
        <form enctype="multipart/form-data" action="insertarpersona.php" method="POST">
            <div class="form-row">
                <div class="col-3"></div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="nombre">Nombre</label>
                        <input required name="nombre" class="form-control text-uppercase" id="nombre" placeholder="Nombre de la persona">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="apellidos">Apellidos</label>
                        <input required name="apellidos" class="form-control text-uppercase" id="apellidos" placeholder="Apellidos de la persona">
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="form-row">
                <div class="col-3"></div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="rut">RUT</label>
                        <input required name="rut" class="form-control text-uppercase" id="rut" placeholder="RUT de la persona">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group">
                        <label for="rfid">RFID</label>
                        <input required name="rfid" class="form-control text-uppercase" id="rfid" placeholder="RFID de la persona">
                    </div>
                </div>
                <div class="col-3"></div>
            </div>
            <div class="container">
                <div class="text-center">
                    
                        <table class="table table-active">
                            <tr>
                            <h3><label for="url_foto">Subir Foto</label></h3>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>

                                <td>
                                    <h4><input name="archivo" id="persona" type="file" accept="image/png, image/jpeg" />
                                    </h4>
                                </td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                            </tr>
                        </table>
                    <h4> <input name="subir" type="submit" onclick="activarCargando()"  class="btn btn-success" value="Guardar" /></h4>

                </div>
            </div>
            <br>
            <br>
            <div class="text-center">
      <div id="cargando" hidden class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
        </form>
        <script>
    function activarCargando() {
      document.getElementById("cargando").hidden = false;
    }
  </script>
    </div>
    <br><br><br>
    <?php include_once "../../pie.php" ?>

</html>