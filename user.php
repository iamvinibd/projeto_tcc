<?php
session_start();
 ?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="utf-8">
    <title>Página do Usuário</title>
    <link rel="stylesheet" href="_css/style_user.css">
  </head>
  <!-- crio o box do cabeçalho-->
  <body class="page_user">
    <div class="cabecalho">
      <!-- Com as informações compartilhadas pela sessão vindas do script login.php, preencho o cabecalho
      com informações do usuário-->
      <h1>Bem Vindo</h1>
      <h2><?=$_SESSION["UserName"]?></h2>
      <h5><?=$_SESSION["UserCPF"]?></h2>
      <h5><?=$_SESSION["UserEmail"]?></h2>
    </div>
    <!--Crio box para as notas fiscais-->
    <div class="c_Notas">
      <h2 id="t_Notas">Notas Fiscais</h2>
      <!-- Cria se uma lista, dentro dessa lista teremos todos os arquivos dentro da pastas_notas/CPF do usuário-->
      <ul id = "list_Notas">
      <?php
        $path = "./_notas/$_SESSION[UserCPF]/PDF/";//crio uma variavel q guardara um diretorio que varia de acordo com o CPF selecionado
        $Directory = new DirectoryIterator($path); // listo todos os elementos que estão dentro desse diretorio
        foreach ($Directory as $FileInfo) {// para cada arquivo nesse diretorio
          if($FileInfo -> isDot())continue;// se for um arquivo(que contem uma extensão)
          $FileName = $FileInfo -> getFilename();// passo o nome do arquivo para uma variavel
          $FilePath = "$path$FileName";// concateno o caminho com o nome do arquivo
        ?>
        <!--Coloco o arquivo na lista HTML no formato de um link para abrir em um nova página-->
        <li><a target="_blank" href="<?=$FilePath?>" ><p><?=$FileName?></p></a></li>
      <?php  }?>
      </ul>
<!-- Crio box da lista de produtos disponíveis-->
    </div>
    <div class="c_ListaProdutos">
      <h2 id="t_Produtos">Produtos</h2>
      <table width = "100%"cellpadding="10">
      		<tr>
      			<td><strong>Imagem</strong></td>
      			<td><strong>Nome</strong></td>
      			<td><strong>Preço</strong></td>
      		</tr>
      		<?php
      			require("_server/mercado-db-conect.php");// conecto no banco de dados
      			$select = mysqli_query($conectMercadoDB,"select * from produtos order by id desc");//seleciono todos os produtos de maneira descrescente
      			while ($dados= mysqli_fetch_array($select)) {// while para iterar dentre os produtos
                $valor = $dados["promo"]*$dados["valor"];// corrijo o valor de acordo com a promoção
                $valor = substr($valor,0,4); // pego apenas os bits de interesse para evitar valores como 1,875
                ?>
      				<tr>
                <!--45x50 campo onde vai a imagem do produto-->
                <td><img src="_imgProdutoHome/<?=$dados["nome"]?>.jpg"></td>
      					<td><?=$dados["nome"]?></td>
      					<td>R$ <?=$valor?></td>
      				</tr>
      			<?php }?>
      	</table>
    </div>
    <!-- Crio box da lista de produtos em promoção-->
    <div class="c_ListaProdutos">
      <h2 id="t_Produtos">Promoções</h2>
      <table width = "100%"cellpadding="10">
      		<tr>
      			<td><strong>Imagem</strong></td>
      			<td><strong>Nome</strong></td>
      			<td><strong>Preço</strong></td>
      		</tr>
      		<?php
      			require("_server/mercado-db-conect.php");// conecto no banco de dados
      			$select = mysqli_query($conectMercadoDB,"select * from produtos order by id desc");//seleciono todos os produtos de maneira descrescente
      			while ($dados= mysqli_fetch_array($select)) {// while para iterar dentre os produtos
              if($dados["promo"]!=1){// se a promo for diferente de 1
                $valor = $dados["promo"]*$dados["valor"];
                $valor = substr($valor,0,4) // pego apenas os bits de interesse para evitar valores como 1,875
                ?>
      				<tr>
                <!--45x50-->
                <td><img src="_imgProdutoHome/<?=$dados["nome"]?>.jpg"></td>
      					<td><?=$dados["nome"]?></td>
      					<td>R$ <?=$valor?></td>
      				</tr>
      			<?php }}?>
      	</table>
    </div>
    <div class="c_BotaoCompras">
      <!--criação do botão para as compras-->
      <a href="pag_compras.php"><input type="button" name="Start_Compras" value=" Iniciar Compras" class="btn_Compras"></a>
    </div>
  </body>
</html>
