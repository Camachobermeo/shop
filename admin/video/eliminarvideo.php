<?php

if (
    !isset($_GET["id"]) ||
    !isset($_GET["nombre"])
) {
    exit();
}
$nombre = $_GET["nombre"];
$id = $_GET["id"];
include_once "../../utiles/base_de_datos.php";
$sentencia = $base_de_datos->prepare("DELETE FROM video WHERE id_video = ?;");
$resultado = $sentencia->execute([$id]);
if ($resultado === true) {
    unlink("../../utiles/videos/" . $nombre);
    header("Location: tablavideo.php?guardado=1");
} else {
    echo "Algo salió mal";
}
