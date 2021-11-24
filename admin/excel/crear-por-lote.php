<?php

include_once "../../utiles/base_de_datos.php";

$data = null;
$mensaje1 = "";
$mensaje2 = "";

$data = (unserialize(base64_decode($_POST['result'])));
// if ($_REQUEST) {
//   $data = $_REQUEST['data'];
// }

foreach ($data as $totem) {
  if ($totem[0] != "Nombre" && $totem[2]) {
    try {
      $sentencia = $base_de_datos->prepare("INSERT INTO persona(nombre, apellidos, rut, rfid, nfc) VALUES (?, ?, ?, ?, ?);");
      $resultado = $sentencia->execute([strtoupper($totem[0]), strtoupper($totem[1]), strtoupper($totem[2]), strtoupper($totem[3]), strtoupper($totem[4])]);
      if ($resultado === true) {
        $mensaje1 = $mensaje1 . "Registro exitoso: " . $totem[0] . "<br>";
      } else {
        $mensaje2 = $mensaje2 .  "Ocurrió un error al guardar: " . $totem[0] . "<br>";
      }
    } catch (\Throwable $th) {
      $mensaje2 = $mensaje2 .  "Ocurrió un error al guardar: " . $totem[0] . "<br>";
    }
  }
}

$mensaje1 = urlencode($mensaje1);
$mensaje2 = urlencode($mensaje2);

header("Location: carga-masiva.php?mensaje1=" . $mensaje1 . "&&mensaje2=" . $mensaje2);
