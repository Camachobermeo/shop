<!DOCTYPE html>
<html>
<?php
$daniado = false;
if (isset($_GET["daniado"]))
  $daniado = $_GET['daniado'];
?>

<body>

<body>
	<?php include_once "../../admin/encabezado.php" ?>
	<br>
	<div class="container">
	<?php
  if ($daniado) {
    echo "<div class='alert alert-danger' role='alert' id='alerta'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Error!</strong>    RUT o RFID ingresado, ya exite.
     </div>";
  }
  ?>
	<br>
	<?php
	if (!isset($_GET["id"])) {
		exit();
	}

	$id = $_GET["id"];
	include_once "../../utiles/base_de_datos.php";
	$sentencia = $base_de_datos->prepare("select * from persona where id_persona = ?;");
	$sentencia->execute([$id]);
	$persona = $sentencia->fetchObject();
	if (!$persona) {
		echo "¡No existe alguna persona con ese ID!";
		exit();
	}
	?>

	<div class="container">
		<div class="text-center">
			<h1>Editar Persona</h1>
		</div>
		<br>
		<br>
		<br>
		<form enctype="multipart/form-data" action="guardardatoseditados.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $persona->id_persona; ?>">
			<div class="form-row">
				<div class="col-3"></div>
				<div class="col-3">
					<div class="form-group">
						<label for="nombre">Nombre</label>
						<input value="<?php echo $persona->nombre; ?>" required name="nombre" class="form-control text-uppercase" id="nombre" placeholder="Nombre de persona">
					</div>
				</div>
				<div class="col-3">
					<div class="form-group">
						<label for="apellidos">Apellidos</label>
						<input value="<?php echo $persona->apellidos; ?>" required name="apellidos" class="form-control text-uppercase" id="apellidos" placeholder="Apellidos de la persona">
					</div>
				</div>
				<div class="col-3">
				</div>
			</div>
			<div class="form-row">
				<div class="col-3"></div>
				<div class="col-3">
					<div class="form-group">
						<label for="rut">RUT</label>
						<input value="<?php echo $persona->rut; ?>" required name="rut" class="form-control text-uppercase" id="rut" placeholder="RUT de persona">
					</div>
				</div>
				<div class="col-3">
					<div class="form-group">
						<label for="rfid">RFID</label>
						<input value="<?php echo $persona->rfid; ?>" required name="rfid" class="form-control text-uppercase" id="rfid" placeholder="RFID de persona">
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
                    <h4> <input name="subir" type="submit" onclick="activarCargando()" class="btn btn-success" value="Guardar" /> <a href="listarpersona.php" class="btn btn-warning">Volver</a>

                </div>
			</div>
			<br>
			<div class="text-center">
      <div id="cargando" hidden class="spinner-border text-success" role="status">
        <span class="sr-only">Loading...</span>
      </div>
    </div>
		</form>
	</div>
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