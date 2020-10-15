<?php
//Caso não tenha sido digitado nenhum CPF//Senha pede para o usuario digitar

if (empty($_POST["UserCPF"])) {
  echo "<script>alert('Favor insira seu CPF');history.back();</script>";
}
elseif (empty($_POST["UserSenha"])) {
  echo "<script>alert('Favor insira sua senha');history.back();</script>";
}

//Com os valores digitados, abaixo iremos ver se os mesmos são encontrados no banco de dados de usuários
else{
require("users-db-conect.php");
# Busca CPF no banco de dados
$CheckDB = mysqli_query($conectUserDB,"SELECT * FROM `usersinfos` WHERE `CPF` LIKE '$_POST[UserCPF]'" );
$Userdata = mysqli_fetch_array($CheckDB);
$RowMatched = mysqli_num_rows($CheckDB);

#Se Usuario encontrado checa-se a senha
if($RowMatched == 1){
  if($Userdata["senha"] == $_POST["UserSenha"]){
    #Se a senha for confirmada, inicio uma sessão para compartilhar os dados abaixo com outras páginas
    session_start();
    $_SESSION["UserCPF"] = $Userdata["CPF"];
    $_SESSION["UserName"] = $Userdata["nome"];
    $_SESSION["UserEmail"] = $Userdata["email"];
    if ($_SESSION["UserCPF"] == "admin") {
      echo "<script>location = '../pag_admin.php';</script>";
    }
    //Exibe pop up c mensagem de boas vindas e leva o usuário para sua page
    echo "<script>alert('Bem Vindo $Userdata[nome]');location = '../user.php';</script>";
  }
  else {
    echo "<script>alert('Senha Inválida');history.back();</script>";
  }
}
else{
    echo "<script>alert('Usuário não encontrado');history.back();</script>";
}
}
?>
