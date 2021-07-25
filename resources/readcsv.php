<?php
  set_time_limit(900);
  
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
  
  $file = fopen("data.csv","r");

  while(!feof($file)){
	
	$item=fgetcsv($file);
	  
	$comm="SELECT * FROM transaction WHERE IDCard='".$item[1]."'";
	$query=$conn->prepare($comm); 
	$query->execute();
	if($query->rowCount()==0){
		
		$comm="INSERT INTO transaction(IDCard, FullName, Age, Phone, FromHouseNo, FromVillageNo, FromSubDistrict, FromDistrict, FromProvince, ToHouseNo, ToVillageNo, ToSubDistrict, ToDistrict, ToProvince, VehicleType, VehicleLicenseNo, Source,CreateDate) 
				VALUES (:IDCard, :FullName, :Age, :Phone, :FromHouseNo, :FromVillageNo, :FromSubDistrict, :FromDistrict, :FromProvince, :ToHouseNo, :ToVillageNo, :ToSubDistrict, :ToDistrict, :ToProvince, :VehicleType, :VehicleLicenseNo, :Source,:CreateDate)";

		$query=$conn->prepare($comm);
		$result=$query->execute(array(
			"IDCard"=>$item[1],			
			"FullName"=>$item[2],
			"Age"=>"0",
			"Phone"=>$item[4],
			"FromHouseNo"=>$item[5],
			"FromVillageNo"=>$item[6],
			"FromSubDistrict"=>$item[7],
			"FromDistrict"=>$item[8],
			"FromProvince"=>$item[9],
			"ToHouseNo"=>$item[10],
			"ToVillageNo"=>$item[11],
			"ToSubDistrict"=>$item[12],
			"ToDistrict"=>$item[13],
			"ToProvince"=>$item[14],
			"VehicleType"=>"",
			"VehicleLicenseNo"=>"",
			"Source"=>"GOOGLE FORM",
			"CreateDate"=>date("Y-m-d H:i:s")
		));
	}
  
    //break;
  }
  
  echo "DONE";

fclose($file);
?>
<html>
	<header>
	<style></style>
	</header>
	<body>
	</body>
</html>