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
  
  if(isset($_GET["startdate"]) && isset($_GET["stopdate"])){
	if($_GET["startdate"]!="" && $_GET["stopdate"]!=""){
	  
	  $startdate=ConvertDateToMySQLDate($_GET["startdate"]);
	  $stopdate=ConvertDateToMySQLDate($_GET["stopdate"]);
	  
	  $financeCondition=" ";
	  if(isset($_SESSION["AUTHEN"]["OPTION1"]) && isset($_GET["finance"]) && isset($_SESSION["AUTHEN"]["OPTION2"]) && isset($_GET["branch"])){
		  if($_SESSION["AUTHEN"]["OPTION1"]==$_GET["finance"] && $_SESSION["AUTHEN"]["OPTION2"]==$_GET["branch"]){
			   $financeCondition.=" AND ((FinancialInstitute1='".$_GET["finance"]."' AND FinancialBranch1='".$_GET["branch"]."')";
			   $financeCondition.=" OR (FinancialInstitute2='".$_GET["finance"]."' AND FinancialBranch2='".$_GET["branch"]."')";
			   $financeCondition.=" OR (FinancialInstitute3='".$_GET["finance"]."' AND FinancialBranch3='".$_GET["branch"]."')";
			   $financeCondition.=" OR (FinancialInstitute4='".$_GET["finance"]."' AND FinancialBranch4='".$_GET["branch"]."')";
			   $financeCondition.=" OR (FinancialInstitute5='".$_GET["finance"]."' AND FinancialBranch5='".$_GET["branch"]."'))";
		  }
	  }
	  
	  $comm="SELECT * FROM transection WHERE CreateDate>'".$startdate." 00:00:00' AND CreateDate<='".$stopdate." 23.59.59'".$financeCondition;
	  
	  //echo $comm;

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
