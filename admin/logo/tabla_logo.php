<html>
<?php
$guardado = false;
if ($_REQUEST)
	$guardado = $_REQUEST['guardado'];
?>

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
	$sentencia = $base_de_datos->query("select * from logo");
	$logo = $sentencia->fetchAll(PDO::FETCH_OBJ);
	?>
	<div class="container">
		<div class="row">
			<div class="col-md-9">
				<h1>Lista De Logo</h1>
			</div>
			<br>
			<div class="col-md-3 text-right">
				<a class="btn btn-primary" href="<?php echo "logo.php" ?>">Nuevo</a>
			</div>
			<br>
			<br>

			<body>
				<div class="table-responsive">
					<table class="table table-bordered">
						<thead class="thead-dark">
							<tr>
								<th>ID</th>
								<th>URL</th>
								<th>Eliminar</th>
							</tr>
						</thead>
						<tbody>
							<br>
							<?php foreach ($logo as $aforo) { ?>
								<tr>
									<td><?php echo $aforo->id_logo ?></td>
									<td><?php echo $aforo->url_logo ?></td>
									<td>
										<button type="button" class="btn btn-danger" href="<?php echo "eliminarlogo.php?id=" . $aforo->id_logo ?>" data-toggle="modal" data-target="#staticBackdrop<?php echo $aforo->id_logo ?>">
											Eliminar
										</button>

										<div class="modal fade" id="staticBackdrop<?php echo $aforo->id_logo ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
											<div class="modal-dialog">
												<div class="modal-content">
													<div class="modal-header">
														<h5 class="modal-title" id="staticBackdropLabel">Eliminar</h5>
														<button type="button" class="close" data-dismiss="modal" aria-label="Close">
															<span aria-hidden="true">&times;</span>
														</button>
													</div>
													<div class="modal-body">
														¿Estas seguro de eliminar a <?php echo "" . $aforo->url_logo ?> ?
													</div>
													<div class="modal-footer">
														<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
														<a class="btn btn-primary" href="<?php echo "eliminarlogo.php?id=" . $aforo->id_logo . "&&nombre=" . $aforo->url_logo ?>">Aceptar</a>
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