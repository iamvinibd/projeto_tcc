<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Compras</title>
    <link rel="stylesheet" href="_css/style_compras.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body>
    <?php
      session_start(); #inicia a sessão
      $CPF = $_SESSION["UserCPF"];# armazena o CPF
      date_default_timezone_set("America/Sao_Paulo");# Define a data defaul como SP
      $currentDateTime = date('d-m-Y');#Passa data atual no formato d m y
      $date = $currentDateTime.".json"; # variavel nome do arquivo data.json
      $filename = "./_notas/$_SESSION[UserCPF]/JSON/$date"; #Define full path do arquivo json
      $codigo=$valor="..."; # Define variavel codigo,valor como "..." para evitar msg do PHP
      $Nome = "-";# Define variavel nome como "-" para evitar msg do PHP
      $Produto = "O seu produto aparecera aqui =)";
      if ($_SERVER["REQUEST_METHOD"] == "POST"){ # Se houver uma requisição usando metodo POST
        if ($_POST["search"]!=""){ # Se valor enviado for diferente de ""
          $codigo = $_POST["search"]; # Passa o valor do POST p variável codigo
          require("_server/mercado-db-conect.php"); # Conecta na base de dados do mercado
          $select = mysqli_query($conectMercadoDB,"select * from produtos where codigo=$codigo");# Procura pelo codigo informado dentro da base de dados do mercado
          if($select){ # Caso tenha algum match
            $dados= mysqli_fetch_array($select); # Pega um array dos dados da tabela
            $RowMatched = mysqli_num_rows($select);# Verifica a aquantidade de vezes que houve match do codigo na tabela
            if ($RowMatched>0) {


            $Nome = $dados["nome"];# Passa o nome do produto na tabela p variavel nome
            if($dados["promo"]!=0){ # Se dentro da tabela, a info "promo" for diferente de zero
              $valor = $dados["promo"]*$dados["valor"]; # Multiplica o valor do produto pela % de promoção
            }
            else {
              $valor = $dados["valor"];# Se não mantem valor original
            }
          }

          }
          else {
            $Produto = "Produto não encontrado "; # se o select não der match informa que o produto não foi encontrado
          }
        }

      }
     ?>
    <div class="c_Busca">
      <form method="post" class="Busca" action="pag_compras.php">
        <table id = "BuscaTable">
          <tr>
            <td><input type="text" placeholder="Procurar..." name="search" class="c_buscar"></td>
            <td><button type="submit" name="busca"><i class="fa fa-search"></i></button></td>
          </tr>
        </table>
      </form>
    </div>
    <div class="display_produto">
      <!--360x400-->
      <img src="_imgProduto/<?=$Nome?>.jpg">
    </div>
    <div class="display_info">
      <form class="form_info" action="_server/acao.php" method="get">
        <table border="1" id="table_info">
          <tr>
            <td>Produto: </td>
            <td colspan="2"><input type="text" value=<?=$Nome?> name="produto" class="info" readonly></td>
          </tr>
          <tr>
            <td>R$: </td>
            <td colspan="2"><input type="text" value=<?=$valor?> name="valor" class="info" readonly></td>
          <tr>
            <td>Código</td>
            <td colspan="2"><input type="text" value=<?=$codigo?> name="codigo" class="info" readonly></td>
          </tr>
        </table>
      </div>
      <div class="action_button">
        <table id="action_table">
          <td>
            <button type="submit" name="add" class="btn_acao" float="left"><i class="fa fa-shopping-cart"></i></button>
            <button type="submit" name="rmv" class="btn_acao"><i class="fa fa-remove"></i></button>
          </td>
        </tr>
        </table>
      </form>
      </div>
    <div class="display_compras">

      <table id="table_compras">
        <tr>
          <td><input type="text" value="Código" name="codigo" class="info_compra" readonly></td>
          <td><input type="text" value="Produto" name="codigo" class="info_compra" readonly></td>
          <td><input type="text" value="Quantidade" name="codigo" class="info_compra" readonly></td>
          <td><input type="text" value="Valor (R$)" name="codigo" class="info_compra" readonly></td>
        </tr>
      <?php
        if (file_exists($filename)){ # Se o JSON ja existir
          $count = substr_count(file_get_contents($filename), "a");# abre arquivo utilizando função atualizar, conta qtdd de characteres no arquivo
          //echo $count;
          if ($count > 0){ # se a qtdd de characteres for maior que 0
            $data = file_get_contents($filename); #coloco o conteudo do arquivo em uma variável
            $characters = json_decode($data,true); # Decode no JSON para puxar os dados
            $valor_total = 0;
            foreach ($characters as $character) {# para cada item nesse JSON
              if($character["info"][0]["qtdd"] > 0){ # se tiver qtdd diferente de 0
              $valor_total = strval($valor_total + floatval($character["info"][0]["qtdd"])*floatval($character["info"][0]["valor"])); #Multiplica valor unitário pela qtdd

              ?>
              <tr>
                <td><?=$character["codigo"]?></td>
                <td><?=$character["info"][0]["produto"]?></td>
                <td><?=$character["info"][0]["qtdd"]?></td>
                <td><?=strval(floatval($character["info"][0]["qtdd"])*floatval($character["info"][0]["valor"]))?></td>
              </tr>
            <?php }}
        }
      }?>
      <?php
      if (file_exists($filename)){

          $count = substr_count(file_get_contents($filename), "a");
          //echo $count;
          if ($count == 0){

            $valor_total = 0;
          }
        }
      else{
        $fp = fopen($filename,"w");
        fwrite($fp,"[]");
        fclose($fp);
        $valor_total = 0;
      }
            ?>


        </table>
        <table id="table_fim">
          <tr>
            <td><input type="text" value="Preço Final" name="codigo" class="info_compra" readonly></td>
            <td colspan="3"><input type="text" value=<?=$valor_total?> name="codigo" class="info_compra" readonly></td>
          </tr>
          <tr>
            <td colspan="4">
              <a href="_server/confirm_end.php"><button type="button" name="fnl" class="btn_acao"><i class="fa fa-shopping-bag"></i></button></a></td>
          </tr>
        </table>

    </div>
  </body>
</html>
