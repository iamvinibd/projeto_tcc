<?php
  session_start();
  date_default_timezone_set("America/Sao_Paulo");
  $currentDateTime = date('d-m-Y');
  $date = $currentDateTime.".json";
  $filename = "../_notas/$_SESSION[UserCPF]/JSON/$date";
  if (file_exists($filename)){

    $count = substr_count(file_get_contents($filename), "a");
    if ($count == 0){
      echo "<script>alert('Nenhuma compra inserida');history.back();</script>";
    }
    else {
  $CPF = $_SESSION["UserCPF"];
  $nome = $_SESSION["UserName"];
  $email = $_SESSION["UserEmail"];
  $date2 = date('d-m-Y H-i');
  $new_filename = "../_notas/$_SESSION[UserCPF]/JSON/$date2";
  $path_to_save ="C:/xampp/htdocs/projeto_tcc/_notas/$CPF/PDF/Nota_Fiscal_$date2.pdf";
  require_once('../TCPDF/tcpdf.php');
  $pdf = new TCPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);
  $pdf->SetFont('dejavusans', '', 14, '', true);
  $pdf->setPrintHeader(false);
  $pdf->setPrintFooter(false);
  $pdf->AddPage();
  $html = <<<EOD
  <h1>IPCart - Nota Fiscal </h1>
  <h4>Dados do cliente</h4>
  <p>$nome</p>
  <p>$CPF</p>
  <p>$email</p>
  <table>
  <tr>
    <td>Código</td>
    <td>Produto</td>
    <td>Quantidade</td>
    <td>Valor</td>
  </tr>
  EOD;
  if (file_exists($filename)){
    $count = substr_count(file_get_contents($filename), "a");
    if ($count > 0){
      require("mercado-db-conect.php");
      $data = file_get_contents($filename); // put the contents of the file into a variable
      $characters = json_decode($data,true);
      $valor_total = 0;
      foreach ($characters as $character) {
        $valor_total = strval($valor_total + intval($character["info"][0]["qtdd"])*floatval($character["info"][0]["valor"]));
        $valor_produto = strval(intval($character["info"][0]["qtdd"])*floatval($character["info"][0]["valor"]));
        $codigo = $character["codigo"];
        $produto = $character["info"][0]["produto"];
        $qtdd = $character["info"][0]["qtdd"];

        $select = mysqli_query($conectMercadoDB,"select * from produtos where codigo=$codigo");
        $dados= mysqli_fetch_array($select);
        $estoque = $dados["estoque"];
        $estoque_new = intval($dados["estoque"])-intval($qtdd);
        $update = mysqli_query($conectMercadoDB,"UPDATE `produtos` SET `estoque` = '$estoque_new' WHERE `codigo` = '$codigo'");
        $html .= <<<EOD
          <tr>
            <td>$codigo</td>
            <td>$produto</td>
            <td>$qtdd</td>
            <td>$valor_produto</td>
          </tr>
  EOD;
    }
    $html .= <<<EOD
        <tr>
          <td></td>
        </tr>
        <tr>
          <td>Total</td>
          <td>$valor_total</td>
          </tr>
      </table>
      EOD;
  }
}
  $pdf->writeHTMLCell(0, 0, '', '', $html, 0, 1, 0, true, '', true);
  // Close and output PDF document
  // This method has several options, check the source code documentation for more information.
  $pdf->Output($path_to_save, 'F');
  rename($filename,$new_filename);
    echo "<script>alert('Compra Finalizada, favor verifique a nota na página do usuário');location = '../home.php';</script>";
}
}
?>
