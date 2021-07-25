<?php
  ini_set('display_startup_errors', 1);
  ini_set('display_errors', 1);
  error_reporting(-1);
  
  session_start();
  
  include("constant.php");
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

  $error=0;
  $result=0;
  $msg="";
  
  $title="";
  $firstname="";
  $lastname="";
  $idCard="";
  $houseNo="";
  $lane="";
  $subdistrict="";
  $road="";
  $villageNo="";
  $district="";
  $phone="";
  $career="";
  $income="";
  $household_income="";
  $problemLevel="";
  $type_vulnerable="";
  $type_vulnerable_other="";
  $type_vulnerable_raise="";
  $status="";
  $status_other="";
  $help="";
  $allowance="";
  $allowance_amount="";
  
  if ($_SERVER["REQUEST_METHOD"]=="POST") {
	
	$appove=$_POST["appove"];
	$remark=$_POST["remark"];
	  
	if($_SESSION["AUTHEN"]["ROLE"]=='Admin'){
	  $comm="UPDATE vulnerable SET appove=:appove, remark=:remark WHERE vulnerable_id=:vulnerable_id";
	}
	  
	$query=$conn->prepare($comm);
	$result=$query->execute(array(
	  "appove"=>$appove,
	  "remark"=>$remark,
	  "vulnerable_id"=>$_GET["vulnerable_id"],
	));
	
	if($result){
		$result=1;
		$msg="ทำการปรับปรุงข้อมูลเรียบร้อยแล้ว";
	}else{
		$error=1;
		$msg="ไม่สามารถทำการปรับปรุงข้อมูลได้";
	}
  }else{
	//
  }
  
  $comm="SELECT * FROM vulnerable WHERE vulnerable_id='".$_GET["vulnerable_id"]."'";
  $query=$conn->prepare($comm);   
  $query->execute();
	
  if($query->rowCount()>0){
	$row=$query->fetch();
	
	$title=$row["title"];
	$firstname=$row["firstname"];
	$lastname=$row["lastname"];
	
	$idCard=$row["id_card"];
	
	$houseNo=$row["house_no"];
	$lane=$row["lane"];
	$subdistrict=$row["subdistrict"];
	$road=$row["road"];
	$villageNo=$row["village_no"];
	$district=$row["district"];
	$phone=$row["phone"];
	$career=$row["career"];
	$income=$row["income"];
	$household_income=$row["household_income"];
	$problemLevel=$row["problem_level"];
	$type_vulnerable=$row["vulnerable"];
	$type_vulnerable_other=$row["vulnerable_other"];
	$type_vulnerable_raise=$row["vulnerable_raise"];
	$status=$row["status"];
	$status_other=$row["status_other"];
	$help=$row["help"];
	$allowance=$row["allowance"];
	$allowance_amount=$row["allowance_amount"];
	$appove=$row["appove"];
	$remark=$row["remark"];
  }  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | form</title>
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
	.fontblue {
      color: blue;
	}
