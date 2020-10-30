<?php
  session_start();// inicio a sessão
  $CPF = $_SESSION["UserCPF"];// armazeno o CPF
  date_default_timezone_set("America/Sao_Paulo");// defino o local para a data
  $currentDateTime = date('d-m-Y');//armazeno a data atual
  $date = $currentDateTime.".json";// armazeno um nome p meu arquivo JSON e utilizara a data atual
  $filename = "../_notas/$_SESSION[UserCPF]/JSON/$date";//crio o caminho inteiro do nome do arquivo
  $codigo = $_GET["codigo"];//armazeno o codigo
  $produto = $_GET["produto"];// armazeno o nome do produto
  if($produto == "-" ){// se não tiver tido match com nenhum produto
      echo "<script>alert('Não há produtos selecionados');location = '../pag_compras.php';</script>"; //informa ao usuário que não havia produtos selecionados e o leva de volta a página de compras
  }
  else{
  $valor = $_GET["valor"];// armazena o valor do produto
  $qtdd = 1;// define quantidade como 1
  $status_produto = 0;// cria variavel status iniciad em 0
  $compra = array(// defino um array dentro de um array
    "codigo"=>$codigo,
    "info" =>[
    array(
    "produto"=>$produto,
    "valor"=>$valor,
    "qtdd"=>$qtdd
  )]
  );
  if (file_exists($filename)) {// se o JSON existir
    $count = substr_count(file_get_contents($filename), "a");//abro o arquivo para atualizar
    if ($count == 0){// se o arquivo estiver vazio
      if(isset($_GET["rmv"])){//se sem o produto constar na lista o usuário tentar remover o produto
        echo "<script>alert('O produto não estava em sua lista de compras');location = '../pag_compras.php';</script>";// se o cliente tentar tirar um produto q não está na lista ele recebera um alerta e voltara a pagina de compras
      }
      else{
      $handle = @fopen($filename, 'r+');// abro o arquivo no modo edição
      if ($handle)// conseguindo abrir o arquivo
      {
          fseek($handle, 0, SEEK_END);// coloco o ponteiro no final do arquivo
          if (ftell($handle) > 0)//tendo algum character nesse arquivo
          {
              fseek($handle, -1, SEEK_END);// retorno 1 byte
              fwrite($handle, json_encode($compra) . ']');// faço a inserção do array criado anteriormente no arquivo JSON
          }
          else
          {
              fwrite($handle, json_encode($compra));//se não escrevo o conteudo sem voltar 1 byte
          }
              fclose($handle);// fecho o arquivo
      }
      echo "<script>location = '../pag_compras.php';</script>";// levo o usuario de volta pra pagina de compras
    }
  }
    else {// o arquivo contendo alguma informação ja
      $data = file_get_contents($filename); // pego o conteudo e passo p uma variável
      $produtos = json_decode($data,true); // faço a decodificação do JSON
      foreach ($produtos as $key => $produto) {// para cada chave chave nesse JSON
         if($produto["codigo"] == $codigo){// se o codigo desse produto ja tiver sido escrito uma vez
           $status_produto = 1;//mudo o status do produto p 1
           if(isset($_GET["add"])){// se o botão pressionado for o de adicionar
           $produtos[$key]["info"][0]["qtdd"]=strval(intval($produto["info"][0]["qtdd"])+$qtdd);// incremento a quantidade de produtos
            }
          if(isset($_GET["rmv"])){// se o botão selecionado for remover
            $produtos[$key]["info"][0]["qtdd"]=strval(intval($produto["info"][0]["qtdd"])-$qtdd);// decremento a quantidade de produtos
             }
          if($produtos[$key]["info"][0]["qtdd"] < 0){// caso a quantidade fique menor do que 0
            $produtos[$key]["info"][0]["qtdd"] = 0;// forço com que a quantidade permaneça em zero
            echo "<script>alert('O produto não estava em sua lista de compras');location = '../pag_compras.php';</script>";// se o cliente tentar tirar um produto q não está na lista ele recebera um alerta e voltara a pagina de compras
          }
           $produtos_new = json_encode($produtos,true); // faço a codificação no formato JSON
           file_put_contents($filename,$produtos_new);// anexo a informação a anterior existente
         }
       }
    //echo "<script>location = '../pag_compras.php';</script>";// redireciono o cliente p pag de compras
    if($status_produto == 0){//se o status do produto continuar em 0, significa q ele não havia sido inserido anteriormente
      if(isset($_GET["rmv"])){//se sem o produto constar na lista o usuário tentar remover o produto
        echo "<script>alert('O produto não estava em sua lista de compras');location = '../pag_compras.php';</script>";// se o cliente tentar tirar um produto q não está na lista ele recebera um alerta e voltara a pagina de compras
      }
      else{ //não tendo pressionado o botão remover
      $handle = @fopen($filename, 'r+');// abre o arquivo modo leitura
      if ($handle)
      {
          fseek($handle, 0, SEEK_END);//move o ponteiro pro final do arquivo
          if (ftell($handle) > 0)
          {
              fseek($handle, -1, SEEK_END);
              fwrite($handle, ',', 1);
              fwrite($handle, json_encode($compra). ']');
          }
          else
          {
              fwrite($handle, json_encode($compra));
          }
              fclose($handle);
              echo "<script>location = '../pag_compras.php';</script>";
      }
    }
    }
    }
    echo "<script>location = '../pag_compras.php';</script>";// redireciono o cliente p pag de compras
  }
  else {
    $fp = fopen($filename,"w");
    fwrite($fp,"[]");
    fclose($fp);
    echo "<script>location = '../pag_compras.php';</script>";
  }
}

 ?>
