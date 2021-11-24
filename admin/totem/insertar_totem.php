
<?php

?>
<?php

if (!isset($_POST["codigo"]) || !isset($_POST["direccion"]) || !isset($_POST["descripcion"])) {
    exit();
}

include_once "../../utiles/base_de_datos.php";
$codigo = $_POST["codigo"];
$direccion = $_POST["direccion"];
$descripcion = $_POST["descripcion"];

try {
$sentencia = $base_de_datos->prepare("INSERT INTO totem(codigo, direccion, descripcion) VALUES (?, ?, ?);");
$resultado = $sentencia->execute([strtoupper($codigo), strtoupper($direccion), strtoupper($descripcion)]);

 if ($resultado === true) {
    header("Location: listar_totem.php?guardado=1");
 } else {
    header("Location: totem.php?fallo=1");
 }
} catch (\Throwable $th) {
    header("Location: totem.php?fallo=1");
}
 