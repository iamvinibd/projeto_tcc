<?php
//Caso não tenha sido digitado nenhum CPF//Senha pede para o usuario digitar

if (empty($_POST["codigo"])) {
  echo "<script>alert('Favor insira o código do produto');history.back();</script>";
}
elseif (empty($_POST["nome"])) {
  echo "<script>alert('Favor insira o nome do produto');history.back();</script>";
}
elseif (empty($_POST["valor"])) {
  echo "<script>alert('Favor insira o valor do produto');history.back();</script>";
}
elseif (empty($_POST["promo"])) {
  echo "<script>alert('Favor insira a promoção');history.back();</script>";
}
elseif (empty($_POST["estoque"])) {
  echo "<script>alert('Favor insira a quantidade do estoque');history.back();</script>";
}

else{
  //Com os valores digitados, abaixo iremos ver se os mesmos são encontrados no banco de dados de usuários
  require("mercado-db-conect.php");
  # Busca CPF no banco de dados

  $CheckDB = mysqli_query($conectMercadoDB,"SELECT * FROM `produtos` WHERE `codigo` LIKE '$_POST[codigo]'" );
  $Userdata = mysqli_fetch_array($CheckDB);
  $RowMatched = mysqli_num_rows($CheckDB);
  if ($RowMatched == 1) {
    if ($_POST['codigoorig']!=$_POST["codigo"]){
      $CheckDB2 = mysqli_query($conectMercadoDB,"SELECT * FROM `produtos` WHERE `codigo` LIKE '$_POST[codigoorig]'" );
      $Userdata2 = mysqli_fetch_array($CheckDB);
      $RowMatched2 = mysqli_num_rows($CheckDB);
      if ($RowMatched2 == 1) {
        echo "<script>alert('Código existente em outro produto');history.back();</script>";
      }
    }
      else {
          $novoCodigo = $_POST['codigo'];
          $novoNome = $_POST['nome'] ;
          $novoValor = $_POST['valor'];
          $novoPromo = $_POST['promo'];
          $novoEstoque = $_POST['estoque'];
          mysqli_query($conectMercadoDB,"UPDATE `produtos` SET `codigo` = '$novoCodigo',`nome` = '$novoNome', `valor` = '$novoValor', `promo` = '$novoPromo', `estoque` = '$novoEstoque' WHERE `produtos`.`codigo` = $novoCodigo;");
          echo "<script>alert('Produto atualizado com sucesso');location = '../pag_admin.php';</script>";
      }
  }
  else {
    $velhoCodigo = $_POST['codigoorig'];
    $novoCodigo = $_POST['codigo'];
    $novoNome = $_POST['nome'] ;
    $novoValor = $_POST['valor'];
    $novoPromo = $_POST['promo'];
    $novoEstoque = $_POST['estoque'];
    mysqli_query($conectMercadoDB,"UPDATE `produtos` SET `codigo` = '$novoCodigo',`nome` = '$novoNome', `valor` = '$novoValor', `promo` = '$novoPromo', `estoque` = '$novoEstoque' WHERE `produtos`.`codigo` = $velhoCodigo;");
    echo "<script>alert('Produto atualizado com sucesso');location = '../pag_admin.php';</script>";
  }
}

?>
