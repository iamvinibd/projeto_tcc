<!DOCTYPE html>
<html lang="pt-br" dir="ltr">
  <head>
    <meta charset="utf-8">
    <!--Insiro o titulo da página-->
    <title>Informações Usuário</title>
  </head>
  <body>
    <!--crio a divisão que irá conter as informações-->
    <div class="informações">
      <table>
        <?php
        require("_server/users-db-conect.php");//conecto no banco de dados desejado
        $CheckDB = mysqli_query($conectUserDB,"SELECT * FROM `usersinfos` WHERE `CPF` LIKE '$_GET[usuario]'" );//busco o CPF passado no banco de dados
        $Userdata = mysqli_fetch_array($CheckDB);// a partir do que for encontrado irei pegar todas as informações do banco de dados referente a esse CPF
        ?>
        <!--dentro de uma tabela organizo as informações-->
        <h4><a href="pag_admin.php?">Voltar</a></h4>
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
      <!--Crio uma lista para conter as notas fiscais do cliente-->
      <strong>Notas Fiscais</strong>
      <ul id = "list_Notas" style="list-style-type: none;">
      <?php
        $path = "./_notas/$Userdata[CPF]/PDF/"; //crio uma variavel q guardara um diretorio que varia de acordo com o CPF selecionado
        $Directory = new DirectoryIterator($path); // listo todos os elementos que estão dentro desse diretorio
        foreach ($Directory as $FileInfo) { // para cada arquivo nesse diretorio
          if($FileInfo -> isDot())continue; // se for um arquivo(que contem uma extensão)
          $FileName = $FileInfo -> getFilename();// passo o nome do arquivo para uma variavel
          $FilePath = "$path$FileName";// concateno o caminho com o nome do arquivo
        ?>
        <!--Coloco o arquivo na lista HTML no formato de um link para abrir em um nova página-->
        <li><a target="_blank" href="<?=$FilePath?>" ><p><?=$FileName?></p></a></li>
      <?php  }?>
      </ul>
    </div>
  </body>
</html>
