<?php
   
  include("constant.php");
  
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
  
  $comm="UPDATE transaction 
			SET Print=:Print,
			PrintDate=:PrintDate
			WHERE IDCard=:IDCard";
			
  $query=$conn->prepare($comm);
  $result=$query->execute(array(
					"IDCard"=>$_GET["idCard"],		
					"Print"=>"1",			
					"PrintDate"=>date("Y-m-d H:i:s")
				));
				
  echo $result;
?>