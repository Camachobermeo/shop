<!DOCTYPE html>
<html>

<?php include_once "../../admin/encabezado.php" ?>
<?php
include_once "../../utiles/SimpleXLS.php";
include_once "../../utiles/base_de_datos.php";

$target_dir = '/home/pi/subidos/';
$xls = null;

$mensaje1 = "";
$mensaje2 = "";
if ($_REQUEST && $_REQUEST['mensaje1']) {
  $mensaje1 = $_REQUEST['mensaje1'];
}
if ($_REQUEST && $_REQUEST['mensaje2']) {
  $mensaje2 = $_REQUEST['mensaje2'];
}

if ($_FILES) {
  $target_file = $target_dir . basename($_FILES["file"]["name"]);
  $imageFileType = pathinfo($target_file, PATHINFO_EXTENSION);
  move_uploaded_file($_FILES["file"]["tmp_name"], $target_file);
  $xls = SimpleXLS::parse($target_file);
}
?>

<body>
  <br>
  <h1 class="text-center">Cargar desde excel</h1>
  <br>
  <div class="container">

    <?php
    if ($mensaje1) {
      echo "<div class='alert alert-success' role='alert' id='alerta'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        $mensaje1
     </div>";
    }
    if ($mensaje2) {
      echo "<div class='alert alert-warning' role='alert' id='alerta2'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        $mensaje2
     </div>";
    }
    ?>
    <br>

    <form action="" method="post" name="frmExcelImport" id="frmExcelImport" enctype="multipart/form-data">
      <div class="text-center">
        <input type="file" class="btn btn-success" onchange="form.submit()" name="file" id="file" accept=".xls">
      </div>
    </form>

    <div class="text-center pt-3">
      <form action="crear-por-lote.php" method="post" name="frmExcel" id="frmExcel">
        <div>
          <input hidden type="text" name="result" id="result" value="<?php echo base64_encode(serialize($xls->rows())); ?>">
          <button class="btn btn-primary" type="submit" id="import" name="import">Importar Registros</button>
        </div>
      </form>
    </div>

    <div class="table-responsive">
      <table class="table table-bordered">
        <thead class="thead-dark">
          <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>RUT</th>
            <th>RFID</th>
            <th>NFC</th>
          </tr>
        </thead>
        <tbody>
          <br>
          <?php if ($xls) { ?>
            <?php foreach ($xls->rows() as $totem) { ?>
              <tr>
                <?php if ($totem[0] != "Nombre" && $totem[2]) { ?>
                  <td><?php echo $totem[0] ?></td>
                  <td><?php echo $totem[1] ?></td>
                  <td><?php echo $totem[2] ?></td>
                  <td><?php echo $totem[3] ?></td>
                  <td><?php echo $totem[4] ?></td>
                <?php } ?>
              </tr>
            <?php } ?>
          <?php } ?>
        </tbody>
      </table>
    </div>
  </div>
</body>

<?php include_once "../../pie.php" ?>

</html>