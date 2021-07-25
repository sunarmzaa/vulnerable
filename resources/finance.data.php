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
		  
		  $isTrace=false;
		  $currenDate=new DateTime();
		  
		  $row=$rows[$i];
		    
		  if($row["FinancialInstitute1"]!="") {
			if($row["FinancialDueDate1"]==""){ 
		      $dueDate1=new DateTime($row["CreateDate"]);
			  $dueDate1=$dueDate1->modify('+3 day');
			}else{
			  $dueDate1=new DateTime($row["FinancialDueDate1"]);
			}							
			if($currenDate>$dueDate1){
			  $isTrace=true;
		    }
		  }
			
		  if($row["FinancialInstitute2"]!="") {
			if($row["FinancialDueDate2"]==""){ 
		      $dueDate2=new DateTime($row["CreateDate"]);
			  $dueDate2=$dueDate2->modify('+3 day');
			}else{
			  $dueDate2=new DateTime($row["FinancialDueDate2"]);
			}							
			if($currenDate>$dueDate2){
			  $isTrace=true;
			}
		  }
			
		  if($row["FinancialInstitute3"]!="") {
			if($row["FinancialDueDate3"]==""){ 
		      $dueDate3=new DateTime($row["CreateDate"]);
			  $dueDate3=$dueDate3->modify('+3 day');
			}else{
			  $dueDate3=new DateTime($row["FinancialDueDate3"]);
			}							
			if($currenDate>$dueDate3){
			  $isTrace=true;
			}
		  }
			
		  if($row["FinancialInstitute4"]!="") {
			if($row["FinancialDueDate4"]==""){ 
		      $dueDate4=new DateTime($row["CreateDate"]);
			  $dueDate4=$dueDate4->modify('+3 day');
			}else{
			  $dueDate4=new DateTime($row["FinancialDueDate4"]);
			}							
			if($currenDate>$dueDate4){
			  $isTrace=true;
			}
		  }
			
		  if($row["FinancialInstitute5"]!="") {
			if($row["FinancialDueDate5"]==""){ 
		      $dueDate5=new DateTime($row["CreateDate"]);
			  $dueDate5=$dueDate5->modify('+3 day');
			}else{
			  $dueDate5=new DateTime($row["FinancialDueDate5"]);
			}							
			if($currenDate>$dueDate5){
			  $isTrace=true;
			}
		  }
			
		  if($isTrace){
		    $result["Trace"]="ติดตามสถาบันการเงินฯ";
		  }else{
			$result["Trace"]="ปกติ";
		  }
		  
		  $result["Action"]="<a href='"."finance.trace.php?id=".$rows[$i]["TransectionID"]."' class='fa fa-file'></a>"; //$rows[$i]["TransectionID"]
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
