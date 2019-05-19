<?php
  define('HOST_NAME','dijkstra.ug.bcc.bilkent.edu.tr');
  define('DB_USERNAME','naisila.puka');
  define('DB_PASSWORD','BAlFiBwZ');
  define('DB_NAME','naisila_puka');

  $conn = mysqli_connect(HOST_NAME, DB_USERNAME, DB_PASSWORD, DB_NAME) or die("Couldn't connect to database: ". mysql_error());
  session_start();
?>