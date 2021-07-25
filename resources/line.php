<?php

    include("constant.php");

    //CONNECTION
    function PDOConnector(){
	    try {
	        $conn = new PDO('mysql:host='.DB_SER.';dbname='.DB_NAME.'', DB_USR, DB_PWD);
	        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	        $conn->exec("set names utf8");
	    return $conn;
	    }catch(PDOException $e){ return null;}
    }
  
    $conn=PDOConnector();

    function ConvertDateToTH($current){ //No Years
        $month=$current["mon"];
        $monthArr=Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
        $monthName=$monthArr[$month];
        $day=$current["mday"];
        return $day." ".$monthName;
    }

    //comm="SELECT * FROM targets WHERE email='".$_POST["email1"]."' AND active=1 LIMIT 1";
    $comm="SELECT * FROM `targets` WHERE `province`='".PRODUCTION_PROVINCE."'";
   	$query=$conn->prepare($comm); 
   	$query->execute();
    $total=$query->rowCount();

    $comm="SELECT * FROM `targets` WHERE `province`='".PRODUCTION_PROVINCE."' AND DATE_FORMAT(`createDate`, '%Y-%m-%d')=CURDATE()";
   	$query=$conn->prepare($comm); 
   	$query->execute();
    $today=$query->rowCount();

    ini_set('display_errors', 1);
	ini_set('display_startup_errors', 1);
	error_reporting(E_ALL);
    date_default_timezone_set("Asia/Bangkok");
    
	$sToken = "wBaGrgh9yjoSNw2f08DtUVLK906ywkWStOil2cc8f45";
	$sMessage = "\r\n\r\n ข้อมูลผู้ที่เดินทางเข้าหมู่บ้าน/ชุมชน (".PRODUCTION_PROVINCE.")";
    $sMessage .= "\r\n - สะสม ตั้งแต่ ".PRODUCTION_RELEASED." รวม ".$total." ราย";
    $sMessage .= "\r\n - ณ ".ConvertDateToTH(getdate())." จำนวน ".$today." ราย";
    
	$chOne = curl_init(); 
	curl_setopt( $chOne, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
	curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
	curl_setopt( $chOne, CURLOPT_POST, 1); 
	curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
	$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
	curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
	curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
	$result = curl_exec( $chOne ); 

	//Result error 
	if(curl_error($chOne)) 
	{ 
		echo 'error:' . curl_error($chOne); 
	} 
	else { 
		$result_ = json_decode($result, true); 
		echo "status : ".$result_['status']; echo "message : ". $result_['message'];
	} 
    curl_close( $chOne );   
?>