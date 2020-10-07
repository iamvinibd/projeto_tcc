<?php
//Caso não tenha sido digitado nenhum CPF//Senha pede para o usuario digitar

if (empty($_POST["UserCPF"])) {
  echo "<script>alert('Favor insira seu CPF');history.back();</script>";
}
elseif (empty($_POST["UserSenha"])) {
  echo "<script>alert('Favor insira sua senha');history.back();</script>";
}
elseif (empty($_POST["UserNome"])) {
  echo "<script>alert('Favor insira seu nome');history.back();</script>";
}
elseif (empty($_POST["UserEmail"])) {
  echo "<script>alert('Favor insira seu email');history.back();</script>";
}

elseif (strlen($_POST["UserCPF"])!=11 or is_numeric($_POST["UserCPF"])== false){
  echo "<script>alert('CPF inválido');history.back();</script>";
}

else{
  //Com os valores digitados, abaixo iremos ver se os mesmos são encontrados no banco de dados de usuários
  require("users-db-conect.php");
  # Busca CPF no banco de dados
  $CheckDB = mysqli_query($conectUserDB,"SELECT * FROM `usersinfos` WHERE `CPF` LIKE '$_POST[UserCPF]'" );
  $Userdata = mysqli_fetch_array($CheckDB);
  $RowMatched = mysqli_num_rows($CheckDB);

  #Se Usuario encontrado checa-se a senha

  if($RowMatched == 1){
      echo "<script>alert('Usuário Existente');location = '../home.php';</script>";

    }
  else{
      $Nome = $_POST["UserNome"];
      $CPF = $_POST["UserCPF"];
      $Senha = $_POST["UserSenha"];
      $Email = $_POST["UserEmail"];
      $filename = "../_notas/$CPF/";
      if (file_exists($filename) and $RowMatched ==0){
      mysqli_query($conectUserDB,"INSERT INTO `usersinfos` (`CPF`, `senha`, `nome`, `email`) VALUES ('$CPF','$Senha','$Nome','$Email');");
      echo "<script>alert('Usuário cadastrado com sucesso');location = '../home.php';</script>";
      }
      else {

      mkdir("../_notas/$CPF/");
      mkdir("../_notas/$CPF/JSON");
      mkdir("../_notas/$CPF/PDF");
      mysqli_query($conectUserDB,"INSERT INTO `usersinfos` (`CPF`, `senha`, `nome`, `email`) VALUES ('$CPF','$Senha','$Nome','$Email');");
      echo "<script>alert('Usuário cadastrado com sucesso');location = '../home.php';</script>";
  }
}

}

?>
