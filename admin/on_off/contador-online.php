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
    <h1 class="text-center">Resetear</h1>
    <br>
    <div class="text-center">
      <div id="cargando" hidden class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
    <br>
    <form class="text-center">
      <button type="submit" onclick="activarCargando();resetCounters();" class="btn btn-success">Resetear</button>
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


<script src="../../params.dat"></script>
<script>
  var dict = parseParams();

  function parseParams() {
    var dictionary = {};
    if (data.indexOf('$') === 0) {
      data = data.substr(1);
    }
    var parts = data.split('$');
    for (var i = 0; i < parts.length; i++) {
      var p = parts[i];
      var keyValuePair = p.split('=');
      var key = keyValuePair[0];
      var value = keyValuePair[1];
      dictionary[key] = value;
    }
    return dictionary;
  }

  function resetCounters() {
    document.getElementById("cargando").hidden = false;
    var ip = dict["camera" + 2];
    var user = dict['user'];
    var pass = window.atob(dict['pass']);
    var xmlHttp = new XMLHttpRequest();
    xmlHttp.open("GET", "http://" + ip + "/stw-cgi/system.cgi?msubmenu=databasereset&action=control&IncludeDataType=PeopleCount", false, user, pass); // false for synchronous request
    xmlHttp.withCredentials = true;
    xmlHttp.send(null);
  }
</script>

</html>