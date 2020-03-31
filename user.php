<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Página do Usuário</title>
  </head>
  <body>
<div>
  <table>
    <?php
    session_start();
    echo "$_SESSION[UserCPF]";
    $path = "./_notas/$_SESSION[UserCPF]/";
    $Directory = new DirectoryIterator($path);
    foreach ($Directory as $FileInfo) {
      if($FileInfo -> isDot())continue;
      $FileName = $FileInfo -> getFilename();
/*
      echo "</br>";
      echo "$FileName";
*/    $FilePath = "$path$FileName";
      echo "$FilePath";

      ?>

      <a target="_blank" href="<?=$FilePath?>" ><p><?=$FileName?></p></a><br/>
    <?php  }?>



    </div>
  </body>
</html>
