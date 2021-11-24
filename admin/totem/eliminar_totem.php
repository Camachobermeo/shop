<?php

if (!isset($_GET["id"])) {
    exit();
}

$id = $_GET["id"];
include_once "../../utiles/base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM totem WHERE id_totem = ?;");
$resultado = $sentencia->execute([$id]);
if ($resultado === true) {
    header("Location: listar_totem.php?guardado=1");
} else {
    echo "Algo salió mal";
}
