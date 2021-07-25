<?php
  include("finance.constant.php");
  
  date_default_timezone_set("Asia/Bangkok");
  
  //CONNECTION
  function PDOConnector(){
	try {
	  $conn = new PDO('mysql:host='.DB_SER.';dbname='.DB_NAME.'', DB_USR, DB_PWD);
	  //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	  $conn->exec("set names utf8");
	  return $conn;
	}catch(PDOException $e){ return null;}
  }
  
  $conn=PDOConnector();
  
  if(isset($_GET["id"]) && isset($_GET["statusId"])){
	if($_GET["id"]!="" && $_GET["statusId"]!=""){
	  $comm="UPDATE user SET Active=".$_GET["statusId"]." WHERE UserID=".$_GET["id"];
      $query=$conn->prepare($comm);
      $query->execute();
	}
  }
  
?>