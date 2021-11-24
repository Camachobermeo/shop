<?php

if (!isset($_GET["id"]) || !isset($_GET["nombre"])) {
    exit();
}

$nombre = $_GET["nombre"];
$id = $_GET["id"];
include_once "../../utiles/base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM persona WHERE id_persona = ?;");
$resultado = $sentencia->execute([$id]);
if ($resultado === true) {
    unlink("../../utiles/persona/".$nombre);
    header("Location: listarpersona.php?guardado=1");
} else {
    echo "Algo salió mal";
}
