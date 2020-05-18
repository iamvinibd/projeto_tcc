<?php
  session_start();
  // Include the main TCPDF library (search for installation path).
  require_once('../TCPDF/tcpdf.php');

  $now = getdate();
  $mday = $now['mday'] - ($now['wday'] + 6) % 7;
  $monday = mktime(0, 0, 0, $now['mon'], $mday, $now['year']);
  $date = date('d_m_y', $monday).".json";
  echo $date;

  /*$CPF = $_SESSION["UserCPF"];
  $pdf = pdf_new();
  pdf_open_file($pdf,"./_notas/$_SESSION[UserCPF]/PDF/AEEE")
*/
?>
