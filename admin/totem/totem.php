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
                <strong>Error!</strong>    Codigo del Totem ingresado, ya exite.
            </div>";
                }
        ?>
        <div class="text-center">
            <h1>Registrar Totem</h1>
        </div>
        <br>
        <form action="insertar_totem.php" method="POST">
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="codigo">Código</label>
                        <input required name="codigo" class="form-control text-uppercase" id="codigo" placeholder="Codigo del Totem">
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="direccion">Dirección</label>
                        <input required name="direccion" class="form-control text-uppercase" id="direccion" placeholder="Direccion del Totem">
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="form-row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="form-group">
                        <label for="descripcion">Descripción</label>
                        
                        <textarea required name="descripcion" class="form-control  text-uppercase" id="descripcion" rows="3" placeholder="Descripcion del Totem"></textarea>
                    </div>
                </div>
                <div class="col-2"></div>
            </div>
            <div class="text-center">
                <button type="submit" onclick="activarCargando()" class="btn btn-success">Guardar</button>
            </div>
<br>
<div class="text-center">
      <div id="cargando" hidden class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
        </form>
    </div>
    <script>
    function activarCargando() {
      document.getElementById("cargando").hidden = false;
    }
  </script>
    <br><br><br>
    <?php include_once "../../pie.php" ?>

</html>