<!DOCTYPE html>
<html lang=pt-br>
  <head>
    <meta charset="utf-8">
    <title>Página Inicial - Login</title>
    <link rel="stylesheet" href="_css/slide_style.css">
    <link rel="stylesheet" href="_css/style.css">
  </head>
  <body>
    <div class="c_Slides">
      <div class="SlideShow Fade">
  			<img src="_img/_slides/001.jpg" class="SlideImage">
  		</div>
  		<div class="SlideShow Fade">
  			<img src="_img/_slides/002.jpg" class="SlideImage">
  		</div>
  		<div class="SlideShow Fade">
  			<img src="_img/_slides/003.jpg" class="SlideImage">
  		</div>
  		<div class="SlideShow Fade">
  			<img src="_img/_slides/004.jpg" class="SlideImage">
  		</div>
    </div>

      <div class="c_Login">
      		<form method="post" action="UserLogin.php" id="LoginForm">
      			<table id="LoginTable">
      				<tr>
      					<td>CPF</td>
      					<td><input type="text" maxlength="11" name="UserCPF" class="TextInput"></td>
      				</tr>
      				<tr>
      					<td>Senha</td>
      					<td><input type="password" maxlength="6" name="UserSenha" class="TextInput"></td>
      				</tr>
      				<tr>
      					<td colspan="2"><input type="submit" value="Entrar" class="btn"></td>
      				</tr>
      				<tr>
      					<td colspan="2"><a href="PageCadastro.php"><input type="button" value="Cadastre-se" class="btn"></a></td>
      				</tr>
      			</table>
      		</form>
      	</div>


    <script type="text/javascript" language="javascript" src="_java/AutomaticSlides.js"></script>
  </body>
</html>
