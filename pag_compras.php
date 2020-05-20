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
      session_start();
      $CPF = $_SESSION["UserCPF"];
      date_default_timezone_set("America/Sao_Paulo");
      $currentDateTime = date('d-m-Y');
      $date = $currentDateTime.".json";
      $filename = "./_notas/$_SESSION[UserCPF]/JSON/$date";
      $codigo=$valor="...";
      $Nome = "-";
      $Produto = "O seu produto aparecera aqui =)";
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
        if ($_POST["search"]!=""){
          $codigo = $_POST["search"];
          require("_server/mercado-db-conect.php");
          $select = mysqli_query($conectMercadoDB,"select * from produtos where codigo=$codigo");

          if($select){
            $dados= mysqli_fetch_array($select);
            $RowMatched = mysqli_num_rows($select);
            $Nome = $dados["nome"];
            if($dados["promo"]!=0){
              $valor = $dados["promo"]*$dados["valor"];
            }
            else {
              $valor = $dados["valor"];
            }
          }
          else {
            $Produto = "Produto não encontrado ";
          }
        }
      }
     ?>
    <div class="c_Busca">
      <form method="post" class="Busca" action="pag_compras.php">
        <table id = "BuscaTable">
          <tr>
            <td><input type="text" placeholder="Search..." name="search"></td>
            <td><button type="submit"><i class="fa fa-search"></i></button></td>
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
        if (file_exists($filename)){
          $count = substr_count(file_get_contents($filename), "a");
          //echo $count;
          if ($count > 0){
            $data = file_get_contents($filename); // put the contents of the file into a variable
            $characters = json_decode($data,true);
            $valor_total = 0;
            foreach ($characters as $character) {
              if($character["info"][0]["qtdd"] !=0){
              $valor_total = strval($valor_total + intval($character["info"][0]["qtdd"])*intval($character["info"][0]["valor"]));
              ?>
              <tr>
                <td><?=$character["codigo"]?></td>
                <td><?=$character["info"][0]["produto"]?></td>
                <td><?=$character["info"][0]["qtdd"]?></td>
                <td><?=strval(intval($character["info"][0]["qtdd"])*intval($character["info"][0]["valor"]))?>,00</td>
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
      <tr>
        <td colspan="4">___________________________________________________________________________________________</td>
      </tr>
        <tr>
          <td><input type="text" value="Preço Final" name="codigo" class="info_compra" readonly></td>
          <td colspan="3"><input type="text" value=<?=$valor_total?>,00 name="codigo" class="info_compra" readonly></td>
        </tr>
        <tr>
          <td colspan="4">
            <a href="_server/end_buying.php"><button type="button" name="fnl" class="btn_acao"><i class="fa fa-shopping-bag"></i></button></a></td>
        </tr>
        </table>


    </div>
  </body>
</html>
