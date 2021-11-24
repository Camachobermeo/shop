<?php

exec("sudo sh /home/pi/shells/activa_rfid.sh");

header("Location: rfid.php?exito=1");
