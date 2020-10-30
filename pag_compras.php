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
      session_start(); //inicia a sessão
      $CPF = $_SESSION["UserCPF"];// armazena o CPF
      date_default_timezone_set("America/Sao_Paulo");// Define o local para data default como SP
      $currentDateTime = date('d-m-Y');//Passa data atual no formato d m y
      $date = $currentDateTime.".json"; //variavel nome do arquivo data.json
      $filename = "./_notas/$_SESSION[UserCPF]/JSON/$date"; //Define full path do arquivo json
      $codigo=$valor="..."; //Define variavel codigo,valor como "..." para evitar msg do PHP
      $Nome = "-";// Define variavel nome como "-" para evitar msg do PHP
      if ($_SERVER["REQUEST_METHOD"] == "POST"){ // Se houver uma requisição usando metodo POST
        if ($_POST["search"]!=""){ // Se valor enviado for diferente de ""
          $codigo = $_POST["search"]; // Passa o valor do POST p variável codigo
          require("_server/mercado-db-conect.php"); // Conecta na base de dados do mercado
          $select = mysqli_query($conectMercadoDB,"select * from produtos where codigo=$codigo");// Procura pelo codigo informado dentro da base de dados do mercado
          if($select){ // Caso tenha algum match
            $dados= mysqli_fetch_array($select); // Pega um array dos dados da tabela
            $RowMatched = mysqli_num_rows($select);// Verifica a aquantidade de vezes que houve match do codigo na tabela
            if ($RowMatched>0) {// se houver algum match
              $Nome = $dados["nome"];// Passa o nome do produto na tabela p variavel nome
              $valor = $dados["promo"]*$dados["valor"];// corrijo o valor de acordo com a promoção
              $valor = substr($valor,0,4); // pego apenas os bits de interesse para evitar valores como 1,875
            }
          }
        }
      }
     ?>
     <!--crio o container para o espaço de busca do produto-->
    <div class="c_Busca">
      <!--e criado um formulario para transferencia do conteudo do campo de busca-->
      <form method="post" class="Busca" action="pag_compras.php">
        <table id = "BuscaTable">
          <tr>
            <td><input type="text" placeholder="Procurar..." name="search" class="c_buscar"></td>
            <td><button type="submit" name="busca"><i class="fa fa-search"></i></button></td>
          </tr>
        </table>
      </form>
    </div>
    <!--crio a divisão onde sera mostrado o produto-->
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
      <!--crio a divisão onde estarão os botões referentes a ação do usuario-->
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
      <!--crio a tabela contendo as informações da compra atual-->
    <div class="display_compras">
      <table id="table_compras">
        <tr>
          <td><input type="text" value="Código" name="codigo" class="info_compra" readonly></td>
          <td><input type="text" value="Produto" name="produto" class="info_compra" readonly></td>
          <td><input type="text" value="Quantidade" name="quantidade" class="info_compra" readonly></td>
          <td><input type="text" value="Valor (R$)" name="valor" class="info_compra" readonly></td>
        </tr>
      <?php
        if (file_exists($filename)){ // Se o JSON ja existir
          $count = substr_count(file_get_contents($filename), "a");// abre arquivo utilizando função atualizar, conta qtdd de characteres no arquivo
          if ($count > 0){ // se a qtdd de characteres for maior que 0
            $data = file_get_contents($filename); //coloco o conteudo do arquivo em uma variável
            $characters = json_decode($data,true); // Decode no JSON para puxar os dados
            $valor_total = 0;
            foreach ($characters as $character) {// para cada item nesse JSON
              if($character["info"][0]["qtdd"] > 0){ // se tiver qtdd diferente de 0
                $valor_total = strval($valor_total + floatval($character["info"][0]["qtdd"])*floatval($character["info"][0]["valor"])); //Multiplica valor unitário pela qtdd
                $valor_interm = strval(floatval($character["info"][0]["qtdd"])*floatval($character["info"][0]["valor"]));
              ?>
              <!--insere as informações na tabela-->
              <tr>
                <td><?=$character["codigo"]?></td>
                <td><?=$character["info"][0]["produto"]?></td>
                <td><?=$character["info"][0]["qtdd"]?></td>
                <td><?=$valor_interm?></td>
              </tr>
            <?php }}
        }
      }?>
      <?php
      if (file_exists($filename)){// Se o JSON ja existir
          $count = substr_count(file_get_contents($filename), "a");// abre arquivo utilizando função atualizar, conta qtdd de characteres no arquivo
          if ($count == 0){// se o arquivo estiver vazio
            $valor_total = 0;//valor total é 0
          }
        }
      else{//se o arquivo não existe
        $fp = fopen($filename,"w");//crio um novo arquivo para o json
        fwrite($fp,"[]");//escrevo nele apenas o []
        fclose($fp);// fecho o arquivo
        $valor_total = 0;// defino valor total como 0
      }
            ?>
        </table>
        <!--Crio tabela para organizar conteudo final para compra-->
        <table id="table_fim">
          <tr>
            <td><input type="text" value="Preço Final" name="codigo" class="info_compra" readonly></td>
            <td><input type="text" value="R$" name="codigo" class="info_compra" readonly></td>
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
