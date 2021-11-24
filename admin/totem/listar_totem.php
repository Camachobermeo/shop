<!DOCTYPE html>
<html>
<?php
$guardado = false;
if ($_REQUEST)
  $guardado = $_REQUEST['guardado'];
?>

<body>

<?php include_once "../../admin/encabezado.php" ?>
<br>
<div class="container">
<?php
  if ($guardado) {
    echo "<div class='alert alert-success' role='alert' id='alerta'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Exito!</strong>    La operación solicitada se ha realizado correctamente.
     </div>";
  }
  ?>
  <br>
<?php?>
<?php
include_once "../../utiles/base_de_datos.php";
$sentencia = $base_de_datos->query("select * from totem");
$totems = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
		</div>
		<br>
		<div class="col-md-3 text-right">
			<a class="btn btn-primary" href="<?php echo "totem.php" ?>">Nuevo</a>
		</div>
		<br>
		<br>
		<body>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>Código</th>
							<th>Dirección</th>
							<th>Descripción</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<br>
						<?php foreach ($totems as $totem) { ?>
							<tr>
								<td><?php echo $totem->id_totem ?></td>
								<td><?php echo $totem->codigo ?></td>
								<td><?php echo $totem->direccion ?></td>
								<td><?php echo $totem->descripcion ?></td>
								<td><a class="btn btn-success" href="<?php echo "editar_totem.php?id=" . $totem->id_totem ?>">Editar</a></td>
								<td>
									<button type="button" class="btn btn-danger" href="<?php echo "eliminar_totem.php?id=" . $totem->id_totem ?>" data-toggle="modal" data-target="#staticBackdrop<?php echo $totem->id_totem ?>">
										Eliminar
									</button>

									<div class="modal fade" id="staticBackdrop<?php echo $totem->id_totem ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="staticBackdropLabel">Eliminar</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													¿Estas seguro de eliminar a <?php echo "" . $totem->codigo ?> ?
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
													<a class="btn btn-primary" href="<?php echo "eliminar_totem.php?id=" . $totem->id_totem ?>">Aceptar</a>
												</div>
											</div>
										</div>
									</div>
								</td>
							</tr>
						<?php } ?>
					</tbody>
				</table>
			</div>
		</body>
	</div>
</div>
</div>
<br><br><br>
<?php include_once "../../pie.php" ?>

</html>
