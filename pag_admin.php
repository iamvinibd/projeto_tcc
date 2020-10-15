<!DOCTYPE html>
<?php
session_start()
 ?>
<html lang="pt-br" >
  <head>
    <meta charset="utf-8">
    <link rel="stylesheet" href="_css/style_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Admin</title>
  </head>
  <body>
    <div class="card">
      <img src="_notas/<?=$_SESSION["UserCPF"]?>/Foto/male.png" style="width:100%;">
      <div class="container">
        <h4><b><?=$_SESSION["UserName"]?></b></h4>
        <p><?=$_SESSION["UserCPF"]?></p>
      </div>
    </div>
    <div class="tab">
    <button class="tablinks" onclick="openSub(event, 'Clientes')" id="defaultOpen">Clientes</button>
    <button class="tablinks" onclick="openSub(event, 'Produtos')">Produtos</button>
  </div>

  <div id="Clientes" class="tabcontent">
    <div class="ListaClientes">
      <h2 id="Cliente">Clientes</h2>
      <form class="form_cliente" action="userinfo.php" method="post">


      <table width = "100%"cellpadding="10">
          <tr>
            <td><strong>CPF</strong></td>
            <td><strong>Nome</strong></td>
            <td><strong>E-mail</strong></td>
            <td><strong>Detalhes</strong></td>
          </tr>
          <?php
            require("_server/users-db-conect.php");
            $select = mysqli_query($conectUserDB,"select * from usersinfos order by id desc");
            while ($dados= mysqli_fetch_array($select)) {
                ?>
              <tr>
                <td><?=$dados["CPF"]?></td>
                <td><?=$dados["nome"]?></td>
                <td><?=$dados["email"]?></td>
                <td><a href="userinfo.php?usuario=<?=$dados["CPF"]?>"<button type="button" class="btn"><i class="fa fa-info-circle"></i></button></td>
              </tr>

            <?php }?>
        </table>
        </form>
    </div>
  </div>

  <div id="Produtos" class="tabcontent">
    <div class="c_ListaProdutos">
      <h2 id="t_Produtos">Produtos<a href="pag_addprod.php"><button type="button" class="btn"><i class="fa fa-plus-square"></i></button></a></h2>
      <table width = "100%"cellpadding="10">
          <tr>
            <td><strong>Código</strong></td>
            <td><strong>Nome</strong></td>
            <td><strong>Preço</strong></td>
            <td><strong>Estoque</strong></td>
            <td><strong>Imagem</strong></td>
            <td><strong>Editar/Apagar</strong></td>
          </tr>
          <?php
            require("_server/mercado-db-conect.php");
            $select = mysqli_query($conectMercadoDB,"select * from produtos order by id desc");

            while ($dados= mysqli_fetch_array($select)) {
              if($dados["promo"]!=0){
                $valor = $dados["promo"]*$dados["valor"];}
                else{$valor = $dados["valor"];}
                ?>
              <tr>
                <td><?=$dados["codigo"]?></td>
                <td><?=$dados["nome"]?></td>
                <td>R$ <?=$valor?></td>
                <td><?=$dados["estoque"]?></td>
                <!--45x50-->
                <td><img src="_imgProdutoHome/<?=$dados["nome"]?>.jpg"></td>
                <td>
                  <a href="pag_edita.php?codigo=<?=$dados["codigo"]?>"><button type="button" class="btn"><i class="fa fa-edit"></i></button></a>

                  <a href="pag_deleta.php?codigo=<?=$dados["codigo"]?>"><button type="button" class="btn"><i class="fa fa-trash"></i></button></a>
                </td>
              </tr>

            <?php }?>
        </table>
    </div>
  </div>


    <script type="text/javascript" language="javascript" src="_java/verticaltab.js"></script>
  </body>
</html>
