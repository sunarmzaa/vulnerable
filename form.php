<?php
  //ini_set('display_startup_errors', 1);
  //ini_set('display_errors', 1);
  //error_reporting(-1);
  
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
  
  if ($_SERVER["REQUEST_METHOD"]=="POST") {
	  $vulnerable_id=$_GET["vulnerable_id"];
	  $org=$_SESSION["AUTHEN"]["ROLE"];
	  $appove=$_POST["appove"];
	  $remark=$_POST["remark"];
	  
	  //echo $id.";".$org.";".$appove;
	  
	  if($_SESSION["AUTHEN"]["ROLE"]=='Admin'){
		$comm="UPDATE vulnerable SET status_app=:appove, app_comment=:remark WHERE vulnerable_id=:vulnerable_id";
	  }
	  
	  if($appove=="NULL"){
		$appove=null;
	  }
	  
	  $query=$conn->prepare($comm);
	  $result=$query->execute(array(
		"appove"=>$appove,
		"remark"=>$remark,
		"vulnerable_id"=>$vulnerable_id,
	  ));
	  
	  if($result){
		$result=1;
		$msg="ทำการปรับปรุงข้อมูลเรียบร้อยแล้ว";
	  }else{
		$error=1;
		$msg="ไม่สามารถทำการปรับปรุงข้อมูลได้";
	  }
  }
  


  $comm = "SELECT * FROM vulnerable WHERE vulnerable_id='" . $_GET["vulnerable_id"] . "'";
  //$comm="SELECT * FROM vulnerable WHERE vulnerable_id";
  //$comm="SELECT * FROM `vulnerable` WHERE `vulnerable_id`";
  $query=$conn->prepare($comm);   
  $query->execute();
	
  if($query->rowCount()>0){
	$row=$query->fetch();
	$title=$row["title"];
	$firstname=$row["firstname"];
	$lastname=$row["lastname"];
	$id_card=$row["id_card"];
	$house_no=$row["house_no"];
	$lane=$row["lane"];
	
	$subdistrict = $row["subdistrict"];
	$road = $row["road"];
	$village_no = $row["village_no"];
	$district = $row["district"];
	$phone = $row["phone"];
	$career = $row["career"];

	$income = $row["income"];
	$household_income = $row["household_income"];
	$problem_level = $row["problem_level"];
	$vulnerable = $row["vulnerable"];
	
	$vulnerable_raise=$row["vulnerable_raise"];
	$vulnerable_other=$row["vulnerable_other"];
	$status=$row["status"];
	$status_other=$row["status_other"];

	$help=$row["help"];
	$allowance=$row["allowance"];
	$allowance_amount=$row["allowance_amount"];
	$created_id=$row["created_id"];
	$created_date=$row["created_date"];

	$app_comment=$row["app_comment"];

	$appove="";
	$remark="";
	if($_SESSION["AUTHEN"]["ROLE"]=='Admin'){
		$appove=$row["status_app"];
		$remark=$row["app_comment"];
	}
  } 

  /*222*/ 
/*
  $comm = "SELECT * FROM help WHERE help_id='" . $_GET["help_id"] . "'";
  $query=$conn->prepare($comm);   
  $query->execute();
	
  if($query->rowCount()>0){
	$row=$query->fetch();
	$vulnerable_id=$row["vulnerable_id"];
	$type=$row["type"];
	$organization=$row["organization"];
	$value=$row["value"];
	$created_date=$row["created_date"];

  } 
 */ 
