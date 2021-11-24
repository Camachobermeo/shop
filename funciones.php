<?php

include_once "utiles/base_de_datos.php";

$id_registro_anterior = $_REQUEST['idRegistro'];
$cuerpo = $_REQUEST['cuerpo'];
$debeBorrar = false;

$conexion = pg_connect("host=" . $rutaServidor . " port=" . $puerto . " dbname=" . $nombreBaseDeDatos . " user=" . $usuario . " password=" . $clave . "") or die('Error al conectar con la base de datos: ' . pg_last_error());
$query = "SELECT * FROM public.registros r LEFT JOIN public.persona p ON p.rfid = r.rfid ORDER BY r.fecha DESC limit 1";
$query2 = "SELECT * FROM public.registros WHERE tambiente > 0 ORDER BY fecha  DESC limit 1";

$qu = pg_query($conexion, $query);
$data = pg_fetch_object($qu);

//ultima temperatura ambiente
$qu2 = pg_query($conexion, $query2);
$data2 = pg_fetch_object($qu2);

if ($data) {

  date_default_timezone_set('America/Santiago');
  setlocale(LC_ALL, 'es_CH');

  $f1 = date("Y-m-d H:i:s");
  $fecha_actual  = strtotime("-10 seconds", strtotime($f1));
  $fecha_entrada = strtotime($data->fecha);

  if ($fecha_actual > $fecha_entrada) {
    $debeBorrar = true;
  }

  if ($data->id_registro == (int)$id_registro_anterior) {
    if ($debeBorrar) {
    } else {
      echo "
      <script type=\"text/javascript\">
      document.getElementById('cuerpo').innerHTML =$cuerpo
      </script>   ";
    }
  } else {
    echo "
    <script type=\"text/javascript\">
     document.getElementById('idRegistro').value=' $data->id_registro ';
    </script> ";

    $codigoError = $data->cod_error;
    switch ($codigoError) {
      case '0':
        echo "<h1 class='text-center'>Bienvenido " . $data->nombre . " " . $data->apellidos . ";</h1>  <br>";
        echo "<h1 class='text-center'> Su Temperatura es: " . $data->temperatura . " °C</h1>";
        if ($data != null && $data->id_persona == null) {
          echo "<h2 class='text-center'> Por favor dirígete a La Administración para completar tu registro.</h2>";
        }
        break;
      case '4':
        echo "<h1 class='text-center'>Bienvenido " . $data->nombre . " " . $data->apellidos . ";</h1>  <br>";
        echo "<h2 class='text-center'> Por Favor, intenta nuevamente.</h2>";
        break;
    }
  }
}

if ($data2) {
  echo "
  <script type=\"text/javascript\">
   document.getElementById('tambiente').innerHTML=' $data2->tambiente  °C';
  </script>   ";
} else {
  echo "
  <script type=\"text/javascript\">
   document.getElementById('tambiente').innerHTML= '23.875 °C';
  </script>   ";
}

pg_close($conexion);
