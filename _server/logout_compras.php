<?php
session_start();
date_default_timezone_set("America/Sao_Paulo");
$currentDateTime = date('d-m-Y');
$date = $currentDateTime.".json";
$filename = "../_notas/$_SESSION[UserCPF]/JSON/$date";
if (file_exists($filename)){

  $count = substr_count(file_get_contents($filename), "a");
  if ($count == 0){
    unlink($filename);
    echo "<script>alert('Compra Cancelada com Sucesso');location = '../home.php';</script>";
  }
}
  ?>
