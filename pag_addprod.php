<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="_css/style_home_cadastro.css">
    <title>Novo produto</title>
  </head>
  <body>
    <div class="c_Cadastro">
      <!-- Criação do formulario para login-->
        <form method="post" action="_server/adiciona.php" id="CadastroForm" enctype="multipart/form-data">
          <!--Criação da tabela p posicionar os itens do login-->
          <table id="CadastroTable" >
            <tr>
              <td>Codigo</td>
              <td ><input type="text" name="codigo" class="TextInput"></td>
            </tr>
            <tr>
              <td>Nome</td>
              <td><input type="text" name="nome" class="TextInput"></td>
            </tr>
            <tr>
              <td>Valor</td>
              <td><input type="text" name="valor" class="TextInput"></td>
            </tr>
            <tr>
              <td>Promoção</td>
              <td><input type="text" name="promo" class="TextInput"></td>
            </tr>
            <tr>
              <td>Estoque</td>
              <td><input type="text" name="estoque" class="TextInput"></td>
            </tr>
            <tr>
              <td>Imagem</td>
              <td><!-- MAX_FILE_SIZE deve preceder o campo input -->
                <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                <!-- O Nome do elemento input determina o nome da array $_FILES -->
                <input name="userfile" type="file" class="TextInput" />
              </td>
            </tr>
            <!--Criação dos botões Login/PageCadastro
            login: submit informações do formulario para a action mencionada no formulário
            Cadastro: Leva para a página de cadastro do usuário mencionada no href-->
            <tr>
              <td colspan="2"><input type="submit" value="Adicionar" class="btn"></td>
            </tr>
          </table>
        </form>
      </div>

  </body>
</html>
