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
  
  // Check params
  //echo $_POST["idCard"];
  
  $conn=PDOConnector();
  
  $isExist=false;
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

?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Inform</title>
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
			<h1>แบบแจ้งความประสงค์จะเดินทางออกนอกเขตจังหวัดภูเก็ตเพื่อกลับภูมิลำเนา
				<small style="color:Red;">
				<?php 
					if($isExist==false){
						echo "ไม่ปรากฏข้อมูล รบกวนท่านโปรดลงทะเบียนใหม่อีกครั้ง";
					}
				?>
				</small>
			</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Default box -->
			<div class="box box-primary">
				<form id="frm" name="frm" role="form" method="POST" action="result.php">
					 <input type="hidden" id="isExist" name="isExist" value="<?php echo $isExist; ?>">
					<div class="box-body">
              
						<div class="row">
							<div class="col-md-6">
								<h3 class="box-title"><u>ข้อมูลผู้เดินทาง</u></h3>
							</div>
							<div class="col-md-6">
								<span class="fontsize16px pull-right"><?php echo ConvertDateToTH(getdate()); ?></span>
							</div><!-- /.col -->
						</div><!-- /.row -->
		    
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เลขประจำตัวประชาชน/Passport No.</span>
									<input id="idCard" name="idCard" type="text" class="form-control" placeholder="" value="<?php echo $idCard; ?>" > <!--data-inputmask='"mask": "9999999999999"' data-mask-->
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ชื่อ-สกุล</span>
									<input id="fullname" name="fullname" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["FullName"]; }?>">
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
			
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">อายุ</span><br/>
									<input id="age" name="age" type="number" class="form-control" placeholder="" min="1" value="<?php if(isset($transection)){ echo $transection["Age"]; }?>">
								</div>
							</div>
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เบอร์โทรศัพท์ </span>
									<div class="input-group">
										<div class="input-group-addon">
											<i class="fa fa-phone"></i>
										</div>
										<input id="phone" name="phone" type="text" class="form-control" value="<?php if(isset($transection)){ echo $transection["Phone"]; }?>" data-inputmask='"mask": "9999999999"' data-mask>
									</div>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลการเดินทาง</u></h3>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ชนิดยานพาหนะ</span>
									<select id='vehicleType' name='vehicleType' class='form-control select2' style='width: 100%;'>
										<option value='รถส่วนตัว' <?php if(isset($transection)){ if($transection["VehicleType"]=="รถส่วนตัว"){ echo "selected"; } }?>>รถส่วนตัว</option>
										<option value='รถเช่า' <?php if(isset($transection)){ if($transection["VehicleType"]=="รถเช่า"){ echo "selected"; } }?>>รถเช่า</option>
										<option value='รถสาธารณะ' <?php if(isset($transection)){ if($transection["VehicleType"]=="รถสาธารณะ"){ echo "selected"; } }?>>รถสาธารณะ</option>
									</select>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เลขทะเบียนและหมวดจังหวัดของยานพาหนะ (เช่น กธ 4586 ชุมพร)</span>
									<input id="vehicleLicenseNo" name="vehicleLicenseNo" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["VehicleLicenseNo"]; }?>">
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลพักอาศัย</u></h3>
							</div><!-- /.col -->
						</div><!-- /.row -->

						<div class="row">
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ที่พักอาศัยปัจจุบัน</span><br/>
									<small>บ้านเลขที่</small>
									<input id="fromHouseNo" name="fromHouseNo" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["FromHouseNo"]; }?>">
								</div>
								<div class="form-group">
									<small>หมู่ที่</small>
									<input id="fromVillageNo" name="fromVillageNo" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["FromVillageNo"]; }?>">
								</div>
								<div class="form-group">
									<small>ตำบล</small>
									<input id="fromSubDistrict" name="fromSubDistrict" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["FromSubDistrict"]; }?>">
								</div>
								<div class="form-group">
									<small>อำเภอ</small>
									<input id="fromDistrict" name="fromDistrict" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["FromDistrict"]; }?>">
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">จุดหมายปลายทาง</span><br/>
									<small>บ้านเลขที่</small>
									<input id="toHouseNo" name="toHouseNo" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["ToHouseNo"]; }?>">
								</div>
								<div class="form-group">
									<small>หมู่ที่</small>
									<input id="toVillageNo" name="toVillageNo" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["ToVillageNo"]; }?>">
								</div>
								<div class="form-group">
									<small>ตำบล</small>
									<input id="toSubDistrict" name="toSubDistrict" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["ToSubDistrict"]; }?>">
								</div>
								<div class="form-group">
									<small>อำเภอ</small>
									<input id="toDistrict" name="toDistrict" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["ToDistrict"]; }?>">
								</div>
								<div class="form-group">
									<small>จังหวัด</small>
									<select id='toProvince' name='toProvince' class='form-control select2' style='width: 100%;'>
									<?php
										$comm="SELECT * FROM provinces";
										$query=$conn->prepare($comm); 
										$query->execute();
										if($query->rowCount()>0){
											while ($row = $query->fetch()) {
												if(isset($transection) && $row["name_th"]==$transection["ToProvince"]){ 
													echo "<option value='".$row["name_th"]."' selected>".$row["name_th"]."</option>";
												}else{
													echo "<option value='".$row["name_th"]."'>".$row["name_th"]."</option>";
												}
											}
										}
									?>
									</select>
									
									<!--<input id="toProvince" name="toProvince" type="text" class="form-control" placeholder="" value="<?php //if(isset($transection)){ echo $transection["ToProvince"]; }?>">-->
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->
						
						<!-- for 03/05/2020 -->
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>ข้อมูลเหตุผลความจำเป็น</u></h3>
							</div>
							<div class="col-md-12">
								<input type='checkbox' class='flat-red' name='reason1' value='1' <?php if(isset($transection)){ if($transection["Reason1"]==1){ echo "checked"; } }?>> ครบกำหนดระยะเวลาที่เจ้าพนักงานควบคุมโรคติดต่อได้สั่งให้บุคคลดังกล่าวแยกกัก/กักกัน/<b>คุมไว้สังเกต</b> และมีความประสงค์จะกลับไปยังภูมิลำเนา/ที่พักอาศัยเป็นการประจำของตน<br>
								<div class="form-inline">
									<input type='checkbox' class='flat-red' name='reason2' value='1' <?php if(isset($transection)){ if($transection["Reason2"]==1){ echo "checked"; } }?>> เหตุจำเป็นอื่น ๆ ระบุ 
									<input id="reason2Desc" name="reason2Desc" type="text" class="form-control" placeholder="" value="<?php if(isset($transection)){ echo $transection["Reason2Description"]; }?>">
								</div>
							</div>
						</div>

					</div><!-- /.box-body -->
            
					<div class="box-footer">
						<div class="form-inline">
							<?php if(isset($transection)){ ?>
								<a href="ducument.php?idCard=<?php echo $idCard; ?>" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-file" ></i> หนังสือรับรองฯ</a>
							<?php } ?>
							<button id="submit" name="submit" type="submit" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-save"></i> <?php if(isset($transection)){ echo "ปรับปรุงข้อมูล"; } else { echo "ลงทะเบียน";}?></button>
							<a href="index.php" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-undo" ></i> ย้อนกลับ</a>
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

    $('[data-mask]').inputmask()

    $.validator.addMethod("checkedFromHouseNo", function(value, element) {
      if($('#fromHouseNo').val().match(/^[0-9\.\-\/]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลขและเครื่องหมาย / เท่านั้น");
	
	$.validator.addMethod("checkedToHouseNo", function(value, element) {
      if($('#toHouseNo').val().match(/^[0-9\.\-\/]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลขและเครื่องหมาย / เท่านั้น");
    
    $('#frm').validate({
      
      rules: {
        idCard: {
          required: true
        },
        fullname: {
          required: true
        },
		phone: {
          required: true
        },
		age: {
		  required: true
		},
		vehicleLicenseNo: {
		  required: true
		},
        fromHouseNo: {
          required: true,
          checkedFromHouseNo: true,
        },
        fromVillageNo: {
          required: true
        },
        fromSubDistrict: {
          required: true
        },
        fromDistrict: {
          required: true
        },
        toHouseNo: {
          required: true,
          checkedToHouseNo: true,
        },
        toVillageNo: {
          required: true
        },
        toSubDistrict: {
          required: true
        },
        toDistrict: {
          required: true
        },
		toProvince: {
          required: true
        },
		'reason[]': {
          required: true
        }
      },
      
      messages: {
        idCard: {
          required: "กรอกเลขประจำตัวประชาชน/ Passport No."
        },
        fullname: {
          required: "กรอกชื่อ สกุล"
        },
		phone: {
          required: "กรอกเบอร์โทรศัพท์"
        },
		age: {
          required: "กรอกอายุ"
        },
		vehicleLicenseNo: {
		  required: "กรอกเลขทะเบียนยานพาหนะ"
		},
        fromHouseNo: {
          required: "กรอกบ้านเลขที่"
        },
        fromVillageNo: {
          required: "กรอกหมู่ที่"
        },
        fromSubDistrict: {
          required: "กรอกตำบล"
        },
        fromDistrict: {
          required: "กรอกอำเภอ"
        },
        toHouseNo: {
          required: "กรอกบ้านเลขที่"
        },
        toVillageNo: {
          required: "กรอกหมู่ที่"
        },
        toSubDistrict: {
          required: "กรอกตำบล"
        },
        toDistrict: {
          required: "กรอกอำเภอ"
        },
		toProvince: {
          required: "กรอกจังหวัด"
        },
		'reason[]': {
          required: "ต้องแจ้งเหตุผลอย่างน้อย 1 รายการ"
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
