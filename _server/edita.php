<?php
if (empty($_POST["codigo"])) {// se o codigo estiver vazio
  echo "<script>alert('Favor insira o código do produto');history.back();</script>";// emiti um alerta para o usuário e volta a pagina anterior
}
elseif (empty($_POST["nome"])) {// se o nome estiver vazio
  echo "<script>alert('Favor insira o nome do produto');history.back();</script>";// emiti um alerta para o usuário e volta a pagina anterior
}
elseif (empty($_POST["valor"])) {//se o valor estiver vazio
  echo "<script>alert('Favor insira o valor do produto');history.back();</script>";// emiti um alerta para o usuário e volta a pagina anterior
}
elseif (empty($_POST["promo"])) {//se a promoção estiver vazia
  echo "<script>alert('Favor insira a promoção');history.back();</script>";// emiti um alerta para o usuário e volta a pagina anterior
}
elseif (empty($_POST["estoque"])) {// se o estoque estiver vazio
  echo "<script>alert('Favor insira a quantidade do estoque');history.back();</script>";// emiti um alerta para o usuário e volta a pagina anterior
}
else{
  //Com os valores digitados
  require("mercado-db-conect.php");// conecto no banco de dados
  $CheckDB = mysqli_query($conectMercadoDB,"SELECT * FROM `produtos` WHERE `codigo` LIKE '$_POST[codigo]'" );// procuro no banco de dados pelo produto com o codigo enviado
  $Userdata = mysqli_fetch_array($CheckDB);// pego todas as informações do respectivo produto
  $RowMatched = mysqli_num_rows($CheckDB);// pego a quantidade de linhas que deu match
  if ($RowMatched == 1) {// se a quantidade de linhas for 1
    if ($_POST['codigoorig']!=$_POST["codigo"]){//se o codigo original for diferente do novo codigo
      $CheckDB2 = mysqli_query($conectMercadoDB,"SELECT * FROM `produtos` WHERE `codigo` LIKE '$_POST[codigoorig]'" );//procuro o codigo original no banco de dados
      $Userdata2 = mysqli_fetch_array($CheckDB);// pego todas as informações do respectivo produto
      $RowMatched2 = mysqli_num_rows($CheckDB);// pego a quantidade de linhas que deu match
      if ($RowMatched2 == 1) {// se der match novamente
        echo "<script>alert('Código existente em outro produto');history.back();</script>";// emito um alerta de que o codigo ja existe em outro produto e levo o usuario a pagina anterior
      }
    }
      else {// estando tudo acima ok (codigo não existe em outro produto)
          $novoCodigo = $_POST['codigo'];// passo a informação que o usuario escreveu para uma variavel
          $novoNome = $_POST['nome'] ;// passo a informação que o usuario escreveu para uma variavel
          $novoValor = $_POST['valor'];// passo a informação que o usuario escreveu para uma variavel
          $novoPromo = $_POST['promo'];// passo a informação que o usuario escreveu para uma variavel
          $novoEstoque = $_POST['estoque'];// passo a informação que o usuario escreveu para uma variavel
          mysqli_query($conectMercadoDB,"UPDATE `produtos` SET `codigo` = '$novoCodigo',`nome` = '$novoNome', `valor` = '$novoValor', `promo` = '$novoPromo', `estoque` = '$novoEstoque' WHERE `produtos`.`codigo` = $novoCodigo;");//faço a atualização de todos os campos dentro do banco de dados referente aquele produto
          echo "<script>alert('Produto atualizado com sucesso');location = '../pag_admin.php';</script>";// emito um alerta de que deu tudo certo, redireciono o usuario de volta a pagina do admin
      }
  }
  else {// não havendo alterações no codigo
    $velhoCodigo = $_POST['codigoorig'];// passo a informação que o usuario escreveu para uma variavel
    $novoCodigo = $_POST['codigo'];// passo a informação que o usuario escreveu para uma variavel
    $novoNome = $_POST['nome'] ;// passo a informação que o usuario escreveu para uma variavel
    $novoValor = $_POST['valor'];// passo a informação que o usuario escreveu para uma variavel
    $novoPromo = $_POST['promo'];// passo a informação que o usuario escreveu para uma variavel
    $novoEstoque = $_POST['estoque'];// passo a informação que o usuario escreveu para uma variavel
    mysqli_query($conectMercadoDB,"UPDATE `produtos` SET `codigo` = '$novoCodigo',`nome` = '$novoNome', `valor` = '$novoValor', `promo` = '$novoPromo', `estoque` = '$novoEstoque' WHERE `produtos`.`codigo` = $velhoCodigo;");//faço a atualização de todos os campos dentro do banco de dados referente aquele produto
    echo "<script>alert('Produto atualizado com sucesso');location = '../pag_admin.php';</script>";// emito um alerta de que deu tudo certo, redireciono o usuario de volta a pagina do admin
  }
}

?>
