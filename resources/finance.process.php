<?php

  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  
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
	}catch(PDOException $e){ 
	  //return null;
	  echo $e->getMessage();
	}
  }
  
  // ENCODE
  function encode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
	$j = 0;
	$hash = "";
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
  }
  
  // DECODE
  function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
	$j = 0;
	$hash = "";
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
  }

  $conn=PDOConnector();
  
  // TEST ENCODE AND DECODE
  //echo "KEY=   ".$_POST["financialInstitute1"]."<br/>";
  //echo "VALUE= ".$_POST["financialAmount1"]."<br/>";
  
  //$encode = encode($_POST["financialAmount1"], $_POST["financialInstitute1"]);
  
  //echo "ENCODE= ".$encode."<br/>";
  
  //$decode = decode($encode, $_POST["financialInstitute1"]);
  
  //echo "DECODE= ".$decode."<br/>";
  
  if(isset($_POST["submit"])){
	
	$comm="INSERT INTO transection(";
	$comm.="TaxID, ";
	$comm.="CompanyName, ";
	$comm.="HouseNo, ";
	$comm.="HouseName, ";
	$comm.="VillageNo, ";
	$comm.="Lane, ";
	$comm.="Road, ";
	$comm.="Subdistrict, ";
	$comm.="District, ";
	$comm.="Province, ";
	$comm.="BusinessType, ";
	$comm.="BusinessTypeOther, ";
	$comm.="IDCard, ";
	$comm.="ContactName, ";
	$comm.="Phone, ";
	$comm.="Email, ";
	$comm.="EmployeeBefore, ";
	$comm.="EmployeeAfter, ";
	$comm.="Effect, ";
	$comm.="Month, ";
	$comm.="FinancialInstitute1, ";
	$comm.="FinancialBranch1, ";
	$comm.="FinancialAmount1, ";
	$comm.="FinancialProcess1, ";
	$comm.="FinancialInstitute2, ";
	$comm.="FinancialBranch2, ";
	$comm.="FinancialAmount2, ";
	$comm.="FinancialProcess2, ";
	$comm.="FinancialInstitute3, ";
	$comm.="FinancialBranch3, ";
	$comm.="FinancialAmount3, ";
	$comm.="FinancialProcess3, ";
	$comm.="FinancialInstitute4, ";
	$comm.="FinancialBranch4, ";
	$comm.="FinancialAmount4, ";
	$comm.="FinancialProcess4, ";
	$comm.="FinancialInstitute5, ";
	$comm.="FinancialBranch5, ";
	$comm.="FinancialAmount5, ";
	$comm.="FinancialProcess5, ";
	$comm.="Softloan, ";
	$comm.="SoftloanAmount, ";
	$comm.="Recoverloan, ";
	$comm.="RecoverloanAmount, ";
	$comm.="DuePayment, ";
	$comm.="CreateDate ";
	
	$comm.=") VALUES (";
	$comm.=":TaxID, ";
	$comm.=":CompanyName, ";
	$comm.=":HouseNo, ";
	$comm.=":HouseName, ";
	$comm.=":VillageNo, ";
	$comm.=":Lane, ";
	$comm.=":Road, ";
	$comm.=":Subdistrict, ";
	$comm.=":District, ";
	$comm.=":Province, ";
	$comm.=":BusinessType, ";
	$comm.=":BusinessTypeOther, ";
	$comm.=":IDCard, ";
	$comm.=":ContactName, ";
	$comm.=":Phone, ";
	$comm.=":Email, ";
	$comm.=":EmployeeBefore, ";
	$comm.=":EmployeeAfter, ";
	$comm.=":Effect, ";
	$comm.=":Month, ";
	$comm.=":FinancialInstitute1, ";
	$comm.=":FinancialBranch1, ";
	$comm.=":FinancialAmount1, ";
	$comm.=":FinancialProcess1, ";
	$comm.=":FinancialInstitute2, ";
	$comm.=":FinancialBranch2, ";
	$comm.=":FinancialAmount2, ";
	$comm.=":FinancialProcess2, ";
	$comm.=":FinancialInstitute3, ";
	$comm.=":FinancialBranch3, ";
	$comm.=":FinancialAmount3, ";
	$comm.=":FinancialProcess3, ";
	$comm.=":FinancialInstitute4, ";
	$comm.=":FinancialBranch4, ";
	$comm.=":FinancialAmount4, ";
	$comm.=":FinancialProcess4, ";
	$comm.=":FinancialInstitute5, ";
	$comm.=":FinancialBranch5, ";
	$comm.=":FinancialAmount5, ";
	$comm.=":FinancialProcess5, ";
	$comm.=":Softloan, ";
	$comm.=":SoftloanAmount, ";
	$comm.=":Recoverloan, ";
	$comm.=":RecoverloanAmount, ";
	$comm.=":DuePayment, ";
	$comm.=":CreateDate ";
	
	$comm.=")";
	
	$financialInstitute1="0";
	$financialBranch1="";
	$financialAmount1="";
	$financialProcess1="";
	
	if($_POST["financialInstitute1"]!="0"){
		$financialInstitute1=$_POST["financialInstitute1"];
		$financialBranch1=$_POST["branch1"];
		$financialAmount1=encode($_POST["financialAmount1"], $_POST["financialInstitute1"]);
		$financialProcess1=$_POST["financialProcess1"];
	}
	
	$financialInstitute2="0";
	$financialBranch2="";
	$financialAmount2="";
	$financialProcess2="";
	if($_POST["financialInstitute2"]!="0"){
		$financialInstitute2=$_POST["financialInstitute2"];
		$financialBranch2=$_POST["branch2"];
		$financialAmount2=encode($_POST["financialAmount2"], $_POST["financialInstitute2"]);
		$financialProcess2=$_POST["financialProcess2"];
	}
	
	$financialInstitute3="0";
	$financialBranch3="";
	$financialAmount3="";
	$financialProcess3="";
	if($_POST["financialInstitute3"]!="0"){
		$financialInstitute3=$_POST["financialInstitute3"];
		$financialBranch3=$_POST["branch3"];
		$financialAmount3=encode($_POST["financialAmount3"], $_POST["financialInstitute3"]);
		$financialProcess3=$_POST["financialProcess3"];
	}
	
	$financialInstitute4="0";
	$financialBranch4="";
	$financialAmount4="";
	$financialProcess4="";
	if($_POST["financialInstitute4"]!="0"){
		$financialInstitute4=$_POST["financialInstitute4"];
		$financialBranch4=$_POST["branch4"];
		$financialAmount4=encode($_POST["financialAmount4"], $_POST["financialInstitute4"]);
		$financialProcess4=$_POST["financialProcess4"];
	}
	
	$financialInstitute5="0";
	$financialBranch5="";
	$financialAmount5="";
	$financialProcess5="";
	if($_POST["financialInstitute5"]!="0"){
		$financialInstitute5=$_POST["financialInstitute5"];
		$financialBranch5=$_POST["branch5"];
		$financialAmount5=encode($_POST["financialAmount5"], $_POST["financialInstitute5"]);
		$financialProcess5=$_POST["financialProcess5"];
	}
	
	$softloanAmount=0;
	if($_POST["softloanAmount"]!=""){
		$softloanAmount=$_POST["softloanAmount"];
	}
	
	$recoverloanAmount=0;
	if($_POST["recoverloanAmount"]!=""){
		$recoverloanAmount=$_POST["recoverloanAmount"];
	}
	
	$query=$conn->prepare($comm);
	
    $result=$query->execute(array(
      "TaxID"=>$_POST["taxId"],
	  "CompanyName"=>$_POST["companyName"],	
	  "HouseNo"=>$_POST["houseNo"],	
	  "HouseName"=>$_POST["houseName"],	
	  "VillageNo"=>$_POST["villageNo"],	
	  "Lane"=>$_POST["lane"],
	  "Road"=>$_POST["road"],
	  "Subdistrict"=>$_POST["subdistrict"],
	  "District"=>$_POST["district"],
	  "Province"=>$_POST["province"],
	  "BusinessType"=>$_POST["businessType"],
	  "BusinessTypeOther"=>$_POST["other"],
	  "IDCard"=>$_POST["idCard"],
	  "ContactName"=>$_POST["fullname"],
	  "Phone"=>$_POST["phone"],
	  "Email"=>$_POST["email"],
	  "EmployeeBefore"=>$_POST["noOfEmployeeBeforeCovid"],
	  "EmployeeAfter"=>$_POST["noOfEmployeeAfterCovid"],
	  "Effect"=>$_POST["noOfEffect"],
	  "Month"=>$_POST["noOfMonth"],
	  
	  "FinancialInstitute1"=>$financialInstitute1,
	  "FinancialBranch1"=>$financialBranch1,
	  "FinancialAmount1"=>$financialAmount1,
	  "FinancialProcess1"=>$financialProcess1,
	  
	  "FinancialInstitute2"=>$financialInstitute2,
	  "FinancialBranch2"=>$financialBranch2,
	  "FinancialAmount2"=>$financialAmount2,
	  "FinancialProcess2"=>$financialProcess2,
	  
	  "FinancialInstitute3"=>$financialInstitute3,
	  "FinancialBranch3"=>$financialBranch3,
	  "FinancialAmount3"=>$financialAmount3,
	  "FinancialProcess3"=>$financialProcess3,
	  
	  "FinancialInstitute4"=>$financialInstitute4,
	  "FinancialBranch4"=>$financialBranch4,
	  "FinancialAmount4"=>$financialAmount4,
	  "FinancialProcess4"=>$financialProcess4,
	  
	  "FinancialInstitute5"=>$financialInstitute5,
	  "FinancialBranch5"=>$financialBranch5,
	  "FinancialAmount5"=>$financialAmount5,
	  "FinancialProcess5"=>$financialProcess5,
	  
	  "Softloan"=>$_POST["isSoftloan"],
	  "SoftloanAmount"=>$softloanAmount,
	  
	  "Recoverloan"=>$_POST["isRecoverloan"],
	  "RecoverloanAmount"=>$recoverloanAmount,
	  
	  "DuePayment"=>$_POST["duePayment"],
	  
	  "CreateDate"=>date("Y-m-d H:i:s")
    ));
	
	$lastId=$conn->lastInsertId();
	
	if($result){
		header("Location: finance.result.php?result=1&referanceId=".$lastId);
		die();
	}else{
		header("Location: finance.result.php?result=0");
		die();
	}
  }

?>