?>

	<?php
	// $comm = "SELECT `help_id`,`type`,`organization`,`value`
	// FROM vulnerable
	// RIGHT JOIN help
	// ON vulnerable.vulnerable_id = help.vulnerable_id;" . $_GET["vulnerable_id"] . "'";
 	// $query=$conn->prepare($comm);   
  	// $query->execute();
  	// if($query->rowCount()>0){
	// 	$row=$query->fetch();
	// 	$type=$row["type"];
	// 	$organization=$row["organization"];
	// 	$value=$row["value"];
  	// }	
	?>

	<?php
		$comm = "SELECT type,organization,value FROM `help` WHERE vulnerable_id='" . $_GET["vulnerable_id"] . "'";
 		$query=$conn->prepare($comm);   
  		$query->execute();
  		if($query->rowCount()>=0){
			$row=$query->fetch();
			$type=$row["type"];
			$organization=$row["organization"];
			$value=$row["value"];
  		}
	?>

	<?php
	/*
		$comm = "SELECT `role` FROM `user` WHERE `user_id`='" . $_GET["user_id"] . "'";
 		$query=$conn->prepare($comm);   
  		$query->execute();
  		if($query->rowCount()>=0){
			$row=$query->fetch();
			// $type=$row["type"];
			// $organization=$row["organization"];
			$role=$row["role"];

			$_SESSION["AUTHEN"]["ROLE"]=$row["role"];
			if($_SESSION["AUTHEN"]["ROLE"]=='DataEntry'){
				header("Location: vulnerable.management.php");
			}
			else if($_SESSION["AUTHEN"]["ROLE"]=='Admin'){
				header("Location: vulnerable.management1.php");
			}	
  		}
		  */	
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
			<h1>ข้อมูลผู้เปราะบาง</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			
			<div id="error" name="error" class="callout callout-danger" style="display:<?php echo ($error==1?'block':'none'); ?>" ><?php echo $msg; ?></div>
			<div id="result" name="result" class="callout callout-success" style="display:<?php echo ($result==1?'block':'none'); ?>" ><?php echo $msg; ?></div>
			
			<!-- Default box -->
			<div class="box box-primary">
				<form id="frm" name="frm" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?vulnerable_id=" . $_GET["vulnerable_id"]; ?>">
					<div class="box-body">
		    
						<!-- Row1 -->
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">ชื่อ - นามสกุล</span><br>
									<span class="fontsize16px fontblue"><?php echo $title." ".$firstname." ".$lastname; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">เลขประจำตัวประชาชน</span><br>
									<span class="fontsize16px fontblue"><?php echo $id_card; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">หมายเลขโทรศัพท์ที่ติดต่อได้</span><br/>
									<span class="fontsize16px fontblue"><?php echo $phone; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">อาชีพ</span><br/>
									<span class="fontsize16px fontblue"><?php echo $career; ?></span>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						<!-- End Row1 -->
						
						<!-- Row2 -->
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">รายได้/เดือน (บาท)</span><br>
									<span class="fontsize16px fontblue"><?php echo $income; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">รายได้ครัวเรือน/เดือน (บาท)</span><br>
									<span class="fontsize16px fontblue"><?php echo $household_income; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">ระดับของปัญหา</span><br />
									<span class="fontsize16px fontblue"><?php echo $problem_level; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">ประเภทกลุ่มเปราะบาง</span><br />
									<span class="fontsize16px fontblue"><?php echo $vulnerable; ?></span>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						<!-- End Row2 -->
						
						<!-- Row3 -->
						<div class="row">
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">สถานภาพปัจจุบัน</span><br>
									<span class="fontsize16px fontblue"><?php echo $status; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">การรับความช่วยเหลือ</span><br>
									<span class="fontsize16px fontblue"><?php echo $help; ?></span>
								</div>
							</div><!-- /.col -->
							<div class="col-md-3">
								<div class="form-group">
									<span class="fontsize18px">ได้รับเงินสงเคราะห์อื่นๆ รายเดือน</span><br>
									<span class="fontsize18px">จาก</span><br>
									<span class="fontsize16px fontblue"><?php echo $allowance; ?></span>
								</div>
							</div><!-- .col -->
							<div class="col-md-3">
								<div class="form-group">
								<span class="fontsize18px"></span><br>
								<span class="fontsize18px">จำนวน</span><br>
								<span class="fontsize16px fontblue"><?php echo $allowance_amount; ?>&nbspบาท</span>
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->	
						<!-- End Row3 -->


						<div class="row">
							<div class="col-md-2">
								<span class="fontsize16px">ที่อยู่ปัจจุบัน</span><br/>
								<small>เลขที่</small><br>
								<span class="fontsize16px fontblue"><?php echo $house_no; ?></span>
							</div>
							<div class="col-md-2">
								<span class="fontsize16px"></span><br/>
								<small>ถนน</small><br>
								<span class="fontsize16px fontblue"><?php echo $road; ?></span>
							</div>
							<div class="col-md-2">
								<span class="fontsize16px"></span><br/>
								<small>ตรอก / ซอย</small><br>
								<span class="fontsize16px fontblue"><?php echo $lane; ?></span>
							</div>
							<div class="col-md-2">
								<span class="fontsize16px"></span><br/>
								<small>หมู่ที่ / ชุมชน</small><br>
								<span class="fontsize16px fontblue"><?php echo $village_no; ?></span>
							</div>
							<div class="col-md-2">
								<span class="fontsize16px"></span><br/>
								<small>ตำบล / แขวง</small><br>
								<span class="fontsize16px fontblue"><?php echo $subdistrict; ?></span>
							</div>
							<div class="col-md-2">
								<span class="fontsize16px"></span><br/>
								<small>อำเภอ / เขต</small><br>
								<span class="fontsize16px fontblue"><?php echo $district; ?></span>
							</div>
						</div>
				<?php
					// $comm = "SELECT * FROM organization WHERE organization_id='" . $_GET["organization_id"] . "'";
 					// $query=$conn->prepare($comm);   
  					// $query->execute();
	
  					// if($query->rowCount()>0){
					// 	$row=$query->fetch();
					// 	$organization_name=$row["organization_name"];
  					// }	
				?>
			<!-- ได้รับความช่วยเหลือในด้านอื่นๆ-->
				<form id="frm" name="frm" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"])."?vulnerable_id=" . $_GET["vulnerable_id"]; ?>">
						</br>
						<div class="row">
							<div class="col-md-5">
								<span class="fontsize16px">ได้รับการช่วยเหลือด้านอื่นๆ (ในห้วงเดือน ธ.ค. 63 - ก.พ. 64)</span><br/>
								<span>ความช่วยเหลือ</span><br>
								<span class="fontsize16px fontblue"><?php echo $type; ?></span>
							</div>
							<div class="col-md-3">
								<span class="fontsize16px"></span><br/>
								<small>จากหน่วยงาน</small><br>
								<span class="fontsize16px fontblue"><?php echo $organization; ?></span>
							</div>
							<div class="col-md-3">
								<span class="fontsize16px"></span><br/>
								<small>จำนวน (บาท)</small><br>
								<span class="fontsize16px fontblue"><?php echo $value; ?></span>
							</div>
						</div>
					</div><!-- /.box-body -->
					<!-- </div>
				</form> -->


					<div class="box-footer">
						<div class="row">
							<div class="col-md-3">
								<input id="a1" name="appove" type="radio" value="ยังไม่ได้ดำเนินการ" <?php if($appove=="ยังไม่ได้ดำเนินการ"){echo "checked";} ?>> ยังไม่ได้ดำเนินการ
								<input id="a2" name="appove" type="radio" value="อนุมัติ" <?php if($appove=="อนุมัติ"){echo "อนุมัติ";} ?>> อนุมัติ
								<input id="a3" name="appove" type="radio" value="ปฏิเสธ" <?php if($appove=="ปฏิเสธ"){echo "ปฏิเสธ";} ?>> ปฏิเสธ
							</div>
							<div class="col-md-3">
							    หมายเหตุ
								<input id="remark" name="remark" type="text" value="<?php echo $remark; ?>" class="form-control" >
							</div>
							<div class="col-md-6">
								<div class="form-inline">
									<button id="submit" name="submit" type="submit" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
									<br/>
								</div>
							</div>
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
	
	$.validator.addMethod("is_remark", function(value, element) {
		if($("#a3").prop("checked")==true){
			if($('#remark').val()!=""){
				return true;
			}else{
				return false;
			}
		}else{
			return true;
		}
    });
	
    $('#frm').validate({
      
      rules: {
		remark: {
		  is_remark: true
        }
      },
	  
	  messages: {
		remark: {
          is_remark: "กรุณาระบุเหตุผล ลงในช่องหมายเหตุ"
        }
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
