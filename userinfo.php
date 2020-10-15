<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Informações Usuário</title>
  </head>
  <body>
    <div class="informações">
      <table>
        <?php
        require("_server/users-db-conect.php");
        # Busca CPF no banco de dados
        $CheckDB = mysqli_query($conectUserDB,"SELECT * FROM `usersinfos` WHERE `CPF` LIKE '$_GET[usuario]'" );
        $Userdata = mysqli_fetch_array($CheckDB);

        ?>
          <tr>
            <td><strong>Nome:</strong></td>
            <td><?=$Userdata["nome"]?></td>
            </tr>
          <tr>
            <td><strong>CPF:</strong></td>
            <td><?=$Userdata["CPF"]?></td>
          </tr>
          <tr>
            <td><strong>E-mail:</strong></td>
            <td><?=$Userdata["email"]?></td>
        </tr>
      </table>
      <ul id = "list_Notas" style="list-style-type: none;">
      <?php
        $path = "./_notas/$Userdata[CPF]/PDF/";
        $Directory = new DirectoryIterator($path);
        foreach ($Directory as $FileInfo) {
          if($FileInfo -> isDot())continue;
          $FileName = $FileInfo -> getFilename();
        $FilePath = "$path$FileName";
        ?>
        <li><a target="_blank" href="<?=$FilePath?>" ><p><?=$FileName?></p></a></li>
      <?php  }?>
      </ul>
    </div>
  </body>
</html>
