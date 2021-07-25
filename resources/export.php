<?php

  //ini_set('display_startup_errors', 1);
  //ini_set('display_errors', 1);
  //error_reporting(-1);

  set_time_limit(2000);
   
  include("access.constant.php");
  
  date_default_timezone_set("Asia/Bangkok");
  
  //CONNECTION
  function PDOConnector(){
	try {
	  $conn = new PDO('mysql:host='.DB_SER.';dbname='.DB_NAME.'', DB_USR, DB_PWD);
	  //$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	  $conn->exec("SET NAMES UTF8");
	  return $conn;
	}catch(PDOException $e){ return null;}
  }
  
  $conn=PDOConnector();
  
  //$comm="SELECT * FROM transaction WHERE `Print`=1 AND `PrintDate`>'2020-05-05 08:00:00' AND `PrintDate`<='2020-05-05 18:30:00' ORDER BY `PrintDate` ASC";
  $comm="SELECT * FROM transaction WHERE `PrintDate`<=CONCAT(CURRENT_DATE, ' 20:00:00') ORDER BY `PrintDate` ASC;"; //ลงทะเบียนสะสม ตั้งแต่วันที่ 2 พ.ค. 12.00 น. - วันที่ 3 พ.ค. 16.30 น.
  //$comm="SELECT * FROM transaction WHERE `Print`=1 ORDER BY `PrintDate` ASC"; //จัดพิมพ์เอกสารสะสม ตั้งแต่วันที่ 2 พ.ค. 12.00 น. - วันที่ 3 พ.ค. 16.30 น.
  $query=$conn->prepare($comm); 
  $query->execute();
  if($query->rowCount()>0){
	$delimiter = ",";
	//transection (total-inform) 2020-05-02 12.00 - 2020-05-05 18.10
    $filename = "transection (total-inform) 2020-05-02 12.00 - " . date('Y-m-d') . " 20.00.csv";
	
	//create a file pointer
    $f = fopen('php://memory', 'w');
	
	//set column headers
    $fields = array('TransectionID', 'IDCard', "FullName", "Age", "Phone", "FromHouseNo", "FromVillageNo", "FromSubDistrict", "FromDistrict", "FromProvince", "ToHouseNo", "ToVillageNo", "ToSubDistrict", "ToDistrict", "ToProvince", "VehicleType", "VehicleLicenseNo", "PrintDate");
    fputcsv($f, $fields, $delimiter);
	
	while ($row = $query->fetch()) {
		$lineData = array($row['TransectionID'], $row['IDCard'], $row['FullName'], $row['Age'], $row['Phone'], $row['FromHouseNo'], $row['FromVillageNo'], $row['FromSubDistrict'], $row['FromDistrict'], $row['FromProvince'], $row['ToHouseNo'], $row['ToVillageNo'], $row['ToSubDistrict'], $row['ToDistrict'], $row['ToProvince'], $row['VehicleType'], $row['VehicleLicenseNo'], $row['PrintDate']);
		fputcsv($f, $lineData, $delimiter);
	}
	
	//move back to beginning of file
    fseek($f, 0);
    
    //set headers to download file rather than displayed
    header('Content-Type: text/csv');
    header('Content-Disposition: attachment; filename="' . $filename . '";');
    
    //output all remaining data on a file pointer
    fpassthru($f);
  }
  //echo "DONE";
  
  exit;
  
  
?>