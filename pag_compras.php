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
       $codigo=$Nome=$valor="";
       $Produto = "O seu produto aparecera aqui =)";
      if ($_SERVER["REQUEST_METHOD"] == "POST"){
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
      <strong><?=$Produto?></strong>
    </div>
    <div class="display_info">
      <form class="form_info" action="_server/acao.php" method="get">
        <table border="1" id="table_info">
          <tr>
            <td>Produto: </td>
            <td><input type="text" value=<?=$Nome?> name="produto" class="info" readonly></td>
            <td>Ação</td>
          </tr>
          <tr>
            <td>R$: </td>
            <td><input type="text" value=<?=$valor?> name="valor" class="info" readonly></td>
            <td>
              <button type="submit" name="add" class="btn_acao" float="left"><i class="fa fa-shopping-cart"></i></button>
              <button type="submit" name="rmv" class="btn_acao"><i class="fa fa-remove"></i></button>
            </td>
          </tr>
          <tr>
            <td>Código</td>
            <td colspan="2"><input type="text" value=<?=$codigo?> name="codigo" class="info" readonly></td>
          </tr>
        </table>
    </form>
    </div>

    <div class="display_compras">
      <strong>suas compras</strong>
    </div>




  </body>
</html>