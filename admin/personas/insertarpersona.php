
<?php

?>
<?php

if (!isset($_POST["nombre"]) || !isset($_POST["apellidos"]) || !isset($_POST["rut"]) || !isset($_POST["rfid"])) {
    exit();
}

include_once "../../utiles/base_de_datos.php";
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$rut = $_POST["rut"];
$rfid = $_POST["rfid"];

if (isset($_POST['subir'])) {//para sacar la url
    $archivo = $_FILES['archivo']['name'];
}
$url = $archivo;
try {
    $sentencia = $base_de_datos->prepare("INSERT INTO persona(nombre, apellidos, rut, rfid, url_foto) VALUES (?, ?, ?, ?, ?);");
    $resultado = $sentencia->execute([strtoupper($nombre), strtoupper($apellidos), strtoupper($rut), strtoupper($rfid), $url]);

    if ($resultado === true) {
        if (isset($archivo) && $archivo != "") {//para guardar
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            if (move_uploaded_file($temp, '../../utiles/persona/' . $archivo)) {
                chmod('../../utiles/persona/' . $archivo, 0777);
            }
        }

        header("Location: listarpersona.php?guardado=1");
    } else {
        header("Location: persona.php?fallo=ErrorAlGuardarPersona");
    }
} catch (\Throwable $th) {
    header("Location: persona.php?fallo=ErrorDesconocidoEnBaseDeDatos");
}
