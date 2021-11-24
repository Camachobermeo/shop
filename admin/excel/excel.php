<?php

include_once "../../utiles/base_de_datos.php";

header('Content-type:application/xls');
header('Content-Disposition: attachment; filename=registros.xls');

if (
  !isset($_POST["inicio"]) ||
  !isset($_POST["fin"])
) {
  exit();
}

$inicio = $_POST["inicio"];
$fin = $_POST["fin"];

$conexion = pg_connect("host=" . $rutaServidor . " port=" . $puerto . " dbname=" . $nombreBaseDeDatos . " user=" . $usuario . " password=" . $clave . "") or die('Error al conectar con la base de datos: ' . pg_last_error());
$query = "SELECT * FROM public.registros r LEFT JOIN public.persona p ON p.rfid = r.rfid WHERE fecha::date >= '$inicio' AND fecha::date <= '$fin' order by r.id_registro asc ;";

$result = pg_Exec($conexion, $query);

$isPrintHeader = false;

while ($row = pg_fetch_assoc($result)) {
  if (!$isPrintHeader) {

    echo implode("\t", array_keys($row)) . "\n";
    $isPrintHeader = true;
  }
  echo implode("\t", array_values($row)) . "\n";
}
