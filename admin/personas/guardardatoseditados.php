<?php

?>

<?php


if (
    !isset($_POST["nombre"]) ||
    !isset($_POST["apellidos"]) ||
    !isset($_POST["rut"]) ||
    !isset($_POST["rfid"])
) {
    exit();
}

include_once "../../utiles/base_de_datos.php";
$id = $_POST["id"];
$nombre = $_POST["nombre"];
$apellidos = $_POST["apellidos"];
$rut = $_POST["rut"];
$rfid = $_POST["rfid"];

if (isset($_POST['subir'])) {
    $archivo = $_FILES['archivo']['name'];
}
$url = $archivo;
try {
    if ($url!=null) {
        $sentencia = $base_de_datos->prepare("UPDATE persona SET nombre = ?, apellidos = ?, rut = ?, rfid = ?, url_foto = ? WHERE id_persona = ?;");
        $resultado = $sentencia->execute([strtoupper($nombre), strtoupper($apellidos), strtoupper($rut), strtoupper($rfid), $url, $id]);
    } else {
        $sentencia = $base_de_datos->prepare("UPDATE persona SET nombre = ?, apellidos = ?, rut = ?, rfid = ? WHERE id_persona = ?;");
        $resultado = $sentencia->execute([strtoupper($nombre), strtoupper($apellidos), strtoupper($rut), strtoupper($rfid), $id]);
    }
    if ($resultado === true) {
        if (isset($archivo) && $archivo != "") {
            $tamano = $_FILES['archivo']['size'];
            $temp = $_FILES['archivo']['tmp_name'];
            if (move_uploaded_file($temp, '../../utiles/persona/' . $archivo)) {
                chmod('../../utiles/persona/' . $archivo, 0777);
            }
        }
        header("Location: listarpersona.php?guardado=1");
    } else {
        header("Location: editarpersona.php?id=$id&&daniado=1");
    }
} catch (\Throwable $th) {
    header("Location: editarpersona.php?id=$id&&daniado=1");
}
