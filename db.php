<?php

  // Se realiza la conexión a través de la extensión mysqli
  $conexion = mysqli_connect("localhost", "root", "", "futbol");

  //Se comprueba la conexión
  if(mysqli_connect_errno()){
    die(sprintf("[%d] %s\n", mysqli_connect_errno(), mysqli_connect_error()));
  }

 ?>
