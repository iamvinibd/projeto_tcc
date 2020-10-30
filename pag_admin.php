<!DOCTYPE html>
<?php
session_start() // inicio a sessão dentro desse script para poder trabalhar com as variáveis enviadas do processamento referente ao login.php
 ?>
<html lang="pt-br" >
  <head>
    <meta charset="utf-8">
    <!--chamo as paginas de estilo dessa página, uma que eu mesmo criei ea outra que se trata de um link com diversas imagens para que eu possa utilizar nos icones-->
    <link rel="stylesheet" href="_css/style_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <title>Página Administrador</title>
  </head>
  <body>
    <!-- Criação da divisão referente a imagem de perfil-->
    <div class="card">
      <!--a partir da sessão busco a pasta referente ao usuario, nesse caso admin, e insiro a foto do perfil-->
      <img src="_notas/<?=$_SESSION["UserCPF"]?>/Foto/<?=$_SESSION["UserCPF"]?>.png" style="width:100%;">
      <!--logo abaixo a imagem de perfil coloco as informações do usuário (admin)-->
      <div class="container">
        <h4><b><?=$_SESSION["UserName"]?></b></h4>
        <p><?=$_SESSION["UserCPF"]?></p>
        <h4><a href="_server/logout.php?">Deslogar</a></h4>
      </div>

    </div>
    <!--divisão referente as tabelas-->
    <div class="tab">
      <!--Crio cada item das abas e adiciono o evento que irá ocorer quando houver o click, esse evento ira ser tratado por um codigo em JavaScript-->
    <button class="tablinks" onclick="openSub(event, 'Clientes')" id="defaultOpen">Clientes</button>
    <button class="tablinks" onclick="openSub(event, 'Produtos')">Produtos</button>
  </div>
  <!--coloco os conteudos de cada aba, sem o javascript as abas são todas mostradas na página sem o feito existente-->
  <div id="Clientes" class="tabcontent">
    <div class="ListaClientes">
      <!--crio os cabeçalhos referente aos clientes, tudo dentro de um formulário, esse formulário não há inputs visiveis ao administrador, mas quando o mesmo quiser ver mais infos dos clientes esse mesmo formulario sera usado para enviar o valor do CPF para a proxima pagina-->
      <h2 id="Cliente">Clientes</h2>
      <form class="form_cliente" action="userinfo.php" method="post">
        <!--crio uma tabela para conter as informações-->
      <table width = "100%"cellpadding="10">
          <tr>
            <!--cabeçalhos-->
            <td><strong>CPF</strong></td>
            <td><strong>Nome</strong></td>
            <td><strong>E-mail</strong></td>
            <td><strong>Detalhes</strong></td>
          </tr>

          <?php
          //para que eu consiga mostrar os usuários ja nesta pagina dentro dessa tabela
            require("_server/users-db-conect.php");// conecto no banco de dados desejado
            $select = mysqli_query($conectUserDB,"select * from usersinfos order by id desc");//seleciono de forma descrescente de acordo com o ID todo os usuário inclusos no banco de dados
            while ($dados= mysqli_fetch_array($select)) { // crio o while para pegar usuario a Usuario
              if ($dados["CPF"]!='admin'){// sendo o usuario diferente de admin
                ?>
              <tr>
                <!--insiro embaixo de cada um dos cabeçalhos as respectivas informações-->
                <td><?=$dados["CPF"]?></td>
                <td><?=$dados["nome"]?></td>
                <td><?=$dados["email"]?></td>
                <!--criação do botão de mais detalhes do usuário, esse botão ira levar o CPF selecionado para a próxima página-->
                <td><a href="userinfo.php?usuario=<?=$dados["CPF"]?>"<button type="button" class="btn"><i class="fa fa-info-circle"></i></button></td>
              </tr>
            <?php }}?>
        </table>
        </form>
    </div>
  </div>
  <!--Colocando o conteudo da aba produtos-->
  <div id="Produtos" class="tabcontent">
    <div class="c_ListaProdutos">
      <!--criação do botão para adição de produtos, que irá redirecionar o admin para uma outra pagina-->
      <h2 id="t_Produtos">Produtos<a href="pag_addprod.php"><button type="button" class="btn"><i class="fa fa-plus-square"></i></button></a></h2>
      <!-- Criação da tabela para inserção dos produtos -->
      <table width = "100%"cellpadding="10">
        <!--criação dos cabeçalhos dos itens-->
          <tr>
            <td><strong>Código</strong></td>
            <td><strong>Nome</strong></td>
            <td><strong>Preço</strong></td>
            <td><strong>Estoque</strong></td>
            <td><strong>Imagem</strong></td>
            <td><strong>Editar/Apagar</strong></td>
          </tr>
          <?php
          //para que eu consiga mostrar os produtos ja nesta pagina dentro dessa tabela
            require("_server/mercado-db-conect.php"); // conecto no banco de dados desejado
            $select = mysqli_query($conectMercadoDB,"select * from produtos order by id desc");//seleciono de forma descrescente de acordo com o ID todos os produtos inclusos no banco de dados
            while ($dados= mysqli_fetch_array($select)) { //crio um while para iterar dentro de todos os produtos
                $valor = $dados["promo"]*$dados["valor"];// corrijo o valor de acordo com a promoção
                $valor = substr($valor,0,4); // pego apenas os bits de interesse para evitar valores como 1,875
                ?>
              <tr>
                <!--coloco os dados em baixo dos respectivos cabeçalhos-->
                <td><?=$dados["codigo"]?></td>
                <td><?=$dados["nome"]?></td>
                <td>R$ <?=$valor?></td>
                <td><?=$dados["estoque"]?></td>
                <!--45x50 - coloco a imagem do produto-->
                <td><img src="_imgProdutoHome/<?=$dados["nome"]?>.jpg"></td>
                <td>
                  <!--crio o botão para edição do produto -->
                  <a href="pag_edita.php?codigo=<?=$dados["codigo"]?>"><button type="button" class="btn"><i class="fa fa-edit"></i></button></a>
                  <!--crio o botão para deletar o produto -->
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
