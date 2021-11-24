<?php

?>
<?php
#webdebe.com
if (isset($_POST['subir'])) {
   $archivo = $_FILES['archivo']['name'];
   if (isset($archivo) && $archivo != "") {
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      if (move_uploaded_file($temp, '../../utiles/logos/' . $archivo)) {
         chmod('../../utiles/logos/' . $archivo, 0777);
         include_once "../../utiles/base_de_datos.php";
         $url = $archivo;
         try {
            $sentencia = $base_de_datos->prepare("INSERT INTO logo(url_logo) VALUES (?);");
            $resultado = $sentencia->execute([$url]);
            if ($resultado === true) {
               header("Location: tabla_logo.php?guardado=1");
            } else {
               header("Location: logo.php?fallo=1");
            }
         } catch (\Throwable $th) {
            header("Location: logo.php?fallo=1");
         }
      } else {
         header("Location: logo.php?fallo=1");
      }
   }
}




?>