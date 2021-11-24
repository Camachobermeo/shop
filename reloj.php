<?php
echo "<br><br>";
date_default_timezone_set('America/Santiago');
setlocale(LC_ALL, 'es_CH');
$hora = strftime("%H : %M : %S");
$dia = strftime("%a");

switch ($dia) {
  case 'Mon':
    $dia = 'Lunes';
    break;
  case 'Tue':
    $dia = 'Martes';
    break;
  case 'Wed':
    $dia = 'Miércoles';
    break;
  case 'Thu':
    $dia = 'Jueves';
    break;
  case 'Fri':
    $dia = 'Viernes';
    break;
  case 'Sat':
    $dia = 'Sabado';
    break;
  case 'Sun':
    $dia = 'Domingo';
    break;
  default:

    break;
}

$mes = strftime("%m");

switch ($mes) {
  case '01':
    $mes = 'Enero';
    break;
  case '02':
    $mes = 'Febrero';
    break;
  case '03':
    $mes = 'Marzo';
    break;
  case '04':
    $mes = 'Abril';
    break;
  case '05':
    $mes = 'Mayo';
    break;
  case '06':
    $mes = 'Junio';
    break;
  case '07':
    $mes = 'Julio';
    break;
  case '08':
    $mes = 'Agosto';
    break;
  case '09':
    $mes = 'Septiembre';
    break;
  case '10':
    $mes = 'Octubre';
    break;
  case '11':
    $mes = 'Noviembre';
    break;
  case '12':
    $mes = 'Diciembre';
    break;
  default:

    break;
}

echo "<h3><p style='font-size: 40px' > " . $hora . "</p><h3>";
echo "<h3><p style='font-size: 15px' > " . $dia . ", " . strftime(" %d ") . " de " . $mes .  "</p><h3><br>";
