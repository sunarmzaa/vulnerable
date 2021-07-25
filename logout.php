<?php
  session_start();
  
  unset($_SESSION["AUTHEN"]["USER_ID"]);
  unset($_SESSION["AUTHEN"]["EMAIL"]);
  unset($_SESSION["AUTHEN"]["FULLNAME"]);
  unset($_SESSION["AUTHEN"]["ROLE"]);
  unset($_SESSION["vulnerable_id"]);
  
  header("Location: index.php");
  die();
?>