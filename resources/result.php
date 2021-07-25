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
  
  if(isset($_POST["submit"])){
	if($_POST["isExist"]==true){
		
		if(isset($_POST["reason1"])){
			$reason1=1;
		}else{
			$reason1=0;
		}

		if(isset($_POST["reason2"])){
			$reason2=1;
		}else{
			$reason2=0;
		}
		
		$comm="UPDATE transaction 
			SET FullName=:FullName,
			Age=:Age,
			Phone=:Phone, 
			FromHouseNo=:FromHouseNo, 
			FromVillageNo=:FromVillageNo, 
			FromSubDistrict=:FromSubDistrict, 
			FromDistrict=:FromDistrict, 
			FromProvince=:FromProvince, 
			ToHouseNo=:ToHouseNo, 
			ToVillageNo=:ToVillageNo, 
			ToSubDistrict=:ToSubDistrict, 
			ToDistrict=:ToDistrict, 
			ToProvince=:ToProvince, 
			VehicleType=:VehicleType, 
			VehicleLicenseNo=:VehicleLicenseNo, 
			Reason1=:Reason1, 
			Reason2=:Reason2, 
			Reason2Description=:Reason2Description, 
			CreateDate=:CreateDate
			WHERE IDCard=:IDCard";
			

		$query=$conn->prepare($comm);
		$result=$query->execute(array(
			"IDCard"=>strtoupper($_POST["idCard"]),			
			"FullName"=>$_POST["fullname"],
			"Age"=>$_POST["age"],
			"Phone"=>$_POST["phone"],
			"FromHouseNo"=>$_POST["fromHouseNo"],
			"FromVillageNo"=>$_POST["fromVillageNo"],
			"FromSubDistrict"=>$_POST["fromSubDistrict"],
			"FromDistrict"=>$_POST["fromDistrict"],
			"FromProvince"=>"ภูเก็ต",
			"ToHouseNo"=>$_POST["toHouseNo"],
			"ToVillageNo"=>$_POST["toVillageNo"],
			"ToSubDistrict"=>$_POST["toSubDistrict"],
			"ToDistrict"=>$_POST["toDistrict"],
			"ToProvince"=>$_POST["toProvince"],
			"VehicleType"=>$_POST["vehicleType"],
			"VehicleLicenseNo"=>$_POST["vehicleLicenseNo"],
			"Reason1"=>$reason1,
			"Reason2"=>$reason2,
			"Reason2Description"=>$_POST["reason2Desc"],
			"CreateDate"=>date("Y-m-d H:i:s")
		));
		if($result){
			header("Location: ducument.php?idCard=".$_POST["idCard"]);
			die();
		}
	}else{ // INSERT
	
		$comm="SELECT * FROM transaction WHERE IDCard='".$_POST["idCard"]."'";
		$query=$conn->prepare($comm); 
		$query->execute();
		if($query->rowCount()==0){
			
			if(isset($_POST["reason1"])){
				$reason1=1;
			}else{
				$reason1=0;
			}

			if(isset($_POST["reason2"])){
				$reason2=1;
			}else{
				$reason2=0;
			}
			
			$comm="INSERT INTO transaction(IDCard, FullName, Age, Phone, FromHouseNo, FromVillageNo, FromSubDistrict, FromDistrict, FromProvince, ToHouseNo, ToVillageNo, ToSubDistrict, ToDistrict, ToProvince, VehicleType, VehicleLicenseNo, Reason1, Reason2, Reason2Description, Source, CreateDate) 
				VALUES (:IDCard, :FullName, :Age, :Phone, :FromHouseNo, :FromVillageNo, :FromSubDistrict, :FromDistrict, :FromProvince, :ToHouseNo, :ToVillageNo, :ToSubDistrict, :ToDistrict, :ToProvince, :VehicleType, :VehicleLicenseNo, :Reason1, :Reason2, :Reason2Description, :Source, :CreateDate)";

			$query=$conn->prepare($comm);
			$result=$query->execute(array(
				"IDCard"=>strtoupper($_POST["idCard"]),			
				"FullName"=>$_POST["fullname"],
				"Age"=>$_POST["age"],
				"Phone"=>$_POST["phone"],
				"FromHouseNo"=>$_POST["fromHouseNo"],
				"FromVillageNo"=>$_POST["fromVillageNo"],
				"FromSubDistrict"=>$_POST["fromSubDistrict"],
				"FromDistrict"=>$_POST["fromDistrict"],
				"FromProvince"=>"ภูเก็ต",
				"ToHouseNo"=>$_POST["toHouseNo"],
				"ToVillageNo"=>$_POST["toVillageNo"],
				"ToSubDistrict"=>$_POST["toSubDistrict"],
				"ToDistrict"=>$_POST["toDistrict"],
				"ToProvince"=>$_POST["toProvince"],
				"VehicleType"=>$_POST["vehicleType"],
				"VehicleLicenseNo"=>$_POST["vehicleLicenseNo"],
				"Reason1"=>$reason1,
				"Reason2"=>$reason2,
				"Reason2Description"=>$_POST["reason2Desc"],
				"Source"=>"WEB",
				"CreateDate"=>date("Y-m-d H:i:s")
			));
			if($result){
				header("Location: ducument.php?idCard=".$_POST["idCard"]);
				die();
			}
		}else{
			echo "ERROR DUBLICATE";
		}
	}
  }
?>