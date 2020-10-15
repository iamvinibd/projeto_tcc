<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Deletar produto</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  </head>
  <body style="text-align:center;">
    <div>
    <i class="fa fa-exclamation-triangle" style="font-size:200px;"></i>
    </div>
    <div>
    <strong style="font-size:70px;">Deseja mesmo deletar esse item ?</strong>
    </div>
    <?php

     ?>
    <a href="_server/deleta.php?codigo=<?=$_GET["codigo"]?>"><button type="button" class="btn" style="background-color: red;font-size: 100px;"><i class="fa fa-trash"></i></button></a>
  </body>
</html>
