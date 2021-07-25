<?php
  session_start();
  
  unset($_SESSION["AUTHEN"]["USER_ID"]);
  unset($_SESSION["AUTHEN"]["EMAIL"]);
  unset($_SESSION["AUTHEN"]["GROUP"]);
  
  header("Location: finance.login.php");
  die();
?>