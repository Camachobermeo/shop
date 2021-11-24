<!DOCTYPE html>
<html>

<?php include_once "../../admin/encabezado.php" ?>
<br>
<?php
$inicio = "";
$fin = "";
?>


<body>
  <br><br>
  <div class="container">
    <br>
    <h1 class="text-center">Exportar registros</h1>
    <br>
    <form action="excel.php" method="POST">
      <div class="form-group">
        <label for="inicio">Inicio</label>
        <input value="<?php echo $inicio; ?>" required name="inicio" type="date" id="inicio" placeholder="Desde" class="form-control">
      </div>
      <div class="form-group">
        <label for="fin">Fin</label>
        <input value="<?php echo $fin; ?>" required name="fin" type="date" id="fin" placeholder="Hasta" class="form-control">
      </div>
      <button type="submit" class="btn btn-success">Exportar</button>
    </form>
  </div>
  
</body>
<br><br><br>
<?php include_once "../../pie.php" ?>

</html>