<?php
//Caso não tenha sido digitado nenhum CPF//Senha pede para o usuario digitar

if (empty($_POST["UserCPF"])) { // caso o campo CPF esteja vazio
  echo "<script>alert('Favor insira seu CPF');history.back();</script>"; // emite um alerta ao usuário e volta a pagina anterior
}
elseif (empty($_POST["UserSenha"])) { //caso o campo senha esteja vazio
  echo "<script>alert('Favor insira sua senha');history.back();</script>";// emite um alerta ao usuário e volta a pagina anterior
}
//Com os valores digitados, abaixo iremos ver se os mesmos são encontrados no banco de dados de usuários
else{
require("users-db-conect.php"); // chamo o script que faz a conexão com o banco de dados de desejo
# Busca CPF no banco de dados
$CheckDB = mysqli_query($conectUserDB,"SELECT * FROM `usersinfos` WHERE `CPF` LIKE '$_POST[UserCPF]'" ); // checo no banco de dados se existe algum CPF igual ao informado pelo usuário
$Userdata = mysqli_fetch_array($CheckDB); // pego um vetor contendo todas as informações de match
$RowMatched = mysqli_num_rows($CheckDB); // pego o numero de linhas onde ocorreu o match

#Se Usuario encontrado checa-se a senha
if($RowMatched == 1){ // caso o match tenha sido igual a 1
  if($Userdata["senha"] == $_POST["UserSenha"]){ // verifico se a senha informada pelo usuario é igual ao que está no banco de dados
    #Se a senha for confirmada, inicio uma sessão para compartilhar os dados abaixo com outras páginas
    session_start();
    $_SESSION["UserCPF"] = $Userdata["CPF"]; //paso os dados desse usuario referente ao banco de dados para as variaveis da sessão
    $_SESSION["UserName"] = $Userdata["nome"];//paso os dados desse usuario referente ao banco de dados para as variaveis da sessão
    $_SESSION["UserEmail"] = $Userdata["email"];//paso os dados desse usuario referente ao banco de dados para as variaveis da sessão
    if ($_SESSION["UserCPF"] == "admin") { // caso usuario seja o administrador
      echo "<script>location = '../pag_admin.php';</script>"; // redireciono ele para pagina do admin
    }
    //Exibe pop up c mensagem de boas vindas e leva o usuário para sua page
    echo "<script>location = '../user.php';</script>";// estando todos os dados corretos redireciono o usuario para sua pagina
  }
  else {
    echo "<script>alert('Senha Inválida');history.back();</script>";// se a senha estiver diferente do informado no banco de dados, emito um alerta ao usuario e o leva de volta a página anterior
  }
}
else{
    echo "<script>alert('Usuário não encontrado');history.back();</script>"; // se o rowmatched não for igual a 1 concluo que o usuário não foi encontrado
}
}
?>
