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
$sentencia = $base_de_datos->query("select * from persona");
$personas = $sentencia->fetchAll(PDO::FETCH_OBJ);
?>
<div class="container">
	<div class="row">
		<div class="col-md-9">
			<h1>Lista De Personas</h1>
		</div>
		<br>
		<div class="col-md-3 text-right">
			<a class="btn btn-primary" href="<?php echo "persona.php" ?>">Nuevo</a>
		</div>
		<br>
		<br>
		<body>
			<div class="table-responsive">
				<table class="table table-bordered">
					<thead class="thead-dark">
						<tr>
							<th>ID</th>
							<th>Nombre</th>
							<th>Apellidos</th>
							<th>RUT</th>
							<th>RFID</th>
							<th>Url Foto</th>
							<th>Editar</th>
							<th>Eliminar</th>
						</tr>
					</thead>
					<tbody>
						<br>
						<?php foreach ($personas as $persona) { ?>
							<tr>
								<td><?php echo $persona->id_persona ?></td>
								<td><?php echo $persona->nombre ?></td>
								<td><?php echo $persona->apellidos ?></td>
								<td><?php echo $persona->rut ?></td>
								<td><?php echo $persona->rfid ?></td>
								<td><?php echo $persona->url_foto ?></td>
								<td><a class="btn btn-success" href="<?php echo "editarpersona.php?id=" . $persona->id_persona ?>">Editar</a></td>
								<td>
									<button type="button" class="btn btn-danger" href="<?php echo "eliminarpersona.php?id=" . $persona->id_persona ?>" data-toggle="modal" data-target="#staticBackdrop<?php echo $persona->id_persona ?>">
										Eliminar
									</button>

									<div class="modal fade" id="staticBackdrop<?php echo $persona->id_persona ?>" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
										<div class="modal-dialog">
											<div class="modal-content">
												<div class="modal-header">
													<h5 class="modal-title" id="staticBackdropLabel">Eliminar</h5>
													<button type="button" class="close" data-dismiss="modal" aria-label="Close">
														<span aria-hidden="true">&times;</span>
													</button>
												</div>
												<div class="modal-body">
													¿Estas seguro de eliminar a <?php echo "" . $persona->nombre ?> ?
												</div>
												<div class="modal-footer">
													<button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
													<a class="btn btn-primary" href="<?php echo "eliminarpersona.php?id=" . $persona->id_persona .  "&&nombre=" . $persona->url_foto ?>">Aceptar</a>
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
