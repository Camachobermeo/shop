<html>

<head>
  <?php
  include_once "../utiles/base_de_datos.php";
  $sentencia = $base_de_datos->query("select * from logo");
  $logos = $sentencia->fetchAll(PDO::FETCH_OBJ);
  $guardado = false;
  if ($_REQUEST)
    $guardado = $_REQUEST['exito'];
  ?>
  <?php include_once "encabezado.php" ?>
  <br>
  <script type="text/javascript">
    function changeParams() {
      // document.forms["loginForm"]["p"].value = window.btoa(document.forms["loginForm"]["p"].value);
      return true;
    }

    function enableCheckboxes(textbox, checkbox1, checkbox2) {
      // var text = document.getElementById(textbox).value;
      // document.getElementById(checkbox1).disabled = (text.length == 0);
      // document.getElementById(checkbox2).disabled = (text.length == 0);
    }
  </script>
</head>
<div class="container">
  <div class="text-center">
    <?php
    if ($guardado) {
      echo "<div class='alert alert-success' role='alert' id='alerta'>
        <button type='button' class='close' data-dismiss='alert' aria-label='Close'><span aria-hidden='true'>&times;</span></button>
        <strong>Exito!</strong>    La operación solicitada se ha realizado correctamente.
     </div>";
    }
    ?>

    <body>

      <h1>Contador De Personas</h1>
      <br>
      <form name="loginForm" method="GET" action="escribirArchivo.php" onsubmit="changeParams()">
        <table class="table table-light card">
          <tr>
            <td><label for="user">Usuario:</label></td>
            <td><input type="text" class="form-control" id="user" name="u"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><label for="pass">Clave:</label></td>
            <td><input type="password" class="form-control" id="pass" name="p"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><label for="refresh">Actualizar:</label></td>
            <td><input type="text" class="form-control" id="refresh" name="refresh"></td>
            <td>segundos.</td>
            <td></td>
          </tr>
          <tr>
            <td><label for="logo_file">Archivo de logotipo:</label></td>
            <td>
              <select class="form-control" id="logo_file" name="logo_file">
                <?php foreach ($logos as $logo) { ?>
                  <option value="<?php echo $logo->url_logo ?>"><?php echo $logo->url_logo ?></option>
                <?php } ?>
              </select>
              <!-- <input type="text" class="form-control" id="logo_file" name="logo_file"> -->
            </td>
            <td><label for="logo_width">Ancho (px):</label></td>
            <td><input type="text" class="form-control" id="logo_width" name="logo_width"></td>
          </tr>
          <tr>
            <td><label for="header">Encabezamiento</label></td>
            <td><input type="text" class="form-control" id="header" name="header"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><label for="stop">Detener mensaje:</label></td>
            <td><input type="text" class="form-control" id="stop" name="stop"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><label for="go">Ir mensaje:</label></td>
            <td><input type="text" class="form-control" id="go" name="go"></td>
            <td></td>
            <td></td>
          </tr>
          <tr>
            <td><label for="scrolling">Mensaje de desplazamiento</label></td>
            <td colspan="3"><textarea class="form-control" rows="3" cols="50" maxlength="150" id="scrolling" name="scrolling"></textarea></td>
          </tr>
        </table>

        <table class="table table-bordered">
          <tr>
            <th>Camara</th>
            <th>Nombre</th>
            <th>Ip</th>
            <th>Maximo</th>
            <th>Correccion</th>
            <th>Contador 1</th>
            <th>Contador 2</th>
          </tr>
          <?php for ($i = 1; $i <= 8; $i++) { ?>
            <tr>
              <td><label for="camera<?php echo $i ?>"><?php echo $i ?></label></td>
              <td><input type="text" class="form-control" id="nombre<?php echo $i ?>" name="nombre<?php echo $i ?>"></td>
              <td><input type="text" class="form-control" id="camera<?php echo $i ?>" name="ip<?php echo $i ?>"></td>
              <td><input type="text" class="form-control" id="max<?php echo $i ?>" name="max<?php echo $i ?>"></td>
              <td><input type="text" class="form-control" id="correction<?php echo $i ?>" name="correction<?php echo $i ?>"></td>
              <td><input type="checkbox" id="camera<?php echo $i ?>_counter1" name="ip<?php echo $i ?>_c1" value="true"><label for="camera<?php echo $i ?>_counter1"> Contador 1 </label></td>
              <td><input type="checkbox" id="camera<?php echo $i ?>_counter2" name="ip<?php echo $i ?>_c2" value="true"><label for="camera<?php echo $i ?>_counter2"> Contador 2 </label></td>
            </tr>
          <?php } ?>
        </table>

        <table class="table table-light card">
          <tr>
            <td></td>
            <td><input type="checkbox" id="debug" name="debug" value="true">
              <label for="debug"> Información de depuración</label></td>
            <td></td>
            <td class="text-right"><button type="submit" class="btn btn-primary">Enviar</button></td>
          </tr>
          <tr>
            <td></td>
            <td><input type="checkbox" id="negative" name="negative" value="true">
              <label for="negative"> Permitir negativo</label></td>
            <td></td>
            <td></td>
          </tr>
        </table>
      </form>

      <script src="../params.dat"></script>
      <script type="text/javascript">
        var dict = parseParams();
        var msg = "";

        for (var item in dict) {
          var key = item;
          var value = dict[item];

          if (value.length == "")
            continue;

          console.log(key + " = " + value);

          if (document.getElementById(key).type.toLowerCase() == 'checkbox') {
            document.getElementById(key).checked = (value === 'true');
            continue;
          }
          document.getElementById(key).value = value;
        }


        function parseParams() {
          var dictionary = {};

          if (data.indexOf('$') === 0) {
            data = data.substr(1);
          }

          var parts = data.split('$');

          for (var i = 0; i < parts.length; i++) {
            var p = parts[i];
            var keyValuePair = p.split('=');
            var key = keyValuePair[0];
            var value = keyValuePair[1];
            dictionary[key] = value;
          }

          return dictionary;
        }
      </script>
      <br><br><br>

  </div>
</div>
<?php include_once "../pie.php" ?>
</body>

</html>