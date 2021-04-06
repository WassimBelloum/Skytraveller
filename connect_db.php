<?php 
  $ip = "localhost";
  $user = "Wassim";
  $password = "wY,qbA,#7CC,]Dh";
  $db = "skytraveller(3)";

  // verbinden met database
  $conn = mysqli_connect($ip, $user, $password, $db);

  // controleren van connectie
  if(!$conn){
  echo 'Connection error: ' . mysqli_connect_error();
  }

 ?>