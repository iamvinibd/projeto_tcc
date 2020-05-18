<?php
  $codigo = $_GET["codigo"];
  $produto = $_GET["produto"];
  if($produto == "..." ){
      echo "<script>history.back();</script>";
  }
  else{
  $valor = $_GET["valor"];
  $qtdd = 1;
  $status_produto = 0;
  $compra = array(
    "codigo"=>$codigo,
    "info" =>[
    array(
    "produto"=>$produto,
    "valor"=>$valor,
    "qtdd"=>$qtdd
  )]
  );

  $filename = "compras.json";
  if (file_exists($filename)) {
    $count = substr_count(file_get_contents($filename), "a");
    //echo $count;
    if ($count == 0){
      $handle = @fopen($filename, 'r+');
      if ($handle)
      {
          // seek to the end
          fseek($handle, 0, SEEK_END);
          // are we at the end of is the file empty
          if (ftell($handle) > 0)
          {
              // move back a byte
              fseek($handle, -1, SEEK_END);
              // add the trailing comma
              //fwrite($handle, ',', 1);
              // add the new json string
              fwrite($handle, json_encode($compra) . ']');
          }
          else
          {
              // write the first event inside an array
              fwrite($handle, json_encode($compra));
          }
              // close the handle on the file
              fclose($handle);
      }
      echo "<script>location = '../pag_compras.php';</script>";
    }
    else {
      $data = file_get_contents($filename); // put the contents of the file into a variable
      $produtos = json_decode($data,true);
      foreach ($produtos as $key => $produto) {
         if($produto["codigo"] == $codigo){
           $status_produto = 1;
           if(isset($_GET["add"])){
           $produtos[$key]["info"][0]["qtdd"]=strval(intval($produto["info"][0]["qtdd"])+$qtdd);
            }
          if(isset($_GET["rmv"])){
            $produtos[$key]["info"][0]["qtdd"]=strval(intval($produto["info"][0]["qtdd"])-$qtdd);
             }
           //echo $character["info"][0]["qtdd"] ;
           $produtos_new = json_encode($produtos,true); // decode the JSON feed
           file_put_contents($filename,$produtos_new);
         }
       }
    echo "<script>location = '../pag_compras.php';</script>";

    if($status_produto == 0){
      $handle = @fopen($filename, 'r+');
      if ($handle)
      {
          // seek to the end
          fseek($handle, 0, SEEK_END);
          // are we at the end of is the file empty
          if (ftell($handle) > 0)
          {
              // move back a byte
              fseek($handle, -1, SEEK_END);
              // add the trailing comma
              fwrite($handle, ',', 1);
              // add the new json string
              fwrite($handle, json_encode($compra). ']');
          }
          else
          {
              // write the first event inside an array
              fwrite($handle, json_encode($compra));
          }
              // close the handle on the file
              fclose($handle);
              echo "<script>location = '../pag_compras.php';</script>";

      }
    }
    }
    }

  else {
    $fp = fopen($filename,"w");
    fwrite($fp,"[]");
    fclose($fp);
    echo "<script>location = '../pag_compras.php';</script>";
  }
}

 ?>
