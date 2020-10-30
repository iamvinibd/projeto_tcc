<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="_css/style_cadastro.css">
    <title>Cadastro</title>
  </head>
  <body>
    <div class="c_Cadastro">
      <!-- Criação do formulario para login-->
        <form method="post" action="_server/cadastro.php" id="CadastroForm">
          <!--Criação da tabela p posicionar os itens do login-->
          <table id="CadastroTable">
            <tr>
              <td>CPF</td>
              <td><input type="text" maxlength="11" name="UserCPF" class="TextInput"></td>
            </tr>
            <tr>
              <td>Senha</td>
              <td><input type="password" maxlength="8" name="UserSenha" class="TextInput"></td>
            </tr>
            <tr>
              <td>Nome</td>
              <td><input type="text" maxlength="30" name="UserNome" class="TextInput"></td>
            </tr>
            <tr>
              <td>Email</td>
              <td><input type="text" maxlength="50" name="UserEmail" class="TextInput"></td>
            </tr>
            <!--Criação dos botões Login/PageCadastro
            login: submit informações do formulario para a action mencionada no formulário
            Cadastro: Leva para a página de cadastro do usuário mencionada no href-->
            <tr>
              <td colspan="2"><input type="submit" value="Cadastrar" class="btn"></td>
            </tr>
            <tr>
              <td colspan="2"><a href="home.php"><input type="button" value="Voltar" class="btn"></a></td>
            </tr>
          </table>
        </form>
      </div>

  </body>
</html>
