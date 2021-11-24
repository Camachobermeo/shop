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
        <strong>Error!</strong>    Codigo de Totem, ya exite.
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
	$sentencia = $base_de_datos->prepare("select * from totem where id_totem = ?;");
	$sentencia->execute([$id]);
	$totem = $sentencia->fetchObject();
	if (!$totem) {
		echo "¡No existe alguna totem con ese ID!";
		exit();
	}
	?>

	<div class="container">
		<div class="text-center">
			<h1>Editar totem</h1>
		</div>
		<br>
		<br>
		<br>
		<form action="guardar_datos_editados.php" method="POST">
			<input type="hidden" name="id" value="<?php echo $totem->id_totem; ?>">
			<div class="form-row">
				<div class="col-2"></div>
				<div class="col-8">
					<div class="form-group">
						<label for="codigo">Código</label>
						<input value="<?php echo $totem->codigo; ?>" required name="codigo" class="form-control text-uppercase" id="codigo" placeholder="Codigo del Totem">
					</div>
				</div>
				<div class="col-2">
				</div>
			</div>
			<div class="form-row">
				<div class="col-2"></div>
				<div class="col-8">
					<div class="form-group">
						<label for="direccion">Dirección</label>
						<input value="<?php echo $totem->direccion; ?>" required name="direccion" class="form-control text-uppercase" id="direccion" placeholder="Direccion de totem">
					</div>
				</div>
				<div class="col-2">
				</div>
			</div>
			<div class="form-row">
				<div class="col-2"></div>
				<div class="col-8">
					<div class="form-group">
						<label for="descripcion">Descripción</label>
                        <textarea value="<?php echo $totem->descripcion; ?>" required name="descripcion" class="form-control  text-uppercase" id="descripcion" rows="3" placeholder="Descripcion del Totem"></textarea>
					</div>
				</div>
				<div class="col-2"></div>
			</div>
			<div class="text-center">
				<button type="submit" class="btn btn-success">Guardar</button>
				<a href="./listar_totem.php" class="btn btn-warning">Volver</a>
			</div>
		</form>
	</div>
	</div>
</body>
<br><br><br>
<?php include_once "../../pie.php" ?>

</html>