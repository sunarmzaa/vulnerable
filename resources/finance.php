<?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  
  session_start();
  if(!isset($_SESSION["consensus"])){
  	header("Location: finance.index.php");
  	die();
  }else{
  	unset($_SESSION["consensus"]);
  }
  
  include("finance.constant.php");
  date_default_timezone_set("Asia/Bangkok");

  function PDOConnector(){
	try {
	  $conn = new PDO('mysql:host='.DB_SER.';dbname='.DB_NAME.'', DB_USR, DB_PWD);
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	  $conn->exec("set names utf8");
	  return $conn;
	}catch(PDOException $e){ return null;}
  }
  
  $conn=PDOConnector();
  
  /*$isExist=false;
  $idCard="";
  
  if(isset($_GET["idCard"])){
    if($_GET["idCard"]!=""){
		$idCard=$_GET["idCard"];
	}
  }
  
  if(isset($_POST["idCard"])){
    if($_POST["idCard"]!=""){
		$idCard=$_POST["idCard"];
	}
  }
  
  $comm="SELECT * FROM transaction WHERE IDCard='".$idCard."'";
  $query=$conn->prepare($comm); 
  $query->execute();
  if($query->rowCount()>0){
	$isExist=true;
	$transection=$query->fetch();
  }
  
  function ConvertDateToTH($current){
	$year=$current["year"]+543;
	$month=$current["mon"];
	$monthArr=Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$monthName=$monthArr[$month];
	$day=$current["mday"];
	return $day." ".$monthName." ".$year;
  }
  */
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | financial</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="bower_components/bootstrap-daterangepicker/daterangepicker.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="bower_components/select2/dist/css/select2.min.css">
  <!-- Bootstrap time Picker -->
  <link rel="stylesheet" href="plugins/timepicker/bootstrap-timepicker.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="dist/css/skins/_all-skins.min.css">

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Prompt:300,400,600,700,300italic,400italic,600italic">
  <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Sarabun:300,400,600,700,300italic,400italic,600italic">-->
  <style>
    .fontsize16px {
      font-size: 16px;
	}
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
    <nav class="navbar navbar-static-top">
    </nav>
  </header>
  <!-- Full Width Column -->
  
  <div class="content-wrapper">
    <div class="container">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>แบบแจ้งความประสงค์รับการช่วยเหลือตามมาตรการช่วยเหลือผู้ประกอบการที่ได้รับผลกระทบด้านเศรษฐกิจจากสถานการณ์การแพร่ระบาดของโรคติดเชื้อ COVID–19 ของสถาบันการเงินต่างๆ ในจังหวัดภูเก็ต
				<small style="color:Red;">
				<?php 
					//if($isExist==false){
					//	echo "ไม่ปรากฏข้อมูล รบกวนท่านโปรดลงทะเบียนใหม่อีกครั้ง";
					//}
				?>
				</small>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Default box -->
			<div class="box box-primary">
				<form id="frm" name="frm" role="form" method="POST" action="finance.process.php">
					<input type="hidden" id="isExist" name="isExist" value="<?php //echo $isExist; ?>">
					<div class="box-body">
              
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลสถานประกอบการ</u></h3>
							</div>
						</div><!-- /.row -->
		    
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เลขที่เสียภาษีนิติบุคคล</span>
									<input id="taxId" name="taxId" type="text" class="form-control" placeholder="" data-inputmask='"mask": "9999999999999"' data-mask value="<?php //echo $idCard; ?>" > <!--data-inputmask='"mask": "9999999999999"' data-mask-->
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ชื่อสถานประกอบการ</span>
									<input id="companyName" name="companyName" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["FullName"]; }?>">
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ที่ตั้งสถานประกอบการ</span><br/>
									<small>บ้านเลขที่</small>
									<input id="houseNo" name="houseNo" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["FromHouseNo"]; }?>">
								</div>
								<div class="form-group">
									<small>หมู่ที่</small>
									<input id="villageNo" name="villageNo" type="number" class="form-control" placeholder="" min="1" value="" >
								</div>
								<div class="form-group">
									<small>ถนน (หากไม่มี ให้ระบุ "-")</small>
									<input id="road" name="road" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["FromSubDistrict"]; }?>">
								</div>
								<div class="form-group">
									<small>อำเภอ / เขต</small>
									<input id="district" name="district" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["FromDistrict"]; }?>">
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px"></span><br/>
									<small>ชื่ออาคาร / หมู่บ้าน (หากไม่มี ให้ระบุ "-")</small>
									<input id="houseName" name="houseName" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
								<div class="form-group">
									<small>ตรอก / ซอย (หากไม่มี ให้ระบุ "-")</small>
									<input id="lane" name="lane" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["ToVillageNo"]; }?>">
								</div>
								<div class="form-group">
									<small>ตำบล / แขวง</small>
									<input id="subdistrict" name="subdistrict" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["ToSubDistrict"]; }?>">
								</div>
								<div class="form-group">
									<small>จังหวัด</small>
									<select id='province' name='province' class='form-control select2' style='width: 100%;'>
									<?php
										$comm="SELECT * FROM province WHERE Active=1";
										$query=$conn->prepare($comm); 
										$query->execute();
										if($query->rowCount()>0){
											while ($row = $query->fetch()) {
												//if(isset($transection) && $row["ProvinceID"]==$transection[""]){ 
												//	echo "<option value='".$row["ProvinceID"]."' selected>".$row["ProvinceNameTH"]."</option>";
												//}else{
													echo "<option value='".$row["ProvinceNameTH"]."'>".$row["ProvinceNameTH"]."</option>";
												//}
											}
										}
									?>
									</select>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ประเภทธุรกิจ</span>
									<select id='businessType' name='businessType' class='form-control select2' style='width: 100%;'>
										<option value='0' selected>เลือก</option>
										<?php
											$comm="SELECT * FROM businesstype WHERE Active=1";
											$query=$conn->prepare($comm); 
											$query->execute();
											if($query->rowCount()>0){
												while ($row = $query->fetch()) {
													//if(isset($transection) && $row["BusinessTypeName"]==$transection[""]){ 
													//	echo "<option value='".$row["BusinessTypeName"]."' selected>".$row["BusinessTypeName"]."</option>";
													//}else{
														echo "<option value='".$row["BusinessTypeName"]."'>".$row["BusinessTypeName"]."</option>";
													//}
												}
											}
										?>
									</select>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">หากเลือกประเภทธุรกิจเป็น "อื่นๆ" โปรดระบุรายละเอียด </span>
									<input id="other" name="other" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["FullName"]; }?>">
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<h3 class="box-title"><u>ข้อมูลผู้ติดต่อ</u></h3>
							</div>
							<div class="col-md-6">
								<span class="fontsize16px pull-right"><?php //echo ConvertDateToTH(getdate()); ?></span>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เลขที่ประจำตัวประชาชน</span>
									<input id="idCard" name="idCard" type="text" class="form-control" placeholder="" value="<?php //echo $idCard; ?>" data-inputmask='"mask": "9999999999999"' data-mask>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ชื่อ-นามสกุล</span>
									<input id="fullname" name="fullname" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["FullName"]; }?>">
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
			
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เบอร์โทรศัพท์ </span>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-phone"></i>
										</div>
										<input id="phone" name="phone" type="text" class="form-control" value="<?php //if(isset($transection)){ echo $transection["Phone"]; }?>" data-inputmask='"mask": "9999999999"' data-mask>
									</div>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">อีเมล</span>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-envelope"></i>
										</div>
										<input id="email" name="email" type="text" class="form-control" value="<?php //if(isset($transection)){ echo $transection["Phone"]; }?>">
									</div>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลการจ้างงานและผลกระทบ</u></h3>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">จำนวนลูกจ้าง/พนักงาน <u>ก่อน</u> การแพร่ระบาดของโรคติดเชื้อ COVID–19 (คน)</span>
									<input id="noOfEmployeeBeforeCovid" name="noOfEmployeeBeforeCovid" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["Age"]; }?>">
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">มูลค่าความเสียหาย/ผลกระทบฯ เฉลี่ยต่อเดือน (บาท)</span>
									<input id="noOfEffect" name="noOfEffect" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["VehicleLicenseNo"]; }?>">
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">จำนวนลูกจ้าง/พนักงาน <u>หลัง</u> การแพร่ระบาดของโรคติดเชื้อ COVID–19 (คน)</span>
									<input id="noOfEmployeeAfterCovid" name="noOfEmployeeAfterCovid" type="number" class="form-control" placeholder="" min="1" value="<?php if(isset($transection)){ echo $transection["Age"]; }?>">
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">จำนวนเดือนที่ความเสียหาย/ผลกระทบฯ</span>
									<input id="noOfMonth" name="noOfMonth" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["VehicleLicenseNo"]; }?>">
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลหนี้สินและแนวทางที่ให้ธนาคารดำเนินการ</u></h3>
								<small>หากท่านมีรายการหนี้สินมากกว่า 5 รายการ ให้ติดต่อเจ้าหน้าที่ได้ที่อีเมล  phuket.strategy@gmail.com</small>
								<br/><br/>
							</div><!-- /.col -->
						</div><!-- /.row -->

						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<small>รายการที่ 1 ธนาคาร/บริษัทสินเชื่อคู่สัญญาฯ </small>
									<select id='financialInstitute1' name='financialInstitute1' class='form-control select2' style='width: 100%;'>
										<option value='0' selected>เลือก</option>
										<?php
											$comm="SELECT * FROM financialinstitute WHERE Active=1";
											$query=$conn->prepare($comm); 
											$query->execute();
											if($query->rowCount()>0){
												while ($row = $query->fetch()) {
													//if(isset($transection) && $row["FinancialInstituteID"]==$transection[""]){ 
													//	echo "<option value='".$row["FinancialInstituteID"]."' selected>".$row["BusinessTypeName"]."</option>";
													//}else{
														echo "<option value='".$row["FinancialInstituteName"]."'>".$row["FinancialInstituteName"]."</option>";
													//}
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<small>สาขา</small>
								<select id='branch1' name='branch1' class='form-control select2' style='width: 100%;'>
								  <!--<option value='0' selected>เลือก</option>-->
								</select>
							  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>วงเงินที่มีกับธนาคาร (บาท)</small>
									<input id="financialAmount1" name="financialAmount1" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>แนวทางที่ท่านประสงค์ให้ธนาคารดำเนินการ</small>
									<select id='financialProcess1' name='financialProcess1' class='form-control select2' style='width: 100%;'>
										<option value='ปรับปรุงโครงสร้างหนี้' >ปรับปรุงโครงสร้างหนี้</option>
										<option value='ปรับลดอัตรดอกเบี้ย' >ปรับลดอัตรดอกเบี้ย</option>
										<option value='พักชำระเงินต้นและดอกเบี้ย' >พักชำระเงินต้นและดอกเบี้ย</option>
										<option value='พักชำระเงินต้น' >พักชำระเงินต้น</option>
										<option value='ปรับยอดผ่อนรายเดือนลง' >ปรับยอดผ่อนรายเดือนลง</option>
										<option value='ขยายเวลาชำระหนี้' >ขยายเวลาชำระหนี้</option>
										<option value='แนวทางอื่นๆ' >แนวทางอื่นๆ</option>
									</select>
								</div>
							</div>
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<small>รายการที่ 2 ธนาคาร/บริษัทสินเชื่อคู่สัญญาฯ </small>
									<select id='financialInstitute2' name='financialInstitute2' class='form-control select2' style='width: 100%;'>
										<option value='0' selected>เลือก</option>
										<?php
											$comm="SELECT * FROM financialinstitute WHERE Active=1";
											$query=$conn->prepare($comm); 
											$query->execute();
											if($query->rowCount()>0){
												while ($row = $query->fetch()) {
													//if(isset($transection) && $row["FinancialInstituteID"]==$transection[""]){ 
													//	echo "<option value='".$row["FinancialInstituteID"]."' selected>".$row["BusinessTypeName"]."</option>";
													//}else{
														echo "<option value='".$row["FinancialInstituteName"]."'>".$row["FinancialInstituteName"]."</option>";
													//}
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<small>สาขา</small>
								<select id='branch2' name='branch2' class='form-control select2' style='width: 100%;'>
								  <!--<option value='0' selected>เลือก</option>-->
								</select>
							  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>วงเงินที่มีกับธนาคาร (บาท)</small>
									<input id="financialAmount2" name="financialAmount2" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>แนวทางที่ท่านประสงค์ให้ธนาคารดำเนินการ</small>
									<select id='financialProcess2' name='financialProcess2' class='form-control select2' style='width: 100%;'>
										<option value='ปรับปรุงโครงสร้างหนี้' >ปรับปรุงโครงสร้างหนี้</option>
										<option value='ปรับลดอัตรดอกเบี้ย' >ปรับลดอัตรดอกเบี้ย</option>
										<option value='พักชำระเงินต้นและดอกเบี้ย' >พักชำระเงินต้นและดอกเบี้ย</option>
										<option value='พักชำระเงินต้น' >พักชำระเงินต้น</option>
										<option value='ปรับยอดผ่อนรายเดือนลง' >ปรับยอดผ่อนรายเดือนลง</option>
										<option value='ขยายเวลาชำระหนี้' >ขยายเวลาชำระหนี้</option>
										<option value='แนวทางอื่นๆ' >แนวทางอื่นๆ</option>
									</select>
								</div>
							</div>
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<small>รายการที่ 3 ธนาคาร/บริษัทสินเชื่อคู่สัญญาฯ </small>
									<select id='financialInstitute3' name='financialInstitute3' class='form-control select2' style='width: 100%;'>
										<option value='0' selected>เลือก</option>
										<?php
											$comm="SELECT * FROM financialinstitute WHERE Active=1";
											$query=$conn->prepare($comm); 
											$query->execute();
											if($query->rowCount()>0){
												while ($row = $query->fetch()) {
													//if(isset($transection) && $row["FinancialInstituteID"]==$transection[""]){ 
													//	echo "<option value='".$row["FinancialInstituteID"]."' selected>".$row["BusinessTypeName"]."</option>";
													//}else{
														echo "<option value='".$row["FinancialInstituteName"]."'>".$row["FinancialInstituteName"]."</option>";
													//}
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<small>สาขา</small>
								<select id='branch3' name='branch3' class='form-control select2' style='width: 100%;'>
								  <!--<option value='0' selected>เลือก</option>-->
								</select>
							  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>วงเงินที่มีกับธนาคาร (บาท)</small>
									<input id="financialAmount3" name="financialAmount3" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>แนวทางที่ท่านประสงค์ให้ธนาคารดำเนินการ</small>
									<select id='financialProcess3' name='financialProcess3' class='form-control select2' style='width: 100%;'>
										<option value='ปรับปรุงโครงสร้างหนี้' >ปรับปรุงโครงสร้างหนี้</option>
										<option value='ปรับลดอัตรดอกเบี้ย' >ปรับลดอัตรดอกเบี้ย</option>
										<option value='พักชำระเงินต้นและดอกเบี้ย' >พักชำระเงินต้นและดอกเบี้ย</option>
										<option value='พักชำระเงินต้น' >พักชำระเงินต้น</option>
										<option value='ปรับยอดผ่อนรายเดือนลง' >ปรับยอดผ่อนรายเดือนลง</option>
										<option value='ขยายเวลาชำระหนี้' >ขยายเวลาชำระหนี้</option>
										<option value='แนวทางอื่นๆ' >แนวทางอื่นๆ</option>
									</select>
								</div>
							</div>
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<small>รายการที่ 4 ธนาคาร/บริษัทสินเชื่อคู่สัญญาฯ </small>
									<select id='financialInstitute4' name='financialInstitute4' class='form-control select2' style='width: 100%;'>
										<option value='0' selected>เลือก</option>
										<?php
											$comm="SELECT * FROM financialinstitute WHERE Active=1";
											$query=$conn->prepare($comm); 
											$query->execute();
											if($query->rowCount()>0){
												while ($row = $query->fetch()) {
													//if(isset($transection) && $row["FinancialInstituteID"]==$transection[""]){ 
													//	echo "<option value='".$row["FinancialInstituteID"]."' selected>".$row["BusinessTypeName"]."</option>";
													//}else{
														echo "<option value='".$row["FinancialInstituteName"]."'>".$row["FinancialInstituteName"]."</option>";
													//}
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<small>สาขา</small>
								<select id='branch4' name='branch4' class='form-control select2' style='width: 100%;'>
								  <!--<option value='0' selected>เลือก</option>-->
								</select>
							  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>วงเเงินที่มีกับธนาคาร (บาท)</small>
									<input id="financialAmount4" name="financialAmount4" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>แนวทางที่ท่านประสงค์ให้ธนาคารดำเนินการ</small>
									<select id='financialProcess4' name='financialProcess4' class='form-control select2' style='width: 100%;'>
										<option value='ปรับปรุงโครงสร้างหนี้' >ปรับปรุงโครงสร้างหนี้</option>
										<option value='ปรับลดอัตรดอกเบี้ย' >ปรับลดอัตรดอกเบี้ย</option>
										<option value='พักชำระเงินต้นและดอกเบี้ย' >พักชำระเงินต้นและดอกเบี้ย</option>
										<option value='พักชำระเงินต้น' >พักชำระเงินต้น</option>
										<option value='ปรับยอดผ่อนรายเดือนลง' >ปรับยอดผ่อนรายเดือนลง</option>
										<option value='ขยายเวลาชำระหนี้' >ขยายเวลาชำระหนี้</option>
										<option value='แนวทางอื่นๆ' >แนวทางอื่นๆ</option>
									</select>
								</div>
							</div>
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<small>รายการที่ 5 ธนาคาร/บริษัทสินเชื่อคู่สัญญาฯ </small>
									<select id='financialInstitute5' name='financialInstitute5' class='form-control select2' style='width: 100%;'>
										<option value='0' selected>เลือก</option>
										<?php
											$comm="SELECT * FROM financialinstitute WHERE Active=1";
											$query=$conn->prepare($comm); 
											$query->execute();
											if($query->rowCount()>0){
												while ($row = $query->fetch()) {
													//if(isset($transection) && $row["FinancialInstituteID"]==$transection[""]){ 
													//	echo "<option value='".$row["FinancialInstituteID"]."' selected>".$row["BusinessTypeName"]."</option>";
													//}else{
														echo "<option value='".$row["FinancialInstituteName"]."'>".$row["FinancialInstituteName"]."</option>";
													//}
												}
											}
										?>
									</select>
								</div>
							</div>
							<div class="col-md-3">
							  <div class="form-group">
								<small>สาขา</small>
								<select id='branch5' name='branch5' class='form-control select2' style='width: 100%;'>
								  <!--<option value='0' selected>เลือก</option>-->
								</select>
							  </div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>วงเงินที่มีกับธนาคาร (บาท)</small>
									<input id="financialAmount5" name="financialAmount5" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
							</div>
							<div class="col-md-3">
								<div class="form-group">
									<small>แนวทางที่ท่านประสงค์ให้ธนาคารดำเนินการ</small>
									<select id='financialProcess5' name='financialProcess5' class='form-control select2' style='width: 100%;'>
										<option value='ปรับปรุงโครงสร้างหนี้' >ปรับปรุงโครงสร้างหนี้</option>
										<option value='ปรับลดอัตรดอกเบี้ย' >ปรับลดอัตรดอกเบี้ย</option>
										<option value='พักชำระเงินต้นและดอกเบี้ย' >พักชำระเงินต้นและดอกเบี้ย</option>
										<option value='พักชำระเงินต้น' >พักชำระเงินต้น</option>
										<option value='ปรับยอดผ่อนรายเดือนลง' >ปรับยอดผ่อนรายเดือนลง</option>
										<option value='ขยายเวลาชำระหนี้' >ขยายเวลาชำระหนี้</option>
										<option value='แนวทางอื่นๆ' >แนวทางอื่นๆ</option>
									</select>
								</div>
							</div>
						</div><!-- /.row -->
						
						<hr/>
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<small>ต้องการเงินทุนหมุนเวียนหรือไม่</small>
									<select id='isSoftloan' name='isSoftloan' class='form-control select2' style='width: 100%;'>
										<option value='ไม่ต้องการ' >ไม่ต้องการ</option>
										<option value='ต้องการ' >ต้องการ</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<small>วงเงินที่ต้องการ (บาท)</small>
									<input id="softloanAmount" name="softloanAmount" type="number" class="form-control" placeholder="" min="1" value="<?php //if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
								</div>
							</div>
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<small>ต้องการเงินทุนฟื้นฟูกิจการหรือไม่</small>
									<select id='isRecoverloan' name='isRecoverloan' class='form-control select2' style='width: 100%;'>
										<option value='ไม่ต้องการ' >ไม่ต้องการ</option>
										<option value='ต้องการ' >ต้องการ</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<small>วงเงินที่ต้องการ (บาท)</small>
									<input id="recoverloanAmount" name="recoverloanAmount" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
								</div>
							</div>
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลประวัติการชำระเงิน (ณ วันที่ทำรายการ นับรายการที่มีการผิดนัดชำระยาวนานที่สุด) </u></h3>
							</div>
							<div class="col-md-4">
								<select id='duePayment' name='duePayment' class='form-control select2' style='width: 100%;'>
									<option value='ไม่เคยผิดชำระ' >ไม่เคยผิดชำระ</option>
									<option value='เคยผิดชำระ เป็นระยะเวลา 30 วัน' >เคยผิดชำระ เป็นระยะเวลา 30 วัน</option>
									<option value='เคยผิดชำระ เป็นระยะเวลา 60 วัน' >เคยผิดชำระ เป็นระยะเวลา 60 วัน</option>
									<option value='เคยผิดชำระ เป็นระยะเวลา 90 วัน' >เคยผิดชำระ เป็นระยะเวลา 90 วัน</option>
									<option value='เคยผิดชำระ เป็นระยะเวลา 120 วัน' >เคยผิดชำระ เป็นระยะเวลา 120 วัน</option>
								</select><br>
							</div>
						</div>

					</div><!-- /.box-body -->
            
					<div class="box-footer">
						<div class="form-inline">
							<?php //if(isset($transection)){ ?>
								<!--<a href="ducument.php?idCard=<?php //echo $idCard; ?>" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-file" ></i> หนังสือรับรองฯ</a>-->
							<?php //} ?>
							<button id="submit" name="submit" type="submit" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-save"></i> <?php //if(isset($transection)){ echo "ปรับปรุงข้อมูล"; } else { echo "ลงทะเบียน";}?>บันทึกข้อมูล</button>
							<!--<a href="index.php" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-undo" ></i> ย้อนกลับ</a>-->
							<br/>
						</div>
					</div><!-- /.box-footer-->
				</form>
			</div><!-- /.box -->
		</section><!-- /.content -->
    </div><!-- /.container -->
  </div><!-- /.content-wrapper -->
  <?php include "footer.php"; ?>
</div><!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- Select2 -->
<script src="bower_components/select2/dist/js/select2.full.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>
<!-- date-range-picker -->
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js"></script>
<!-- bootstrap time picker -->
<script src="plugins/timepicker/bootstrap-timepicker.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<!-- Page script -->
<script>
  $(document).ready(function () {

    $('[data-mask]').inputmask();
	
	$('#financialInstitute1').change(function() {
	  var branch=$('#branch1').empty();
	  if($('#financialInstitute1').children("option:selected").val()!=='0'){
	    $.ajax({url : 'finance.data4.php?financeId='+$('#financialInstitute1').children("option:selected").val(),
       	  type : 'POST',
		  //data : 'financeId='+$('#financialInstitute1').children("option:selected").val(),
          datatype : 'json',
          success : function(result){
            var obj=jQuery.parseJSON(result);
			var opt='';
			//var opt='<option value="0" selected>เลือก</option>';
            $.each(obj,function(key,val){
			  //alert(val.BranchName);
              opt+="<option value='"+val.BranchName+"'>"+val.BranchName+"</option>";
            });
            branch.html(opt);
          }
        });
	  }
	});
	
	$('#financialInstitute2').change(function() {
	  var branch=$('#branch2').empty();
	  if($('#financialInstitute2').children("option:selected").val()!=='0'){
	    $.ajax({url : 'finance.data4.php?financeId='+$('#financialInstitute2').children("option:selected").val(),
       	  type : 'POST',
		  //data : 'financeId='+$('#financialInstitute1').children("option:selected").val(),
          datatype : 'json',
          success : function(result){
            var obj=jQuery.parseJSON(result);
			var opt='';
			//var opt='<option value="0" selected>เลือก</option>';
            $.each(obj,function(key,val){
			  //alert(val.BranchName);
              opt+="<option value='"+val.BranchName+"'>"+val.BranchName+"</option>";
            });
            branch.html(opt);
          }
        });
	  }
	});
	
	$('#financialInstitute3').change(function() {
	  var branch=$('#branch3').empty();
	  if($('#financialInstitute3').children("option:selected").val()!=='0'){
	    $.ajax({url : 'finance.data4.php?financeId='+$('#financialInstitute3').children("option:selected").val(),
       	  type : 'POST',
		  //data : 'financeId='+$('#financialInstitute1').children("option:selected").val(),
          datatype : 'json',
          success : function(result){
            var obj=jQuery.parseJSON(result);
			var opt='';
			//var opt='<option value="0" selected>เลือก</option>';
            $.each(obj,function(key,val){
			  //alert(val.BranchName);
              opt+="<option value='"+val.BranchName+"'>"+val.BranchName+"</option>";
            });
            branch.html(opt);
          }
        });
	  }
	});
	
	$('#financialInstitute4').change(function() {
	  var branch=$('#branch4').empty();
	  if($('#financialInstitute4').children("option:selected").val()!=='0'){
	    $.ajax({url : 'finance.data4.php?financeId='+$('#financialInstitute4').children("option:selected").val(),
       	  type : 'POST',
		  //data : 'financeId='+$('#financialInstitute1').children("option:selected").val(),
          datatype : 'json',
          success : function(result){
            var obj=jQuery.parseJSON(result);
			var opt='';
			//var opt='<option value="0" selected>เลือก</option>';
            $.each(obj,function(key,val){
			  //alert(val.BranchName);
              opt+="<option value='"+val.BranchName+"'>"+val.BranchName+"</option>";
            });
            branch.html(opt);
          }
        });
	  }
	});
	
	$('#financialInstitute5').change(function() {
	  var branch=$('#branch5').empty();
	  if($('#financialInstitute5').children("option:selected").val()!=='0'){
	    $.ajax({url : 'finance.data4.php?financeId='+$('#financialInstitute5').children("option:selected").val(),
       	  type : 'POST',
		  //data : 'financeId='+$('#financialInstitute1').children("option:selected").val(),
          datatype : 'json',
          success : function(result){
            var obj=jQuery.parseJSON(result);
			var opt='';
			//var opt='<option value="0" selected>เลือก</option>';
            $.each(obj,function(key,val){
			  //alert(val.BranchName);
              opt+="<option value='"+val.BranchName+"'>"+val.BranchName+"</option>";
            });
            branch.html(opt);
          }
        });
	  }
	});
	
	$.validator.addMethod("isHouseNo", function(value, element) {
      if($('#houseNo').val().match(/^[0-9\.\-\/]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลขและเครื่องหมาย / เท่านั้น");
	
	$.validator.addMethod("isSelectedBussinessType", function(value, element) {
      if($('#businessType').children("option:selected").val()!="0") { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเลือกประเภทธุรกิจ");
	
	$.validator.addMethod("isSelectedBussinessTypeOther", function(value, element) {
      if($('#businessType').children("option:selected").val()!="อื่นๆ") {
        return true;
      }else{
		if($('#other').val()!=""){
			return true;
		}else{
			return false;
		}
      }
    }, "กรอกระบุประเภทธุรกิจ");
	
	$.validator.addMethod("financialInstitute1", function(value, element) {
      if($('#financialInstitute1').children("option:selected").val()=="0") {
        return true;
      }else{
	  	if($('#financialAmount1').val()!=""){
	 		return true;
		}else{
			return false;
		}
	  }
    }, "กรอกระบุวงเงินที่มีกับธนาคาร");
	
	$.validator.addMethod("financialInstitute2", function(value, element) {
      if($('#financialInstitute2').children("option:selected").val()=="0") {
        return true;
      }else{
	  	if($('#financialAmount2').val()!=""){
	 		return true;
		}else{
			return false;
		}
	  }
    }, "กรอกระบุวงเงินที่มีกับธนาคาร");
	
	$.validator.addMethod("financialInstitute3", function(value, element) {
      if($('#financialInstitute3').children("option:selected").val()=="0") {
        return true;
      }else{
	  	if($('#financialAmount3').val()!=""){
	 		return true;
		}else{
			return false;
		}
	  }
    }, "กรอกระบุวงเงินที่มีกับธนาคาร");
	
	$.validator.addMethod("financialInstitute4", function(value, element) {
      if($('#financialInstitute4').children("option:selected").val()=="0") {
        return true;
      }else{
	  	if($('#financialAmount4').val()!=""){
	 		return true;
		}else{
			return false;
		}
	  }
    }, "กรอกระบุวงเงินที่มีกับธนาคาร");
	
	$.validator.addMethod("financialInstitute5", function(value, element) {
      if($('#financialInstitute5').children("option:selected").val()=="0") {
        return true;
      }else{
	  	if($('#financialAmount5').val()!=""){
	 		return true;
		}else{
			return false;
		}
	  }
    }, "กรอกระบุวงเงินที่มีกับธนาคาร");
	
	$.validator.addMethod("softloan", function(value, element) {
      if($('#isSoftloan').children("option:selected").val()=="ไม่ต้องการ") {
        return true;
      }else{
	  	if($('#softloanAmount').val()!=""){
	 		return true;
		}else{
			return false;
		}
	 }
    }, "กรอกระบุวงเงินที่ต้องการ ");
	
	$.validator.addMethod("recoverloan", function(value, element) {
      if($('#isRecoverloan').children("option:selected").val()=="ไม่ต้องการ") {
        return true;
      }else{
	  	if($('#recoverloanAmount').val()!=""){
	 		return true;
		}else{
			return false;
		}
	 }
    }, "กรอกระบุวงเงินที่ต้องการ ");
    
    $('#frm').validate({
      
      rules: {
        taxId: {
          required: true
        },
        companyName: {
          required: true
        },
		houseNo: {
          required: true,
		  isHouseNo: true,
        },
		houseName: {
		  required: true
		},
		villageNo: {
		  required: true
		},
        lane: {
          required: true
        },
        road: {
          required: true
        },
        subdistrict: {
          required: true
        },
        district: {
          required: true
        },
        businessType: {
          isSelectedBussinessType: true
        },
        other: {
          isSelectedBussinessTypeOther: true
        },
		idCard: {
          required: true
        },
        fullname: {
          required: true
        },
        phone: {
          required: true
        },
		email: {
          required: true,
		  email: true
        },
		noOfEmployeeBeforeCovid: {
          required: true
        },
		noOfEmployeeAfterCovid: {
          required: true
        },
		noOfEffect: {
          required: true
        },
		noOfMonth: {
          required: true
        },
		financialAmount1: {
		  financialInstitute1: true
        },
		financialAmount2: {
		  financialInstitute2: true
        },
		financialAmount3: {
		  financialInstitute3: true
        },
		financialAmount4: {
		  financialInstitute4: true
        },
		financialAmount5: {
		  financialInstitute5: true
        },
		softloanAmount: {
		  softloan: true
		},
		recoverloanAmount: {
		  recoverloan: true
		}
      },
      
      messages: {
        taxId: {
          required: "กรอกเลขที่เสียภาษีนิติบุคคล"
        },
        companyName: {
          required: "กรอกชื่อสถานประกอบการ"
        },
		houseNo: {
          required: "กรอกบ้านเลขที่"
        },
		houseName: {
          required: "กรอกชื่ออาคาร / หมู่บ้าน"
        },
		villageNo: {
		  required: "กรอกหมู่ที่"
		},
        lane: {
          required: "กรอกตรอก / ซอย"
        },
        road: {
          required: "กรอกถนน"
        },
        subdistrict: {
          required: "กรอกตำบล / แขวง"
        },
        district: {
          required: "กรอกอำเภอ / เขต"
        },
		idCard: {
          required: "กรอกเลขที่ประจำตัวประชาชน"
        },
        fullname: {
          required: "กรอกชื่อ-นามสกุล"
        },
        phone: {
          required: "กรอกเบอร์โทรศัพท์"
        },
        email: {
          required: "กรอกอีเมล",
		  email: "กรอกอีเมลให้ถูกต้อง"
        },
        noOfEmployeeBeforeCovid: {
          required: "กรอกจำนวนลูกจ้าง/พนักงาน ก่อน การแพร่ระบาดของโรคติดเชื้อ COVID–19"
        },
		noOfEmployeeAfterCovid: {
          required: "กรอกจำนวนลูกจ้าง/พนักงาน หลัง การแพร่ระบาดของโรคติดเชื้อ COVID–19"
        },
		noOfEffect: {
          required: "กรอกมูลค่าความเสียหาย/ผลกระทบฯ เฉลี่ยต่อเดือน "
        },
		noOfMonth: {
          required: "กรอกจำนวนเดือนที่ความเสียหาย/ผลกระทบฯ"
        },
	  },

	  highlight: function(element) {
        $(element).closest('.form-group').addClass('has-error');
      },
    
      unhighlight: function(element) {
        $(element).closest('.form-group').removeClass('has-error');
      },

      errorElement: 'span',
      errorClass: 'help-block',
      errorPlacement: function(error, element) {
        if(element.parent('.input-group').length) {
          error.insertAfter(element.parent());
        }else{
          error.insertAfter(element);
        }
      }
	  
    })
	
	$('#financialInstitute1').change(function(){
        //var selected = $(this).children("option:selected").val();
        //alert(selected);
    });
  })
  
</script>
</body>
</html>
