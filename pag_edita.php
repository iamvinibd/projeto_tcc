<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="_css/style_home_cadastro.css">
    <title>Editar</title>
  </head>
  <body>
    <div class="c_Cadastro">
      <!-- Criação do formulario para login-->
        <form method="post" action="_server/edita.php" id="CadastroForm">
          <!--Criação da tabela p posicionar os itens do login-->
          <table id="CadastroTable" >
            <?php
            require("_server/mercado-db-conect.php");
            # Busca CPF no banco de dados
            $CheckDB = mysqli_query($conectMercadoDB,"SELECT * FROM `produtos` WHERE `codigo` LIKE '$_GET[codigo]'" );
            $Userdata = mysqli_fetch_array($CheckDB);

            ?>
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
            <!--Criação dos botões Login/PageCadastro
            login: submit informações do formulario para a action mencionada no formulário
            Cadastro: Leva para a página de cadastro do usuário mencionada no href-->
            <tr>
              <td colspan="2"><input type="submit" value="Editar" class="btn"></td>
            </tr>
          </table>
        </form>
      </div>

  </body>
</html>
