<?php

?>

<?php

if (
    !isset($_POST["codigo"]) ||
    !isset($_POST["direccion"]) ||
    !isset($_POST["descripcion"])
) {
    exit();
}


include_once "../../utiles/base_de_datos.php";
$id = $_POST["id"];
$codigo = $_POST["codigo"];
$direccion = $_POST["direccion"];
$descripcion = $_POST["descripcion"];

try {

    $sentencia = $base_de_datos->prepare("UPDATE totem SET codigo = ?, direccion = ?, descripcion = ? WHERE id_totem = ?;");
    $resultado = $sentencia->execute([strtoupper($codigo), strtoupper($direccion), strtoupper($descripcion), $id]);

    if ($resultado === true) {
        header("Location: listar_totem.php?guardado=1");
    } else {
        header("Location: editar_totem.php?id=$id&&daniado=1");
    }
} catch (\Throwable $th) {
    header("Location: editar_totem.php?id=$id&&daniado=1");
}
