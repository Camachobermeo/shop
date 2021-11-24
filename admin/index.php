<!DOCTYPE html>
<html>

<head>
  <title>Iniciar Sesion</title>
  <link rel="stylesheet" href="../utiles/bootstrap.min.css">
  <script src="../utiles/jquery.js" type="text/javascript"></script>
  <script src="../utiles/bootstrap.min.js" type="text/javascript"></script>
</head>

<?php
$error = null;
if ($_REQUEST)
  $error = $_REQUEST['error'];
?>

<body style="margin: 8px;">

  <?php
  if ($error) {
    echo "<div class='alert alert-warning' role='alert' id='alerta'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Error!</strong> Usuario o clave incorrectas!
     </div>";
  }
  ?>
  <div class="text-center">
    <h1>Iniciar Sesion</h1>
  </div>
  <br>
  <div class="text-center">
    <img src="../utiles/login.jpg" class="rounded" width="150" height="150">
  </div>
  <br>
  <div id="login">
    <form action="verificacion.php" method="GET">
      <div class="form-row">
        <div class="col-3">
        </div>
        <div class="col-6">
          <label>Usuario</label>
          <input type="text" class="form-control" name="usuario" placeholder="usuario" required>
        </div>
        <div class="col-3">
        </div>
      </div>
      <br>
      <div class="form-row">
        <div class="col-3">
        </div>
        <div class="col-6">
          <label>Contraseña</label>
          <input type="password" class="tex form-control" name="clave" placeholder="clave" required>
        </div>
        <div class="col-3">
        </div>
      </div>
      <br>
      <div class="text-center">
        <input type="submit" class="btn btn-success" value="Ingresar" />
      </div>
    </form>
  </div>
</body>
<br><br><br><br>
<?php include_once "../pie.php" ?>

</html>

<script>
  setTimeout(function() {
    document.getElementById('alerta') ? document.getElementById('alerta').hidden = true : null;
  }, 3000);
</script>