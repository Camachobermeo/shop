<?php

?>
<?php
#webdebe.com
if (isset($_POST['subir'])) {
   $archivo = $_FILES['archivo']['name'];
   if (isset($archivo) && $archivo != "") {
      $tamano = $_FILES['archivo']['size'];
      $temp = $_FILES['archivo']['tmp_name'];
      try {
         if (move_uploaded_file($temp, '../../utiles/videos/' . $archivo)) {
            chmod('../../utiles/videos/' . $archivo, 0777);
            include_once "../../utiles/base_de_datos.php";
            $url = $archivo;
            try {
               $sentencia = $base_de_datos->prepare("INSERT INTO video(url_video) VALUES (?);");
               $resultado = $sentencia->execute([$url]);
               if ($resultado === true) {
                  header("Location: tablavideo.php?guardado=1");
               } else {
                  header("Location: videos.php?fallo=ResultadoFalseDeBaseDeDatos");
               }
            } catch (Exception $th) {
               header("Location: videos.php?fallo=ErrorDesconocido");
            }
         } else {
            header("Location: videos.php?fallo=ErrorAlMoverElArchivo");
         }
      } catch (Exception $th) {
         header("Location: videos.php?fallo=ErrorDesconocido");
      }
   }
}




?>
 
 