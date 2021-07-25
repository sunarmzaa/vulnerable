<?php
  session_start();
  
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
  
  if(isset($_GET["financeId"])){
	if($_GET["financeId"]!=""){
	  
	  $comm="SELECT * FROM branch WHERE FinancialInstituteName='".$_GET["financeId"]."' ORDER BY BranchID ASC";

	  $query=$conn->prepare($comm); 
	  $query->execute();
	  $results=array();
	  if($query->rowCount()>0){
		$rows=$query->fetchALL();
		
		for($i=0; $i<$query->rowCount(); $i++){
		  $result=array();
		  $result["BranchName"]=$rows[$i]["BranchName"];
          array_push($results, $result);
		}
	  }
	  echo json_encode($results, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }   
  }
?>
