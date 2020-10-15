<?php
$codigo = $_GET['codigo'];
require("mercado-db-conect.php"); # Conecta na base de dados do mercado
$select = mysqli_query($conectMercadoDB,"DELETE FROM `produtos` WHERE `produtos`.`codigo` = $codigo");
echo "<script>alert('Produto deletado com sucesso');location = '../pag_admin.php';</script>";
 ?>
