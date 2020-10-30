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
  else{
    $calote = 0;
    $data = file_get_contents($filename); // put the contents of the file into a variable
    $characters = json_decode($data,true);
    $valor_total = 0;
    foreach ($characters as $character) {
      if($character["info"][0]["qtdd"]>0){
        $calote = $calote+1;
      }
    }
    if ($calote>0) {
      echo "<script>alert('Você ainda possui itens em seu carrinho');history.back();</script>";
    }
    else {
      unlink($filename);
      echo "<script>alert('Compra Cancelada com Sucesso');location = '../home.php';</script>";
    }

  }
}
  ?>
