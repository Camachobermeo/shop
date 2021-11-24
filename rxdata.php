<?php
	$variable = $_GET['contadorvsti'];
	echo "el aforo terraza es: $variable " ;
	$archivo = fopen('terraza.php', 'w+');
	fwrite($archivo, $variable);
	fclose($archivo);
?>
