<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <!--criação do cabeçalho e chamando o estilo utilizado na página-->
    <meta charset="utf-8">
    <link rel="stylesheet" href="_css/style_edita.css">
    <title>Editar Produto</title>
  </head>
  <body>
    <div class="c_Inform">
      <!-- Criação do formulario para edição-->
        <form method="post" action="_server/edita.php" id="CadastroForm">
          <!--Criação da tabela p posicionar os itens da edição-->
          <table id="EditaTable" >
            <?php
            require("_server/mercado-db-conect.php"); // conecta se ao banco de dados
            $CheckDB = mysqli_query($conectMercadoDB,"SELECT * FROM `produtos` WHERE `codigo` LIKE '$_GET[codigo]'" );// busco no banco de dados pelo codigo passado para essa pagina
            $Userdata = mysqli_fetch_array($CheckDB);// conforme oq der match irei pegar todas as informações do respectivo produto e guardar nesse array
            ?>
            <!--criação dos campos onde o usuario insere os dados os campos ja estão preenchidos para facilitar a alteração de cada item-->
            <tr>
              <td ><input type="hidden" name="codigoorig" class="TextInput" value="<?=$_GET['codigo']?>"></td>
            </tr>
            <tr>
              <td>Codigo</td>
              <td ><input type="text" name="codigo" class="TextInput" value="<?=$Userdata["codigo"]?>"></td>
            </tr>
            <tr>
              <td>Nome</td>
              <td><input type="text" name="nome" class="TextInput" value="<?=$Userdata["nome"]?>"></td>
            </tr>
            <tr>
              <td>Valor</td>
              <td><input type="text" name="valor" class="TextInput" value="<?=$Userdata["valor"]?>"></td>
            </tr>
            <tr>
              <td>Promoção</td>
              <td><input type="text" name="promo" class="TextInput" value="<?=$Userdata["promo"]?>"></td>
            </tr>
            <tr>
              <td>Estoque</td>
              <td><input type="text" name="estoque" class="TextInput" value="<?=$Userdata["estoque"]?>"></td>
            </tr>
            <!--Criação do botão tipo submit que levara essas informações ao codigo de destino-->
            <tr>
              <td colspan="2"><input type="submit" value="Editar" class="btn"></td>
            </tr>
            <tr>
              <td colspan="2"><a href="pag_admin.php"><input type="button" value="Voltar" class="btn"></a></td>
            </tr>
          </table>
        </form>
      </div>
  </body>
</html>
