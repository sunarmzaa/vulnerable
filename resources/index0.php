<?php
  include("constant.php");
  
  date_default_timezone_set("Asia/Bangkok");
  
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
			<h1>แบบแจ้งความประสงค์จะเดินทางออกนอกเขตจังหวัดภูเก็ตเพื่อกลับภูมิลำเนา<small></small></h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Default box -->
			<div class="box box-primary">
				<form id="frm" name="frm" role="form" method="POST" action="result.php">
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
									<span class="fontsize16px">เลขประจำตัวประชาชน</span>
									<input id="idCard" name="idCard" type="text" class="form-control" placeholder="" data-inputmask='"mask": "9999999999999"' data-mask>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">ชื่อ-สกุล</span>
									<input id="fullname" name="fullname" type="text" class="form-control" placeholder="">
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
										<input id="mobile" name="mobile" type="text" class="form-control" data-inputmask='"mask": "9999999999"' data-mask>
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
									<select id='district' name='district' class='form-control select2' style='width: 100%;'>
										<option value='1'>รถจักรยานยนต์ส่วนบุคคล</option>
										<option value='2'>รถยนต์ส่วนบุคคล</option>
										<option value='3'>รถยนต์โดยสารสาธารณะ</option>
									</select>
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">เลขทะเบียนยานพาหนะ</span>
									<input id="fullname" name="fullname" type="text" class="form-control" placeholder="">
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
									<input id="houseNo" name="houseNo" type="text" class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<small>หมู่ที่</small>
									<input id="village" name="village" type="text" class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<small>ตำบล</small>
									<input id="subDistrict" name="subDistrict" type="text" class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<small>อำเภอ</small>
									<input id="district" name="district" type="text" class="form-control" placeholder="">
								</div>
							</div><!-- /.col -->
							<div class="col-md-6">
								<div class="form-group">
									<span class="fontsize16px">จุดหมายปลายทาง</span><br/>
									<small>บ้านเลขที่</small>
									<input id="houseNo" name="houseNo" type="text" class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<small>หมู่ที่</small>
									<input id="village" name="village" type="text" class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<small>ตำบล</small>
									<input id="subDistrict" name="subDistrict" type="text" class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<small>อำเภอ</small>
									<input id="district" name="district" type="text" class="form-control" placeholder="">
								</div>
								<div class="form-group">
									<small>จังหวัด</small>
									<input id="district" name="district" type="text" class="form-control" placeholder="">
								</div>
							</div><!-- /.col -->
						</div><!-- /.row -->

					</div><!-- /.box-body -->
            
					<div class="box-footer">
						<button id="submit" name="submit" type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> ลงทะเบียน</button>
						<br/>
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

    $('#arrival').datepicker({
      autoclose: true,
	    format: 'dd/mm/yyyy',
	    language: 'th',
	    //startDate: moment().format('DD/MM/YYYY')
    }),

    $.validator.addMethod("checkedHouseNo", function(value, element) {
      if($('#houseNo').val().match(/^[0-9\.\-\/]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลขและเครื่องหมาย / เท่านั้น");
    
    /*$('#frm').validate({
      
      rules: {
        idCard: {
          required: true
        },
        fullname: {
          required: true
        },
        //province: {
        //  selectedProvinceOrCountry: true
        //},
        //country: {
        //  selectedProvinceOrCountry: true
        //},
        arrivalFrom: {
          required: true
        },
        houseNo: {
          required: true,
          checkedHouseNo: true,
        },
        village: {
          required: true
        },
        subDistrict: {
          required: true
        },
        mobile: {
          required: true
        },
        //'risk[]': {
        //  required: true
        //}
        createFullname: {
          required: true
        },
        createPosition: {
          required: true
        }
      },
      
      messages: {
        idCard: {
          required: "กรอกเลขประจำตัวประชาชน"
        },
        fullname: {
          required: "กรอกชื่อ สกุล"
        },
        arrivalFrom: {
          required: "กรอกเดินทางมาจากจังหวัด หรือ เดินทางมาจากประเทศ"
        },
        houseNo: {
          required: "กรอกบ้านเลขที่"
        },
        village: {
          required: "กรอกหมู่บ้าน/ชุมชน"
        },
        subDistrict: {
          required: "กรอกตำบล"
        },
        mobile: {
          required: "กรอกเบอร์โทรศัพท์"
        },
        //'risk[]': {
        //  required: "ต้องมีความเสี่ยงอย่างน้อย 1 รายการ"
        //}
        createFullname: {
          required: "กรอกชื่อ สกุล"
        },
        createPosition: {
          required: "ตำแหน่ง"
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
    })*/
  })
</script>
</body>
</html>
