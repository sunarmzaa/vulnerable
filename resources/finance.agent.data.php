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
  
  $comm="SELECT * FROM user WHERE UserGroup='Business Agent' ORDER BY UserID ASC";

  $query=$conn->prepare($comm); 
  $query->execute();
  
  $results=array();
  
  if($query->rowCount()>0){
    $rows=$query->fetchALL();
	for($i=0; $i<$query->rowCount(); $i++){
	  $result=array();
		$result["UserID"]=$rows[$i]["UserID"];
        $result["IDCard"]=$rows[$i]["IDCard"];
        $result["FullName"]=$rows[$i]["FullName"];
		$result["Email"]=$rows[$i]["Email"];
		$result["Option1"]=$rows[$i]["Option1"];
		if($rows[$i]["Active"]==0){
		  $result["Active"]="ไม่เปิดใช้งาน";
		}else{
		  $result["Active"]="เปิดใช้งาน";
		}
		if($rows[$i]["Active"]==0){
		  $result["Action"]="<a href='javascript:active(".$rows[$i]["UserID"].", 1);' class='btn btn-primary'>เปิดใช้งาน</a>";
		}else{
		  $result["Action"]="<a href='javascript:active(".$rows[$i]["UserID"].", 0);' class='btn btn-danger'>ไม่เปิดใช้งาน</a>";
		}
        array_push($results, $result);
	}
  }
  echo json_encode(array('data' => $results), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
  
  /*
  if(isset($_GET["startdate"]) && isset($_GET["stopdate"])){
	if($_GET["startdate"]!="" && $_GET["stopdate"]!=""){
	  
	  $startdate=ConvertDateToMySQLDate($_GET["startdate"]);
	  $stopdate=ConvertDateToMySQLDate($_GET["stopdate"]);
	  
	  $financeCondition=" ";
	  if(isset($_SESSION["AUTHEN"]["OPTION1"]) && isset($_GET["financeId"])){
		  if($_SESSION["AUTHEN"]["OPTION1"]==$_GET["financeId"]){
			   $financeCondition.=" AND FinancialInstitute1='".$_GET["financeId"]."'";
			   $financeCondition.=" OR FinancialInstitute2='".$_GET["financeId"]."'";
			   $financeCondition.=" OR FinancialInstitute3='".$_GET["financeId"]."'";
			   $financeCondition.=" OR FinancialInstitute4='".$_GET["financeId"]."'";
			   $financeCondition.=" OR FinancialInstitute5='".$_GET["financeId"]."'";
		  }
	  }
	  
	  $comm="SELECT * FROM transection WHERE CreateDate>'".$startdate." 00:00:00' AND CreateDate<='".$stopdate." 23.59.59'".$financeCondition;

	  $query=$conn->prepare($comm); 
	  $query->execute();
	  $results=array();
	  if($query->rowCount()>0){
		$rows=$query->fetchALL();
		for($i=0; $i<$query->rowCount(); $i++){
		  $result=array();
		  $result["TransectionID"]=$rows[$i]["TransectionID"];
          //
          $result["TaxID"]=$rows[$i]["TaxID"];
          $result["CompanyName"]=$rows[$i]["CompanyName"];
		  if($rows[$i]["BusinessType"]=="อื่นๆ"){
		    $result["BusinessType"]=$rows[$i]["BusinessTypeOther"];
		  }else{
			$result["BusinessType"]=$rows[$i]["BusinessType"];
		  }
          $result["ContactName"]=$rows[$i]["ContactName"];
		  $result["Phone"]=$rows[$i]["Phone"];
		  $result["Email"]=$rows[$i]["Email"];
		  $result["CreateDate"]=ConvertMySQLDateTimeToDateTime($rows[$i]["CreateDate"]);
		  $result["Action"]="<a href='"."finance.info.php?id=".$rows[$i]["TransectionID"]."' class='fa fa-file'></a>"; //$rows[$i]["TransectionID"]
          array_push($results, $result);
		}
	  }
	  echo json_encode(array('data' => $results), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }   
  }
  */
  
  function ConvertDateToMySQLDate($selected){
    list($day, $month, $year)=explode('/', $selected);
	return $year."-".$month."-".$day;
  }
  
  function ConvertMySQLDateTimeToDateTime($date){
    list($date, $time)=explode(' ', $date);
	list($year, $month, $day)=explode('-', $date);
	$date=$day."/".$month."/".$year;
	
	list($hour, $minute, $sec)=explode(':', $time);
	$time=$hour.".".$minute;
	return $date." - ".$time;
  }
?>
