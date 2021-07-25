<?php
  //ini_set('display_startup_errors', 1);
  //ini_set('display_errors', 1);
  //error_reporting(-1);
  
  session_start();
  
  include("finance.constant.php");
  date_default_timezone_set("Asia/Bangkok");
  
  if(!isset($_SESSION["AUTHEN"]["USER_ID"]) || $_SESSION["AUTHEN"]["GROUP"]!="Administrator"){
    header("Location: finance.login.php");
    die(); 
  }
  
  if(!isset($_GET["id"])){
    header("Location: finance.login.php");
    die(); 
  }else{
	$id=$_GET["id"];
  }
  
  function PDOConnector(){
	try {
	  $conn = new PDO('mysql:host='.DB_SER.';dbname='.DB_NAME.'', DB_USR, DB_PWD);
	  $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
	  $conn->exec("set names utf8");
	  return $conn;
	}catch(PDOException $e){ return null;}
  }
  
  $conn=PDOConnector();
  
  $comm="SELECT * FROM transection WHERE TransectionID=".$id;
  $query=$conn->prepare($comm); 
  $query->execute();
	
  if($query->rowCount()>0){
     $row=$query->fetch();
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
  
  /*
  if (isset($_POST['submit1'])){
    $financeListId= explode(",", $_POST['financeListId']);
	if(count($financeListId)>0){
		for($i=0; $i<count($financeListId); $i++){
			
			$comment="";
			if($_POST['previousComment'.$financeListId[$i]]==""){
				$comment=date("Y-m-d H:i:s")."<br/>".$_POST['mgs'.$financeListId[$i]];
			}else{
				$comment=$_POST['previousComment'.$financeListId[$i]]."<br/>--------------------<br/>".date("Y-m-d H:i:s")."<br/>".$_POST['mgs'.$financeListId[$i]];
			}
			
			//echo $_POST['status'.$financeListId[$i]]."<br/>";
			//echo ConvertDateToMySQLDate($_POST['duedate'.$financeListId[$i]])."<br/>";
			//echo $comment;
			
			$comm="UPDATE transection SET ";
			$comm.="FinancialStatus".$financeListId[$i]."=:FinancialStatus".$financeListId[$i].", ";
			$comm.="FinancialDueDate".$financeListId[$i]."=:FinancialDueDate".$financeListId[$i].", ";
			$comm.="FinancialComment".$financeListId[$i]."=:FinancialComment".$financeListId[$i]." ";
			$comm.="WHERE TransectionID=:TransectionID";
			
			$query=$conn->prepare($comm);
			
			$result=$query->execute(array(
					"FinancialStatus".$financeListId[$i]=>$_POST['status'.$financeListId[$i]],
					"FinancialDueDate".$financeListId[$i]=>ConvertDateToMySQLDate($_POST['duedate'.$financeListId[$i]]),	
					"FinancialComment".$financeListId[$i]=>$comment,	
					"TransectionID"=>$_GET["id"]
			));
		}
		header("Location: finance.result.php?action=finance&result=1");
		die();
	}
  }*/
  
  function ConvertDateToMySQLDate($selected){
    list($day, $month, $year)=explode('/', $selected);
	return $year."-".$month."-".$day;
  }
  
  if (isset($_POST['submit2'])){
	echo "Submit2";
  }
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
			<h1>แบบแจ้งความประสงค์รับการช่วยเหลือตามมาตรการช่วยเหลือลูกค้าที่ได้รับผลกระทบจากสภาวะเศรษฐกิจ สำหรับการแพร่ระบาดของโรคติดเชื้อ COVID–19 ของธนาคารต่างๆ ในจังหวัดภูเก็ต
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
					<div class="box-body">
						<form id="frm1" name="frm1" role="form" method="POST" action="">
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลสถานประกอบการ</u></h3>
							</div>
						</div><!-- /.row -->
		    
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เลขที่เสียภาษีนิติบุคคล</span>
									<input id="taxId" name="taxId" type="text" class="form-control" placeholder="" data-inputmask='"mask": "9999999999999"' data-mask value="<?php echo $row["TaxID"]; ?>" disabled>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ชื่อสถานประกอบการ</span>
									<input id="companyName" name="companyName" type="text" class="form-control" placeholder="" value="<?php echo $row["CompanyName"]; ?>" disabled>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ที่ตั้งสถานประกอบการ</span><br/>
									<small>บ้านเลขที่</small>
									<input id="houseNo" name="houseNo" type="text" class="form-control" placeholder="" value="<?php echo $row["HouseNo"]?>" disabled>
								</div>
								<div class="form-group">
									<small>หมู่ที่</small>
									<input id="villageNo" name="villageNo" type="number" class="form-control" placeholder="" min="1" value="<?php echo $row["VillageNo"]?>" disabled>
								</div>
								<div class="form-group">
									<small>ถนน (หากไม่มี ให้ระบุ "-")</small>
									<input id="road" name="road" type="text" class="form-control" placeholder="" value="<?php echo $row["Road"]; ?>" disabled>
								</div>
								<div class="form-group">
									<small>อำเภอ / เขต</small>
									<input id="district" name="district" type="text" class="form-control" placeholder="" value="<?php echo $row["District"]; ?>" disabled>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px"></span><br/>
									<small>ชื่ออาคาร / หมู่บ้าน (หากไม่มี ให้ระบุ "-")</small>
									<input id="houseName" name="houseName" type="text" class="form-control" placeholder="" value="<?php echo $row["HouseName"]; ?>" disabled>
								</div>
								<div class="form-group">
									<small>ตรอก / ซอย (หากไม่มี ให้ระบุ "-")</small>
									<input id="lane" name="lane" type="text" class="form-control" placeholder="" value="<?php echo $row["Lane"]; ?>" disabled>
								</div>
								<div class="form-group">
									<small>ตำบล / แขวง</small>
									<input id="subdistrict" name="subdistrict" type="text" class="form-control" placeholder="" value="<?php echo $row["Subdistrict"]; ?>" disabled>
								</div>
								<div class="form-group">
									<small>จังหวัด</small>
									<select id='province' name='province' class='form-control select2' style='width: 100%;' disabled>
									<?php
										$comm="SELECT * FROM province WHERE Active=1";
										$query=$conn->prepare($comm); 
										$query->execute();
										if($query->rowCount()>0){
											while ($rowProvince = $query->fetch()) {
												if($rowProvince["ProvinceNameTH"]==$row["Province"]){ 
													echo "<option value='".$rowProvince["ProvinceNameTH"]."' selected>".$rowProvince["ProvinceNameTH"]."</option>";
												}else{
													echo "<option value='".$rowProvince["ProvinceNameTH"]."'>".$rowProvince["ProvinceNameTH"]."</option>";
												}
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
									<select id='businessType' name='businessType' class='form-control select2' style='width: 100%;' disabled>
										<option value='0' selected>เลือก</option>
										<?php
											$comm="SELECT * FROM businesstype WHERE Active=1";
											$query=$conn->prepare($comm); 
											$query->execute();
											if($query->rowCount()>0){
												while ($rowBusiness = $query->fetch()) {
													if($rowBusiness["BusinessTypeName"]==$row["BusinessType"]){ 
														echo "<option value='".$rowBusiness["BusinessTypeName"]."' selected>".$rowBusiness["BusinessTypeName"]."</option>";
													}else{
														echo "<option value='".$rowBusiness["BusinessTypeName"]."'>".$rowBusiness["BusinessTypeName"]."</option>";
													}
												}
											}
										?>
									</select>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">หากเลือกประเภทธุรกิจเป็น "อื่นๆ" โปรดระบุรายละเอียด </span>
									<input id="other" name="other" type="text" class="form-control" placeholder="" value="<?php echo $row["BusinessTypeOther"]; ?>" disabled>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<h3 class="box-title"><u>ข้อมูลผู้ติดต่อ</u></h3>
							</div>
							<div class="col-md-6">
								<span class="fontsize16px pull-right"></span>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เลขที่ประจำตัวประชาชน</span>
									<input id="idCard" name="idCard" type="text" class="form-control" placeholder="" value="<?php echo $row["IDCard"]; ?>" data-inputmask='"mask": "9999999999999"' data-mask disabled>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ชื่อ-นามสกุล</span>
									<input id="fullname" name="fullname" type="text" class="form-control" placeholder="" value="<?php echo $row["ContactName"]; ?>" disabled>
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
										<input id="phone" name="phone" type="text" class="form-control" value="<?php echo $row["Phone"]; ?>" data-inputmask='"mask": "9999999999"' data-mask disabled>
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
										<input id="email" name="email" type="text" class="form-control" value="<?php echo $row["Email"]; ?>" disabled>
									</div>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลการจ้างงานและผลกระทบ</u></h3>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">จำนวนลูกจ้าง/พนักงาน <u>ก่อน</u> การแพร่ระบาดของโรคติดเชื้อ COVID–19 (คน)</span>
									<input id="noOfEmployeeBeforeCovid" name="noOfEmployeeBeforeCovid" type="number" class="form-control" placeholder="" min="1" value="<?php echo $row["EmployeeBefore"]; ?>" disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">มูลค่าความเสียหาย/ผลกระทบฯ เฉลี่ยต่อเดือน (บาท)</span>
									<input id="noOfEffect" name="noOfEffect" type="number" class="form-control" placeholder="" min="1" value="<?php echo $row["Effect"]; ?>" disabled>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">จำนวนลูกจ้าง/พนักงาน <u>หลัง</u> การแพร่ระบาดของโรคติดเชื้อ COVID–19 (คน)</span>
									<input id="noOfEmployeeAfterCovid" name="noOfEmployeeAfterCovid" type="number" class="form-control" placeholder="" min="1" value="<?php echo $row["EmployeeAfter"]; ?>" disabled>
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">จำนวนเดือนที่ความเสียหาย/ผลกระทบฯ</span>
									<input id="noOfMonth" name="noOfMonth" type="number" class="form-control" placeholder="" min="1" value="<?php echo $row["Month"]; ?>" disabled>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลหนี้สินและแนวทางที่ให้ธนาคารดำเนินการ</u></h3>
								<!--<small>หากท่านมีรายการหนี้สินมากกว่า 5 รายการ ให้ติดต่อเจ้าหน้าที่ได้ที่อีเมล  phuket.strategy@gmail.com</small>
								<br/><br/>-->
							</div>
						</div>

						<div class="row">
							<div class="col-md-12">
								<table id="example1" class="table table-bordered table-striped">
									<thead>
									  <tr>
										<th>รายการข้อมูล</th>
										<th>สถานะ</th>
										<th>กำหนดแล้วเสร็จ</th>
										<th>สถานะการติดตาม</th>
									  </tr>
									</thead>
									<tbody>
									
									  <?php if($row["FinancialInstitute1"]!="") {?>
									  <tr>
									    <td>
									      <?php echo "ข้อมูลหนี้สินกับ  <u>".$row["FinancialInstitute1"]."</u>  <br/>วงเงิน  <u>-</u> บาท <br/>แจ้งความประสงค์ขอ  <u>".$row["FinancialProcess1"]."</u>"; ?>
										  <?php 
											if($row["FinancialComment1"]!=""){
											  echo "<br/><br/><u>ประวัติการดำเนินการ</u><br/>";
											  echo $row["FinancialComment1"];
											}
										  ?>
										</td>
										<td>
										  <?php
										    if($row["FinancialStatus1"]==""){
											  echo "รอดำเนินการ";
											}else{
											  echo $row["FinancialStatus1"];
											}
										  ?>
										</td>
										<td>
										  <?php
											if($row["FinancialDueDate1"]==""){ 
											  $dueDate1=new DateTime($row["CreateDate"]);
											  $dueDate1=$dueDate1->modify('+3 day');
											  $dueDate1=date_format($dueDate1, 'd/m/Y');
											}else{
											  $dueDate1=date_format(new DateTime($row["FinancialDueDate1"]), 'd/m/Y');
											}
											echo $dueDate1;
										  ?>
										</td>
										<td>
										  <?php 
											if($row["FinancialDueDate1"]==""){ 
											  $dueDate1=new DateTime($row["CreateDate"]);
											  $dueDate1=$dueDate1->modify('+3 day');
											}else{
											  $dueDate1=new DateTime($row["FinancialDueDate1"]);
											}
											$currenDate=new DateTime();
											
											//echo $dueDate1->format('Y-m-d H:i:s')."<br/>";
											//echo $currenDate->format('Y-m-d H:i:s')."<br/>";
											
											if($currenDate>$dueDate1){
												echo "ติดตามสถาบันการเงินฯ";
											}else{
												echo "ปกติ";
											}
										  ?>
										</td>
									  </tr>
									  <?php } ?>
									  
									  <?php if($row["FinancialInstitute2"]!="") {?>
									  <tr>
									    <td>
									      <?php echo "ข้อมูลหนี้สินกับ  <u>".$row["FinancialInstitute2"]."</u>  <br/>วงเงิน  <u>-</u> บาท <br/>แจ้งความประสงค์ขอ  <u>".$row["FinancialProcess2"]."</u>"; ?>
										  <?php 
											if($row["FinancialComment2"]!=""){
											  echo "<br/><br/><u>ประวัติการดำเนินการ</u><br/>";
											  echo $row["FinancialComment2"];
											}
										  ?>
										</td>
										<td>
										  <?php
										    if($row["FinancialStatus2"]==""){
											  echo "รอดำเนินการ";
											}else{
											  echo $row["FinancialStatus2"];
											}
										  ?>
										</td>
										<td>
										  <?php
											if($row["FinancialDueDate2"]==""){ 
											  $dueDate2=new DateTime($row["CreateDate"]);
											  $dueDate2=$dueDate2->modify('+3 day');
											  $dueDate2=date_format($dueDate2, 'd/m/Y');
											}else{
											  $dueDate2=date_format(new DateTime($row["FinancialDueDate2"]), 'd/m/Y');
											}
											echo $dueDate2;
										  ?>
										</td>
										<td>
										  <?php 
											if($row["FinancialDueDate2"]==""){ 
											  $dueDate2=new DateTime($row["CreateDate"]);
											  $dueDate2=$dueDate2->modify('+3 day');
											}else{
											  $dueDate2=new DateTime($row["FinancialDueDate2"]);
											}
											$currenDate=new DateTime();
											
											//echo $dueDate2->format('Y-m-d H:i:s')."<br/>";
											//echo $currenDate->format('Y-m-d H:i:s')."<br/>";
											
											if($currenDate>$dueDate2){
												echo "ติดตามสถาบันการเงินฯ";
											}else{
												echo "ปกติ";
											}
										  ?>
										</td>
									  </tr>
									  <?php } ?>
									  
									  <?php if($row["FinancialInstitute3"]!="") {?>
									  <tr>
									    <td>
									      <?php echo "ข้อมูลหนี้สินกับ  <u>".$row["FinancialInstitute3"]."</u>  <br/>วงเงิน  <u>-</u> บาท <br/>แจ้งความประสงค์ขอ  <u>".$row["FinancialProcess3"]."</u>"; ?>
										  <?php 
											if($row["FinancialComment3"]!=""){
											  echo "<br/><br/><u>ประวัติการดำเนินการ</u><br/>";
											  echo $row["FinancialComment3"];
											}
										  ?>
										</td>
										<td>
										  <?php
										    if($row["FinancialStatus3"]==""){
											  echo "รอดำเนินการ";
											}else{
											  echo $row["FinancialStatus3"];
											}
										  ?>
										</td>
										<td>
										  <?php
											if($row["FinancialDueDate3"]==""){ 
											  $dueDate3=new DateTime($row["CreateDate"]);
											  $dueDate3=$dueDate3->modify('+3 day');
											  $dueDate3=date_format($dueDate3, 'd/m/Y');
											}else{
											  $dueDate3=date_format(new DateTime($row["FinancialDueDate3"]), 'd/m/Y');
											}
											echo $dueDate3;
										  ?>
										</td>
										<td>
										  <?php 
											if($row["FinancialDueDate3"]==""){ 
											  $dueDate3=new DateTime($row["CreateDate"]);
											  $dueDate3=$dueDate3->modify('+3 day');
											}else{
											  $dueDate3=new DateTime($row["FinancialDueDate3"]);
											}
											$currenDate=new DateTime();
											
											//echo $dueDate3->format('Y-m-d H:i:s')."<br/>";
											//echo $currenDate->format('Y-m-d H:i:s')."<br/>";
											
											if($currenDate>$dueDate3){
												echo "ติดตามสถาบันการเงินฯ";
											}else{
												echo "ปกติ";
											}
										  ?>
										</td>
									  </tr>
									  <?php } ?>
									  
									  <?php if($row["FinancialInstitute4"]!="") {?>
									  <tr>
									    <td>
									      <?php echo "ข้อมูลหนี้สินกับ  <u>".$row["FinancialInstitute4"]."</u>  <br/>วงเงิน  <u>-</u> บาท <br/>แจ้งความประสงค์ขอ  <u>".$row["FinancialProcess4"]."</u>"; ?>
										  <?php 
											if($row["FinancialComment4"]!=""){
											  echo "<br/><br/><u>ประวัติการดำเนินการ</u><br/>";
											  echo $row["FinancialComment4"];
											}
										  ?>
										</td>
										<td>
										  <?php
										    if($row["FinancialStatus4"]==""){
											  echo "รอดำเนินการ";
											}else{
											  echo $row["FinancialStatus4"];
											}
										  ?>
										</td>
										<td>
										  <?php
											if($row["FinancialDueDate4"]==""){ 
											  $dueDate4=new DateTime($row["CreateDate"]);
											  $dueDate4=$dueDate4->modify('+3 day');
											  $dueDate4=date_format($dueDate4, 'd/m/Y');
											}else{
											  $dueDate4=date_format(new DateTime($row["FinancialDueDate4"]), 'd/m/Y');
											}
											echo $dueDate4;
										  ?>
										</td>
										<td>
										  <?php 
											if($row["FinancialDueDate4"]==""){ 
											  $dueDate4=new DateTime($row["CreateDate"]);
											  $dueDate4=$dueDate4->modify('+3 day');
											}else{
											  $dueDate4=new DateTime($row["FinancialDueDate4"]);
											}
											$currenDate=new DateTime();
											
											//echo $dueDate4->format('Y-m-d H:i:s')."<br/>";
											//echo $currenDate->format('Y-m-d H:i:s')."<br/>";
											
											if($currenDate>$dueDate4){
												echo "ติดตามสถาบันการเงินฯ";
											}else{
												echo "ปกติ";
											}
										  ?>
										</td>
									  </tr>
									  <?php } ?>
									  
									  <?php if($row["FinancialInstitute5"]!="") {?>
									  <tr>
									    <td>
									      <?php echo "ข้อมูลหนี้สินกับ  <u>".$row["FinancialInstitute5"]."</u>  <br/>วงเงิน  <u>-</u> บาท <br/>แจ้งความประสงค์ขอ  <u>".$row["FinancialProcess5"]."</u>"; ?>
										  <?php 
											if($row["FinancialComment5"]!=""){
											  echo "<br/><br/><u>ประวัติการดำเนินการ</u><br/>";
											  echo $row["FinancialComment5"];
											}
										  ?>
										</td>
										<td>
										  <?php
										    if($row["FinancialStatus5"]==""){
											  echo "รอดำเนินการ";
											}else{
											  echo $row["FinancialStatus5"];
											}
										  ?>
										</td>
										<td>
										  <?php
											if($row["FinancialDueDate5"]==""){ 
											  $dueDate5=new DateTime($row["CreateDate"]);
											  $dueDate5=$dueDate5->modify('+3 day');
											  $dueDate5=date_format($dueDate5, 'd/m/Y');
											}else{
											  $dueDate5=date_format(new DateTime($row["FinancialDueDate5"]), 'd/m/Y');
											}
											echo $dueDate5;
										  ?>
										</td>
										<td>
										  <?php 
											if($row["FinancialDueDate5"]==""){ 
											  $dueDate5=new DateTime($row["CreateDate"]);
											  $dueDate5=$dueDate5->modify('+3 day');
											}else{
											  $dueDate5=new DateTime($row["FinancialDueDate5"]);
											}
											$currenDate=new DateTime();
											
											//echo $dueDate5->format('Y-m-d H:i:s')."<br/>";
											//echo $currenDate->format('Y-m-d H:i:s')."<br/>";
											
											if($currenDate>$dueDate5){
												echo "ติดตามสถาบันการเงินฯ";
											}else{
												echo "ปกติ";
											}
										  ?>
										</td>
									  </tr>
									  <?php } ?>
									  
									</tbody>
								</table>
							</div>
						</div>
						
						<!--
						<div class="row">
							<div class="col-md-12">
								<div class="form-inline">
									<button id="submit1" name="submit1" type="submit" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
									<br/>
								</div>
							</div>
						</div>
						</form>
						-->
						
						<hr/>
						
						<form id="frm2" name="frm2" role="form" method="POST" action="#">
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<small>ต้องการเงินทุนหมุนเวียนหรือไม่</small>
									<select id='isSoftloan' name='isSoftloan' class='form-control select2' style='width: 100%;' disabled>
										<option value='ไม่ต้องการ' <?php if($row["Softloan"]=="ไม่ต้องการ"){ echo "selected"; } ?>>ไม่ต้องการ</option>
										<option value='ต้องการ' <?php if($row["Softloan"]=="ต้องการ"){ echo "selected"; } ?>>ต้องการ</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<small>วงเงินที่ต้องการ (บาท)</small>
									<input id="softloanAmount" name="softloanAmount" type="number" class="form-control" placeholder="" min="1" value="<?php echo $row["	SoftloanAmount"]; ?>" disabled>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-4">
								<div class="form-group">
									<small>ต้องการเงินทุนฟื้นฟูกิจการหรือไม่</small>
									<select id='isRecoverloan' name='isRecoverloan' class='form-control select2' style='width: 100%;' disabled>
										<option value='ไม่ต้องการ' <?php if($row["Recoverloan"]=="ไม่ต้องการ"){ echo "selected"; } ?>>ไม่ต้องการ</option>
										<option value='ต้องการ' <?php if($row["Recoverloan"]=="ต้องการ"){ echo "selected"; } ?>>ต้องการ</option>
									</select>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
									<small>วงเงินที่ต้องการ (บาท)</small>
									<input id="recoverloanAmount" name="recoverloanAmount" type="text" class="form-control" placeholder="" value="<?php echo $row["RecoverloanAmount"]; ?>" disabled>
								</div>
							</div>
							<div class="col-md-4">
								<div class="form-group">
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลประวัติการชำระเงิน (ณ วันที่ทำรายการ นับรายการที่มีการผิดนัดชำระยาวนานที่สุด) </u></h3>
							</div>
							<div class="col-md-4">
								<select id='duePayment' name='duePayment' class='form-control select2' style='width: 100%;' disabled>
									<option value='ไม่เคยผิดชำระ' <?php if($row["DuePayment"]=="ไม่เคยผิดชำระ"){ echo "selected"; } ?> >ไม่เคยผิดชำระ</option>
									<option value='เคยผิดชำระ เป็นระยะเวลา 30 วัน' <?php if($row["DuePayment"]=="เคยผิดชำระ เป็นระยะเวลา 30 วัน"){ echo "selected"; } ?> >เคยผิดชำระ เป็นระยะเวลา 30 วัน</option>
									<option value='เคยผิดชำระ เป็นระยะเวลา 60 วัน' <?php if($row["DuePayment"]=="เคยผิดชำระ เป็นระยะเวลา 60 วัน"){ echo "selected"; } ?> >เคยผิดชำระ เป็นระยะเวลา 60 วัน</option>
									<option value='เคยผิดชำระ เป็นระยะเวลา 90 วัน' <?php if($row["DuePayment"]=="เคยผิดชำระ เป็นระยะเวลา 90 วัน"){ echo "selected"; } ?> >เคยผิดชำระ เป็นระยะเวลา 90 วัน</option>
									<option value='เคยผิดชำระ เป็นระยะเวลา 120 วัน' <?php if($row["DuePayment"]=="เคยผิดชำระ เป็นระยะเวลา 120 วัน"){ echo "selected"; } ?> >เคยผิดชำระ เป็นระยะเวลา 120 วัน</option>
								</select><br>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
								<a href="finance.dashboard.php" class="btn btn-default pull-right"><i class="fa fa-undo"></i> หน้าหลัก</a>
								<br/>
							</div>
						</div>
						</form>

					</div><!-- /.box-body -->
					
				
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
	
	$('#duedate1').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	
	$('#duedate2').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	
	$('#duedate3').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	
	$('#duedate4').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	
	$('#duedate5').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	
	/*
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
	*/
	
	/*
	$('#financialInstitute1').change(function(){
        //var selected = $(this).children("option:selected").val();
        //alert(selected);
    });
	*/
  })
  
</script>
</body>
</html>
