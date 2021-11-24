<!doctype html>
<html lang="es">

<?php include_once "../../admin/encabezado.php" ?>
<br>
<br>
<br>
<?php

$exito = false;
if ($_REQUEST) {
  $exito = $_REQUEST['exito'];
}
?>

<body>
  <br><br>
  <div class="container">
    <br>
    <?php
    if ($exito) {
      echo "<div class='alert alert-success' role='alert' id='alerta'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Exito!</strong>    La operación solicitada se ha realizado correctamente.
     </div>";
    }
    ?>
    <h1 class="text-center">Reiniciar</h1>
    <br>
    <div class="text-center">
      <div id="cargando" hidden class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>

    <br>
    <form action="reiniciar_funcion.php" method="POST" class="text-center">
      <button type="submit" onclick="activarCargando()" class="btn btn-success">Reiniciar</button>
    </form>
  </div>
  <script>
    function activarCargando() {
      document.getElementById("cargando").hidden = false;
    }
  </script>
</body>

<br><br><br>
<?php include_once "../../pie.php" ?>

</html>