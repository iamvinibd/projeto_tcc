<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <!--dou nome a pagina e chamo o estilo que ela irá utilizar-->
    <link rel="stylesheet" href="_css/style_addprod.css">
    <title>Novo produto</title>
  </head>
  <body>
    <div class="c_Cadastro">
      <!-- Criação do formulario para adição do produto-->
        <form method="post" action="_server/adiciona.php" id="CadastroForm" enctype="multipart/form-data">
          <!--Criação da tabela p posicionar os itens do cadastro-->
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
              <td>
                <!-- MAX_FILE_SIZE deve preceder o campo input -->
                <input type="hidden" name="MAX_FILE_SIZE" value="500000" />
                <!-- O Nome do elemento input determina o nome da array $_FILES dentro do adiciona.php-->
                <input name="userfile" type="file" class="FileInput" />
              </td>
            </tr>
            <!--Criação do botão tipo submit que ira levar os dados inseridos a pagina de destino do formulario-->
            <tr>
              <td colspan="2"><input type="submit" value="Adicionar" class="btn"></td>
            </tr>
          </table>
        </form>
      </div>
  </body>
</html>
