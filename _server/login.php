<?php
session_start();
if (isset($_POST["UserCPF"])) {
  echo $_SESSION['counter'];
}
else {
  echo "It's unset";
}

 ?>
