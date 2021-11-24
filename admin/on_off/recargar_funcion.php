<?php

exec("sudo sh /home/pi/shells/recarga.sh");

header("Location: recargar.php?exito=1");
