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

      <div class="display_produto">
           <table id = "DisplayProdutoTable">
             <tr height = 200px>
               <td><?=$Produto?></td>
             </tr>
          </table>
          <table id = "DisplayInfoTable">
             <tr>
               <td >Nome:</td>
               <td><?=$Nome?></td>
             </tr>
             <tr>
               <td>Valor:</td>
               <td><?=$valor?></td>
             </tr>

           </table>

      </div>



    </div>
  </body>
</html>
