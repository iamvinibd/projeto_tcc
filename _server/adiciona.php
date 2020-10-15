<?php
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
  require("mercado-db-conect.php");
  $CheckDB = mysqli_query($conectMercadoDB,"SELECT * FROM `produtos` WHERE `codigo` LIKE '$_POST[codigo]'" );
  $Userdata = mysqli_fetch_array($CheckDB);
  $RowMatched = mysqli_num_rows($CheckDB);
  if ($RowMatched == 0) {
    mysqli_query($conectMercadoDB,"INSERT INTO `produtos` (`id`, `codigo`, `nome`, `valor`, `promo`, `estoque`) VALUES (NULL, '$_POST[codigo]', '$_POST[nome]', '$_POST[valor]', '$_POST[promo]', '$_POST[estoque]')");
    $prodnome = $_POST["nome"];
    $uploadir_1 = '../_imgProduto/';
    $uploadir_2 = '../_imgProdutoHome/';
    $uploadfile_1 = $uploadir_1 . basename($prodnome . '.jpg');
    #$uploadfile_1 = $uploadir_1 . basename($_FILES['userfile']['name']);
    #$uploadfile_2 = $uploadir_2 . basename($_FILES['userfile']['name']);
    $uploadfile_2 = $uploadir_2 . basename($prodnome . '.jpg');
    $nome = $_FILES['userfile']['name'];
    $temp = $_FILES['userfile']['tmp_name'];
    $tipo = $_FILES['userfile']['type'];
    $tamanho = $_FILES['userfile']['size'];

if ($tamanho > 0) {
  if (($tipo == 'image/jpeg') || ($tipo == "image/jpg")) {
    if ($tamanho<500000) {
      $t = imagecreatefromjpeg($temp);
      $x = imagesx($t);
      $y = imagesy($t);
      $s1 = imagecreatetruecolor(360, 400);
      $s2 = imagecreatetruecolor(45, 50);
      imagecopyresampled($s1, $t, 0, 0, 0, 0, 360, 400,$x, $y);
      imagecopyresampled($s2, $t, 0, 0, 0, 0, 45, 50,$x, $y);
      imagejpeg($s1, $uploadfile_1);
      imagejpeg($s2, $uploadfile_2);
      chmod($uploadfile_1, 0644);
      chmod($uploadfile_2, 0644);
      echo "<script>alert('Produto cadastrado com sucesso');location = '../pag_admin.php';</script>";
      }
    else {
      echo "<script>alert('Imagem muito grande');history.back();</script>";
      }
    }
  else {
    echo "<script>alert('Favor insira um tipo valido de imagem');history.back();</script>";
    }
  }
else {
  echo "<script>alert('Favor insira uma imagem');history.back();</script>";
  }
}
else {
  echo "<script>alert('Codigo de produto existente');history.back();</script>";
  }
}
?>
