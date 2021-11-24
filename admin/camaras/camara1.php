<?php
$file = 'camara2Leer.php';
$resultado = $_POST['camara'];
$fp = fopen($file, 'w');
fwrite($fp, utf8_decode($resultado));
fclose($fp);
chmod($file, 0777);
