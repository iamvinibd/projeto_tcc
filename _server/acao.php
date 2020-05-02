<?php
  $codigo = $_GET["codigo"];
  $produto = $_GET["produto"];
  $valor = $_GET["valor"];
  $qtdd = 1;
  $compra = array(
    "Codigo"=>$codigo,
    "Produto"=>$produto,
    "Valor"=>$valor,
  );

  $arquivo = file_get_contents("compras.json");
  $compra_string = json_decode($arquivo);
  //echo $compra_string->Codigo;

  foreach($compra_string as $key => $value) {
    echo $key . " => " . $value . "<br>";
  }
/*
  $fp = fopen("compras.json","a");
  $compra_json = json_encode($compra);
  $escreve = fwrite($fp,$compra_json);
  fclose($fp);
*/
  //echo "<script>location = '../pag_compras.php';</script>";
 ?>
