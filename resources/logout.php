<?php
  session_start();
  
  unset($_SESSION["AUTHEN"]["USER_ID"]);
  unset($_SESSION["AUTHEN"]["FULLNAME"]);
  unset($_SESSION["AUTHEN"]["LEVEL"]);
  
  header("Location: login");
  die();
?>