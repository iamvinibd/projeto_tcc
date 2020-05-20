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
      <!-- Com as informações compartilhadas pela sessão vindas do script login.ph, preencho o cabecalho
      com informações do usuário-->
      <h1>Bem Vindo!!!</h1>
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
        $path = "./_notas/$_SESSION[UserCPF]/PDF/";
        $Directory = new DirectoryIterator($path);
        foreach ($Directory as $FileInfo) {
          if($FileInfo -> isDot())continue;
          $FileName = $FileInfo -> getFilename();
        $FilePath = "$path$FileName";
        ?>
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
      			require("_server/mercado-db-conect.php");
      			$select = mysqli_query($conectMercadoDB,"select * from produtos order by id desc");

      			while ($dados= mysqli_fetch_array($select)) {
              if($dados["promo"]!=0){
                $valor = $dados["promo"]*$dados["valor"];
              }
              else {

                $valor = $dados["valor"];
              }?>
      				<tr>
                <!--45x50-->
                <td><img src="_imgProdutoHome/<?=$dados["nome"]?>.jpg"></td>
      					<td><?=$dados["nome"]?></td>
      					<td>R$ <?=$valor?></td>
      				</tr>

      			<?php }?>
      	</table>
    </div>
    <div class="c_ListaProdutos">
      <h2 id="t_Produtos">Promoções</h2>
      <table width = "100%"cellpadding="10">
      		<tr>
      			<td><strong>Imagem</strong></td>
      			<td><strong>Nome</strong></td>
      			<td><strong>Preço</strong></td>
      		</tr>
      		<?php
      			require("_server/mercado-db-conect.php");
      			$select = mysqli_query($conectMercadoDB,"select * from produtos order by id desc");

      			while ($dados= mysqli_fetch_array($select)) {
              if($dados["promo"]!=0){
                $valor = $dados["promo"]*$dados["valor"];
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
      <a href="pag_compras.php"><input type="button" name="Start_Compras" value=" Iniciar Compras" class="btn_Compras"></a>

    </div>

  </body>
</html>