/* เพิ่มมา */	
	input[type="radio"]:disabled {
    -webkit-appearance: none;
    display: inline-block;
    width: 12px;
    height: 12px;
    padding: 0px;
    background-clip: content-box;
    border: 2px solid #bbbbbb;
    background-color: white;
    border-radius: 50%;
	}

	input[type="radio"]:checked {
    background-color: blue;
	}


  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper clearfix" >
  
  <?php include "header.php"; ?>
  
  <?php include "sidebar.php"; ?>
  
  <div class="content-wrapper">
    <div class="container">
		<!-- Content Header (Page header) -->
		<section class="content-header">
			<h1>แบบแจ้งข้อมูลกลุ่มเปราะบาง</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			
			<div id="error" name="error" class="callout callout-danger" style="display:<?php echo ($error==1?'block':'none'); ?>" ><?php echo $msg; ?></div>
			<div id="result" name="result" class="callout callout-success" style="display:<?php echo ($result==1?'block':'none'); ?>" ><?php echo $msg; ?></div>
			
			<!-- Default box -->
			<div class="box box-primary">
				<form id="frm" name="frm" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?vulnerable_id=".$_GET["vulnerable_id"];?>">
					<div class="box-body">
		    
						<div class="row">
							<div class="col-md-2">
								<div class="form-group">
									<span class="fontsize16px">คำนำหน้า</span><br/>
									<span class="fontsize16px fontblue"><?php echo $title; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-4">
								<div class="form-group">
									<span class="fontsize16px">ชื่อ</span><br/>
									<span class="fontsize16px fontblue"><?php echo $firstname; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">นามสกุล</span><br/>
									<span class="fontsize16px fontblue"><?php echo $lastname; ?></span>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<span class="fontsize16px">เลขที่บัตรประจำตัวประชาชน</span><br/>
									<span class="fontsize16px fontblue"><?php echo $idCard; ?></span>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ที่อยู่ปัจจุบัน</span><br/>
									<small>เลขที่</small><br/>
									<span class="fontsize16px fontblue"><?php echo $houseNo; ?></span>
								</div>
								<div class="form-group">
									<small>ตรอก / ซอย (หากไม่มี ให้ระบุ "-")</small><br/>
									<span class="fontsize16px fontblue"><?php echo $lane; ?></span>
								</div>
								<div class="form-group">
									<small>ตำบล / แขวง</small><br/>
									<span class="fontsize16px fontblue"><?php echo $subdistrict; ?></span>
								</div>
								<div class="form-group">
									
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px"></span><br/>
									<small>ถนน (หากไม่มี ให้ระบุ "-")</small><br/>
									<span class="fontsize16px fontblue"><?php echo $road; ?></span>
								</div>
								<div class="form-group">
									<small>หมู่ที่ / ชุมชน (หากไม่มี ให้ระบุ "-")</small><br/>
									<span class="fontsize16px fontblue"><?php echo $villageNo; ?></span>
								</div>
								<div class="form-group">
									
								</div>
								<div class="form-group">
									<small>อำเภอ / เขต</small><br/>
									<span class="fontsize16px fontblue"><?php echo $district; ?></span>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">หมายเลขโทรศัพท์ที่ติดต่อได้</span><br/>
									<span class="fontsize16px fontblue"><?php echo $phone; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6"></div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">อาชีพ</span><br/>
									<span class="fontsize16px fontblue"><?php echo $career; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">รายได้/เดือน (บาท)</span><br/>
									<span class="fontsize16px fontblue"><?php echo $income; ?></span>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">รายได้ครัวเรือน/เดือน (บาท)</span><br/>
									<span class="fontsize16px fontblue"><?php echo $household_income; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6"></div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<h3 class="box-title">ระดับของปัญหา</h3>
								<div class="form-group fontsize16px">
									<input type="radio" name="problemlevel" class="minimal" value="มากที่สุด" <?php if($problemLevel=="มากที่สุด"){ echo "checked"; } ?> disabled> มากที่สุด <br/>
									<input type="radio" name="problemlevel" class="minimal" value="มาก" <?php if($problemLevel=="มาก"){ echo "checked"; }?> disabled> มาก <br/>
									<input type="radio" name="problemlevel" class="minimal" value="น้อย" <?php if($problemLevel=="น้อย"){ echo "checked"; }?> disabled> น้อย
								</div>
							</div><!-- /.col -->
							<div class="col-md-6"></div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<h3 class="box-title">ประเภทกลุ่มเปราะบาง (สามารถเลือกได้มากกว่า 1 ข้อ)</h3>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="vulner_type[]" class="minimal" value="พิการ" <?php if (strpos($type_vulnerable, 'พิการ') !== false) { echo 'checked'; } ?> disabled> พิการ
								</div>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="vulner_type[]" class="minimal" value=" เจ็บป่วย" <?php if (strpos($type_vulnerable, ' เจ็บป่วย') !== false) { echo 'checked'; } ?> disabled> เจ็บป่วย
								</div>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="vulner_type[]" class="minimal" value=" เข้าไม่ถึงสิทธ์ หรือสวัสดิการของรัฐ" <?php if (strpos($type_vulnerable, ' เข้าไม่ถึงสิทธ์ หรือสวัสดิการของรัฐ') !== false) { echo 'checked'; } ?> disabled> เข้าไม่ถึงสิทธ์/สวัสดิการของรัฐ
								</div>
								<div class="form-group fontsize16px">
									<div class="form-inline">
										<input type="checkbox" id="type_other_check" name="vulner_type[]" class="minimal" value="อื่นๆ" <?php if (strpos($type_vulnerable, 'อื่นๆ') !== false) { echo 'checked'; } ?> disabled> อื่นๆ ระบุ
										<span class="fontsize16px fontblue"><?php echo $type_vulnerable_other; ?></span>
									</div>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<h3 class="box-title">&nbsp;</h3>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="vulner_type[]" class="minimal" value="ผู้ป่วยติดเตียง" <?php if (strpos($type_vulnerable, 'ผู้ป่วยติดเตียง') !== false) { echo 'checked'; } ?> disabled> ผู้ป่วยติดเตียง
								</div>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="vulner_type[]" class="minimal" value="เด็ก หรือผู้สูงอายุ" <?php if (strpos($type_vulnerable, 'เด็ก หรือผู้สูงอายุ') !== false) { echo 'checked'; } ?> disabled> เด็ก/ผู้สูงอายุ
								</div>
								<div class="form-group fontsize16px">
									<div class="form-inline">
										<input type="checkbox" id="vulner_raise" name="vulner_type[]" class="minimal" value="มีภาระเลี้ยงดูคนเปราะบาง" <?php if (strpos($type_vulnerable, 'มีภาระเลี้ยงดูคนเปราะบาง') !== false) { echo 'checked'; } ?> disabled> มีภาระเลี้ยงดูคนเปราะบาง จำนวน (คน) 
										<span class="fontsize16px fontblue"><?php echo $type_vulnerable_raise; ?></span>
									</div>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-4">
								<h3 class="box-title">สถานภาพปัจจุบัน</h3>
								<div class="form-group fontsize16px">
									<input type="radio" name="status" class="minimal" value="ยังต้องการความช่วยเหลือ" <?php if (strpos($status, 'ยังต้องการความช่วยเหลือ') !== false) { echo 'checked'; } ?> disabled> ยังต้องการความช่วยเหลือ
								</div>
								<div class="form-group fontsize16px">
									<input type="radio" name="status" class="minimal" value="เสียชีวิต" <?php if (strpos($status, 'เสียชีวิต') !== false) { echo 'checked'; } ?> disabled> เสียชีวิต
								</div>
								<div class="form-group fontsize16px">
									<div class="form-inline">
										<input type="radio" id="status_other" name="status" class="minimal" value="อื่นๆ" <?php if (strpos($status, 'อื่นๆ') !== false) { echo 'checked'; } ?> disabled> อื่นๆ ระบุ
										<span class="fontsize16px fontblue"><?php echo $status_other; ?></span>
									</div>
								</div>
							</div><!-- /.col -->
							<div class="col-md-4">
								<h3 class="box-title">&nbsp;</h3>
								<div class="form-group fontsize16px">
									<input type="radio" name="status" class="minimal" value="ไม่ต้องการความช่วยเหลือแล้ว" <?php if (strpos($status, 'ไม่ต้องการความช่วยเหลือแล้ว') !== false) { echo 'checked'; } ?> disabled> ไม่ต้องการความช่วยเหลือแล้ว
								</div>
								<div class="form-group fontsize16px">
									<input type="radio" name="status" class="minimal" value="ย้ายออกนอกพื้นที่" <?php if (strpos($status, 'ย้ายออกนอกพื้นที่') !== false) { echo 'checked'; } ?> disabled> ย้ายออกนอกพื้นที่
								</div>
								<div class="form-group fontsize16px">&nbsp;</div>
							</div><!-- /.col -->
							<div class="col-md-4">
								<h3 class="box-title">&nbsp;</h3>
								<div class="form-group fontsize16px">&nbsp;</div>
								<div class="form-group fontsize16px">
									<input type="radio" name="status" class="minimal" value="ติดต่อไม่ได้" <?php if (strpos($status, 'ติดต่อไม่ได้') !== false) { echo 'checked'; } ?> disabled> ติดต่อไม่ได้
								</div>
								<div class="form-group fontsize16px">&nbsp;</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<h3 class="box-title">การรับความช่วยเหลือ (สามารถเลือกได้มากกว่า 1 ข้อ)</h3>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="help[]" class="minimal" value="ได้รับเบี้ยยังชีพคนพิการรายเดือน" <?php if (strpos($help, 'ได้รับเบี้ยยังชีพคนพิการรายเดือน') !== false) { echo 'checked'; } ?> disabled> ได้รับเบี้ยยังชีพคนพิการรายเดือน
								</div>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="help[]" class="minimal" value="มีบัตรสวัสดิการแห่งรัฐ" <?php if (strpos($help, 'มีบัตรสวัสดิการแห่งรัฐ') !== false) { echo 'checked'; } ?> disabled> มีบัตรสวัสดิการแห่งรัฐ
								</div>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="help[]" class="minimal" value="ได้รับเงินอุดหนุนเด็กแรกเกิด" <?php if (strpos($help, 'ได้รับเงินอุดหนุนเด็กแรกเกิด') !== false) { echo 'checked'; } ?> disabled> ได้รับเงินอุดหนุนเด็กแรกเกิด
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<h3 class="box-title">&nbsp;</h3>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="help[]" class="minimal" value="ได้รับเบี้ยยังชีพคนชรารายเดือน" <?php if (strpos($help, 'ได้รับเบี้ยยังชีพคนชรารายเดือน') !== false) { echo 'checked'; } ?> disabled> ได้รับเบี้ยยังชีพคนชรารายเดือน
								</div>
								<div class="form-group fontsize16px">
									<input type="checkbox" name="help[]" class="minimal" value="อยู่ในระบบประกันสังคม" <?php if (strpos($help, 'อยู่ในระบบประกันสังคม') !== false) { echo 'checked'; } ?> disabled> อยู่ในระบบประกันสังคม
								</div>
								<div class="form-group fontsize16px">&nbsp;</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<div class="form-inline">
										<input type="checkbox" id="help_allowance" name="help[]" class="minimal" value="ได้รับเงินสงเคราะห์อื่นๆ" <?php if (strpos($help, 'ได้รับเงินสงเคราะห์อื่นๆ') !== false) { echo 'checked'; } ?> disabled> ได้รับเงินสงเคราะห์อื่นๆ รายเดือน จาก
										<span class="fontsize16px fontblue"><?php echo $allowance; ?></span>
										จำนวน
										<span class="fontsize16px fontblue"><?php echo $allowance_amount; ?></span>
										บาท
									</div>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->

			<!-- เข้าไปแก้ไขหน้า2 -->


						
					</div><!-- /.box-body -->
            
					<div class="box-footer">
						<div class="form-inline">
							<div class="col-md-4">
								<input id="a1" name="appove" type="radio" value="ยังไม่ได้ดำเนินการ" <?php if($appove=="ยังไม่ได้ดำเนินการ"){echo "checked";} ?>> ยังไม่ได้ดำเนินการ
								<input id="a2" name="appove" type="radio" value="อนุมัติ" <?php if($appove=="อนุมัติ"){echo "checked";} ?>> อนุมัติ
								<input id="a3" name="appove" type="radio" value="ปฏิเสธ" <?php if($appove=="ปฏิเสธ"){echo "checked";} ?>> ปฏิเสธ
							</div>
							<div class="col-md-4">
							หมายเหตุ
								<input id="remark" name="remark" type="text" value="<?php echo $remark; ?>" class="form-control">
							</div>
							<div class="col-md-4">
								<button id="submit" name="submit" type="submit" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
							</div>
							<br/>
						</div>
					</div><!-- /.box-footer-->

				</form>
			</div><!-- /.box -->
		</section><!-- /.content -->
    </div><!-- /.container -->
  </div><!-- /.content-wrapper -->
  
  <?php include "footer.php"; ?>

  <?php include "control.php"; ?>
  
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
	
	$.validator.addMethod("raise", function(value, element) {
		if($("#vulner_raise").prop("checked")){
			if($('#raise').val()!=""){
				if($('#raise').val().match(/^[0-9]+$/)){
					return true;
				}else{
					$.validator.messages.raise="กรุณาระบุเป็นตัวเลข";
					return false;
				}
			}else{
				$.validator.messages.raise="โปรดระบุจำนวนคนเปราะบางที่เลี้ยงดู";
				return false;
			}
		}else{
			return true;
		}
    });
	
	$.validator.addMethod("status", function(value, element) {
		if($("#status_other").prop("checked")){
			if($('#other').val()!=""){
				return true;
			}else{
				$.validator.messages.status="โปรดระบุ";
				return false;
			}
		}else{
			return true;
		}
    });
	
	$.validator.addMethod("help_other_allowance", function(value, element) {
		if($("#help_allowance").prop("checked")){
			if($('#other_allowance').val()!=""){
				return true;
			}else{
				$.validator.messages.help_other_allowance="โปรดระบุหน่วยงานที่ให้การสงเคราะห์";
				return false;
			}
		}else{
			return true;
		}
    });
	
	$.validator.addMethod("help_other_allowance_amount", function(value, element) {
		if($("#help_allowance").prop("checked")){
			if($('#other_allowance_amount').val()!=""){
				if($('#other_allowance_amount').val().match(/^[0-9]+$/)){
					return true;
				}else{
					$.validator.messages.help_other_allowance_amount="กรุณาระบุเป็นตัวเลข";
					return false;
				}
			}else{
				$.validator.messages.help_other_allowance_amount="โปรดระบุจำนวนเงินที่ได้รับการสงเคราะห์";
				return false;
			}
		}else{
			return true;
		}
    });
	
	$.validator.addMethod("isHouseNo", function(value, element) {
      if($('#houseNo').val().match(/^[0-9\.\-\/]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลขและเครื่องหมาย / เท่านั้น");
	
	//$.validator.addMethod("isVillageNo", function(value, element) {
    //  if($('#villageNo').val().match(/^[0-9\-]+$/)) { 
    //    return true;
    //  }else{ 
    //    return false;
    //  }
    //}, "กรอกเฉพาะตัวเลข หรือ ครื่องหมาย - เท่านั้น");
	
	$.validator.addMethod("isIdCard", function(value, element) {
      if($('#idCard').val().match(/^[0-9]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลข จำนวน 13 หลักเท่านั้น");
	
	$.validator.addMethod("isPhone", function(value, element) {
      if($('#phone').val().match(/^[0-9]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลข จำนวน 10 หลักเท่านั้น");
	
	$.validator.addMethod("income_amount", function(value, element) {
		if($('#income').val()!=""){
			if($('#income').val().match(/^[0-9]+$/)){
				return true;
			}else{
				$.validator.messages.income_amount="กรุณาระบุเป็นตัวเลข";
				return false;
			}
		}else{
			$.validator.messages.income_amount="กรอกรายได้/เดือน";
			return false;
		}
    });
	
	$.validator.addMethod("household_income_amount", function(value, element) {
		if($('#household_income').val()!=""){
			if($('#household_income').val().match(/^[0-9]+$/)){
				return true;
			}else{
				$.validator.messages.household_income_amount="กรุณาระบุเป็นตัวเลข";
				return false;
			}
		}else{
			$.validator.messages.household_income_amount="กรอกรายได้ครัวเรือน/เดือน";
			return false;
		}
    });
	
	$.validator.addMethod("type_other", function(value, element) {
		if($("#type_other_check").prop("checked")){
			if($('#type_other').val()!=""){
				return true;
			}else{
				$.validator.messages.type_other="โปรดระบุ";
				return false;
			}
		}else{
			return true;
		}
    });
	
    $('#frm').validate({
      
      rules: {
		firstname: {
          required: true
        },
		lastname: {
          required: true
        },
		idCard: {
          required: true,
		  isIdCard: true
        },
		houseNo: {
          required: true,
		  isHouseNo: true
        },
		road: {
          required: true
        },
		lane: {
          required: true
        },
		villageNo: {
		  required: true,
		  //isVillageNo: true
		},
		phone: {
          required: true,
		  isPhone: true
        },
		career: {
          required: true
        },
		income: {
          required: true,
		  income_amount: true
        },
		household_income: {
          required: true,
		  household_income_amount: true
        },
		type_other: {
		  type_other: true
		},
		raise:{
		  raise: true
		},
		other:{
		  status: true
		},
		other_allowance: {
		  help_other_allowance: true
		},
		other_allowance_amount: {
			help_other_allowance_amount: true
		}
      },
      
      messages: {
		firstname: {
          required: "กรอกชื่อ"
        },
		lastname: {
          required: "กรอกนามสกุล"
        },
		idCard: {
          required: "กรอกเลขที่ประจำตัวประชาชน"
        },
		houseNo: {
          required: "กรอกเลขที่"
        },
		road: {
          required: "กรอกถนน"
        },
		lane: {
          required: "กรอกตรอก / ซอย"
        },
		villageNo: {
		  required: "กรอกหมู่ที่ / ชุมชน"
		},
		phone: {
          required: "กรอกเบอร์โทรศัพท์"
        },
		career: {
          required: "กรอกอาชีพ"
        },
		income: {
          required: "กรอกรายได้/เดือน"
        },
		household_income: {
          required: "กรอกรายได้ครัวเรือน/เดือน"
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
	
  })
  
</script>
</body>
</html>
