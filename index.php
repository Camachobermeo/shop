<!DOCTYPE html>
<html>

<head>
  <title>Totem</title>
  <link rel="stylesheet" href="utiles/bootstrap.min.css">
  <link rel="stylesheet" href="utiles/texto.css">
  <script src="utiles/jquery.js" type="text/javascript"></script>
  <script src="utiles/bootstrap.min.js" type="text/javascript"></script>
  <script src="reloj.js" type="text/javascript"></script>
</head>

<?php
include_once "utiles/base_de_datos.php";
$url = "";
$sentencia = $base_de_datos->query("select * from video");
$videos = $sentencia->fetchAll(PDO::FETCH_OBJ);
foreach ($videos as $aforo) {
  $url = $aforo->url_video;
}
?>

<body class="p-2 mt-1">
  <!-- Logos, reloj y tempertura -->
  <div class="row m-0">
    <div class="col-md-3">
      <img src="utiles/logo1.jpg" width="180" style="position: absolute; left: 0; padding: 20px;"></img>
    </div>

    <div class="col-md-6">
      <br><br>
      <div class="text-center" id="reloj"></div>
      <h3 class='text-center' style='font-size: 40px' id="tambiente"> </h3>
      <input type="text" id="idRegistro" hidden>
    </div>

    <div class="col-md-3">
      <img id="logo" src="utiles/logo.png" width="180" style="position: absolute; right: 0; padding: 10px;" class="mt-3"></img>
    </div>
  </div>

  <!-- Videos -->
  <div class="row m-0 mt-2">
    <video id="mi-video" autoplay muted width="1600" height="880" style="border: 0;">
      <source src="utiles/videos/<?php echo $url ?>" type="video/mp4">
    </video>
  </div>

  <!-- Cuerpo donde aparecen los nombre que entran y salen -->
  <div class="mt-2">
    <div id="cuerpo"></div>
  </div>

  <div id="marquee" class="mb-5 pb-5">
    <div style="font-size: 200%; font-weight: bold;" id="scrolling"></div>
  </div>

  <!-- Ventana con colores -->
  <?php for ($i = 1; $i <= 8; $i++) { ?>
    <div class="mb-5" id="tabla<?php echo $i ?>">
      <div id="aforo<?php echo $i ?>" class="text-center" style="font-size: 500%;">Bienvenido!</div>
      <div class="row">
        <div class="col-md-4 text-center">
          <div style="font-size: 450%;">Actual: </div>
          <strong>
            <div id="div_total<?php echo $i ?>" style="font-size: 800%;">0</div>
          </strong>
        </div>
        <div class="col-md-4 text-center">
          <div style="font-size: 450%;">Permitido: </div>
          <strong>
            <div id="div_max<?php echo $i ?>" style="font-size: 800%;">100</div>
          </strong>
        </div>
        <div class="col-md-4 text-center">
          <img class="pt-4" id="sign<?php echo $i ?>" src="utiles/go.png" width="60%">
        </div>
      </div>
      <strong class="pb-2">
        <div class="text-center" id="msg<?php echo $i ?>" style="font-size: 450%;"></div>
      </strong>
      <div id="debug" style="font-size: 70%;"></div>
    </div>
    <!-- // AQUI PONER IMAGEN -->
    <div class="mb-5" id="imagen<?php echo $i ?>">

      <video autoplay muted loop style="width:100%">
        <source src="utiles/videos/protocolobio.mp4" type="video/mp4" >
      </video>

    </div>

  <?php } ?>

  <script src="params.dat"></script>

  <script>
    // initialization //////////////////////////////////////////
    var videos = <?php echo json_encode($videos); ?>;
    var dict = parseParams();
    actualizarCuerpo();
    updateData();

    // functions //////////////////////////////////////////
    function getTotal(ip, user, pass, counter, debug) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open("GET", "http://" + ip + "/stw-cgi/eventsources.cgi?msubmenu=peoplecount&action=check&Channel=0", false, user, pass); // false for synchronous request
      xmlHttp.withCredentials = true;
      xmlHttp.send(null);

      var str = xmlHttp.responseText;

      var in_key = "." + counter + ".InCount=";
      var out_key = "." + counter + ".OutCount=";
      var in_pos = str.indexOf(in_key) + in_key.length;
      var in_end = str.indexOf("\r", in_pos);
      var in_value = Number(str.slice(in_pos, in_end));
      var out_pos = str.indexOf(out_key) + out_key.length;
      var out_end = str.indexOf("\r", out_pos);
      var out_value = Number(str.slice(out_pos, out_end));
      var total = in_value - out_value;

      if (debug) {
        if (str.indexOf('401 - Unauthorized') >= 0)
          printDebug(' >> Connection or Login problem. Please first try to log-in to the camera(s) WebViewer page.<br>');
        else
          printDebug(" | Counter " + counter + ", In " + in_value + ", Out " + out_value + ", Total " + total);
      }
      return total;
    }

    function getTerraza() {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open("GET", "terraza.php", false); // false for synchronous request
      xmlHttp.withCredentials = true;
      xmlHttp.send(null);
      var str = xmlHttp.responseText;
      return Number(str) || 0;
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

    function updateData() {
      var u = dict['user'];
      // var p = window.atob(dict['pass']);
      var p = window.atob(dict['pass']);
      var debug = dict['debug'];

      if (debug)
        clearDebug();

      var logo_file = "utiles/logo.png";
      if (dict["logo_file"])
        logo_file = "utiles/logos/" + dict["logo_file"];

      var logo_width = 150;
      if (dict["logo_width"] && !isNaN(dict["logo_width"]))
        logo_width = Number(dict["logo_width"]);

      document.getElementById("logo").src = logo_file;
      document.getElementById("logo").width = logo_width;

      var total = [];
      var max = [];
      var correction = [];

      //terraza
      total[1] = 0;
      if (dict["camera" + 1]) {
        var ip = dict["camera" + 1];
        var c1 = dict["camera" + 1 + "_counter1"];
        var c2 = dict["camera" + 1 + "_counter2"];
        try {
          total[1] += getTerraza();
        } catch (error) {
          document.getElementById("tabla" + 1) ? document.getElementById("tabla" + 1).hidden = true : null;
        }
      }
      //end terraza

      for (var i = 2; i <= 8; i++) {
        total[i] = 0;
        if (dict["camera" + i]) {
          var ip = dict["camera" + i];
          var c1 = dict["camera" + i + "_counter1"];
          var c2 = dict["camera" + i + "_counter2"];

          if (ip == "" || u == "" || p == "")
            continue;

          if (debug)
            printDebug("IP " + ip);

          try {
            if (c1)
              total[i] += getTotal(ip, u, p, 1, debug);

            if (c2)
              total[i] += getTotal(ip, u, p, 2, debug);
          } catch (error) {
            document.getElementById("tabla" + i) ? document.getElementById("tabla" + i).hidden = true : null;
          }

          if (debug && !isNaN(total[i]))
            printDebug(" | <a onclick=\"resetCounters('" + ip + "', '" + u + "', '" + p + "')\" href=\"#\"><font size='-3' color='red'>RESET</font></a><br>");
        }
      }

      var header = "Bienvenido!";
      if (dict["header"])
        header = dict["header"];

      // document.getElementById("header").innerHTML = header;

      var msg_stop = "Por Favor Espere...!";
      if (dict["stop"])
        msg_stop = dict["stop"];

      var msg_go = "Ud puede pasar!";
      if (dict["go"])
        msg_go = dict["go"];

      var msg_scrolling = "";
      if (dict["scrolling"])
        msg_scrolling = dict["scrolling"];

      for (var i = 1; i <= 8; i++) {
        var refresh = 5;
        if (dict["refresh"] && !isNaN(dict["refresh"]))
          refresh = Number(dict["refresh"]);

        if (dict["correction" + i] && !isNaN(dict["correction" + i]))
          correction[i] = Number(dict["correction" + i]);

        if (debug && !isNaN(total[i]))
          printDebug("Correction: " + correction[i] + "<br>");

        max[i] = 50;
        if (dict["max" + i] && !isNaN(dict["max" + i]))
          max[i] = Number(dict["max" + i]);

        total[i] += correction[i];

        if (total[i] < 0 && dict["negative"] == false)
          total[i] = 0;



        // if (isNaN(total[i])) {
        //   document.getElementById("div_total" + i).innerHTML = "N/A";
        //   document.getElementById("div_max" + i).innerHTML = "N/A";
        //   document.getElementById("sign" + i).style.display = "none";
        //   setTimeout(updateData, refresh * 1000);
        //   return;
        // }

        document.getElementById("div_total" + i).innerHTML = total[i].toString();
        document.getElementById("div_max" + i).innerHTML = max[i].toString();
        document.getElementById("aforo" + i).innerHTML = "Aforo " + dict["nombre" + i] + " :";
        document.getElementById("sign" + i).style.display = "";
        if (total[i] >= max[i]) {
          document.getElementById("tabla" + i).style.background = "#f0c0c0";
          document.getElementById("div_total" + i).style.color = "red";
          document.getElementById("msg" + i).innerHTML = msg_stop;
          document.getElementById("msg" + i).style.color = "red";
          document.getElementById("sign" + i).src = "utiles/stop.png";
        } else {
          document.getElementById("tabla" + i).style.background = "#c0f0c0";
          document.getElementById("div_total" + i).style.color = "green";
          document.getElementById("msg" + i).innerHTML = msg_go;
          document.getElementById("msg" + i).style.color = "green";
          document.getElementById("sign" + i).src = "utiles/go.png";
        }

        if (dict["camera" + i]) {
          document.getElementById("tabla" + i) ? document.getElementById("tabla" + i).hidden = false : null;
          $.ajax({
            data: {
              camara: total[i]
            },
            url: 'admin/camaras/camara' + i + '.php',
            type: 'post',
            success: function(response) {
              console.log(response);
            }
          })
        } else {
          document.getElementById("tabla" + i) ? document.getElementById("tabla" + i).hidden = true : null;
        }

        //HACER OPERACION AQUI
        if (total[i] == max[i]) {
          document.getElementById("imagen" + i) ? document.getElementById("imagen" + i).hidden = false : null;
          document.getElementById("tabla" + i) ? document.getElementById("tabla" + i).hidden = true : null;
        } else {
          document.getElementById("imagen" + i) ? document.getElementById("imagen" + i).hidden = true : null;
        }

      }

      document.getElementById("scrolling").innerHTML = msg_scrolling;
      setTimeout(updateData, refresh * 1000);

    }

    function resetCounters(ip, user, pass) {
      var xmlHttp = new XMLHttpRequest();
      xmlHttp.open("GET", "http://" + ip + "/stw-cgi/system.cgi?msubmenu=databasereset&action=control&IncludeDataType=PeopleCount", false, user, pass); // false for synchronous request
      xmlHttp.withCredentials = true;
      xmlHttp.send(null);
      updateData();
    }

    function printDebug(text) {
      document.getElementById("debug").innerHTML = document.getElementById("debug").innerHTML + text;
    }

    function clearDebug() {
      document.getElementById("debug").innerHTML = "Debug Info: <a onclick=\"hideDebug()\" href=\"#\"><font size='-3' color='green'>[HIDE]</font></a><br>";
    }

    function hideDebug() {
      var url = window.location.href;
      url = url.replace('&debug=true', '').replace('&debug', '');
      window.location.href = url;
    }

    $("#mi-video").on('ended', function() {
      var $fuente = "";
      $('#mi-video').find('source').each(function() {
        $fuente = $(this).attr('src');
      });

      var index = videos.findIndex(item => "utiles/videos/" + item.url_video == $fuente);

      if (index >= 0 && index < videos.length - 1) {
        $('source', $('#mi-video')).attr('src', "utiles/videos/" + videos[index + 1].url_video);
      } else {
        $('source', $('#mi-video')).attr('src', "utiles/videos/" + videos[0].url_video);
      }
      $('#mi-video')[0].load();
      $('#mi-video')[0].play();
    });

    $('video source').last().on('error', function() {
      var $fuente = "";
      $('#mi-video').find('source').each(function() {
        $fuente = $(this).attr('src');
      });

      var index = videos.findIndex(item => "utiles/videos/" + item.url_video == $fuente);

      if (index >= 0 && index < videos.length - 1) {
        $('source', $('#mi-video')).attr('src', "utiles/videos/" + videos[index + 1].url_video);
      } else {
        videos[0] ? $('source', $('#mi-video')).attr('src', "utiles/videos/" + videos[0].url_video) : null;
      }
      if (videos[0]) {
        $('#mi-video')[0].load();
        $('#mi-video')[0].play();
      }
    });

    function actualizarCuerpo() {
      var idRegistro = document.getElementById("idRegistro").value;
      var cuerpo = document.getElementById("cuerpo").innerHTML;
      $("#cuerpo").load("funciones.php", {
        'idRegistro': idRegistro,
        'cuerpo': cuerpo
      });
      setTimeout(actualizarCuerpo, 300);
    };
  </script>

</body>

<footer class="page-footer font-small stylish-color-dark pt-4 mb-4" style="bottom: 0; width: 100%; position: fixed;">
  <div class="footer-copyright text-center py-3 bg-light mt-3">
    <img src="utiles/logo1.jpg" class="rounded-circle" width="40" height="34">
    <a href="https://www.checkseguro.com/">www.checkseguro.com </a>
    <img src="utiles/icono_instagram.jpg" class="rounded-circle" width="63" height="43">@check_seguro
    <img src="utiles/icono_facebook.jpg" class="rounded-circle" width="50" height="40">Check Seguro
  </div>
</footer>

</html>