<?php
  include("constant.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | index</title>
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
	html,
		body {
		height: 100%;
	}

	.container {
		height: 100%;
		display: flex;
		justify-content: center;
		align-items: center;
	}
    
	.fontsize16px {
      font-size: 16px;
	}
	
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <div class="content-wrapper">
    <div class="container">
	
		<!-- Content Header (Page header) -->
		<!--<section class="content-header">
			<h1>แบบแจ้งความประสงค์จะเดินทางออกนอกเขตจังหวัดภูเก็ตเพื่อกลับภูมิลำเนา<small></small></h1>
		</section>-->

		<!-- Main content -->
		<section class="content">
			<!-- Default box -->
			<div class="box box-primary">
				<form id="frm" name="frm" role="form" method="POST" action="inform.php">
					<div class="box-body">
						<div class="row">
							<div class="col-md-12">
								<!--<h3 class="box-title" style="color:red">เนื่องจากมีการฝ่าฝืน การอนุญาตเดินทางออกนอกเขตจังหวัดภูเก็ตเพื่อกลับภูมิลำเนา จึงดำเนินการปิดระบบชั่วคราวเพื่อตรวจสอบข้อมูลให้ถูกต้องตรงกันกับจังหวัดปลายทางทั่วประเทศ 
ตั้งแต่เวลา 10:20 น. เป็นต้นไป และจะเริ่มเปิดระบบอีกครั้งในวันนี้ เวลา 14:01 น. </h3>-->
								
								<h3 class="box-title">ประกาศสำนักงานจังหวัดภูเก็ต</h3>
									<span class="fontsize18px">
										เรียน  ผู้ประกอบการที่ได้รับผลกระทบด้านเศรษฐกิจจากสถานการณ์การแพร่ระบาดของโรคติดเชื้อ COVID–19<br/><br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;จังหวัดภูเก็ต มีความจำเป็นต้องปิดระบบแจ้งความประสงค์รับการช่วยเหลือตามมาตรการช่วยเหลือผู้ประกอบการที่ได้รับผลกระทบด้านเศรษฐกิจจากสถานการณ์การแพร่ระบาดของโรคติดเชื้อ COVID–19 ของสถาบันการเงินต่างๆ ในจังหวัดภูเก็ต เพื่อปรับปรุงระบบให้ครอบคลุมความต้องการของผู้ประกอบการ และเพิ่มประสิทธิภาพของระบบให้ดียิ่งขึ้น โดยมีรายละเอียดช่วงเวลาดังต่อไปนี้<br/><br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ปิดระบบตั้งแต่วันที่ 20 พฤษภาคม 2563 เวลา 15.00 น. ถึง วันที่ 21 พฤษภาคม 2563 เวลา 15.00 น.<br/><br/>
										&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ทั้งนี้ ผู้ประกอบการที่ได้รับผลกระทบฯ สามารถลงทะเบียนแจ้งความประสงค์รับการช่วยเหลือฯ ได้หลังจากช่วงเวลาดังกล่าว<br/><br/><br/><br/>
									</span>
									<div class="fontsize18px text-center">
										ขอแสดงความนับถือ<br/>
										สำนักงานจังหวัดภูเก็ต
									</div>
							</div><!-- /.col -->
						</div><!-- /.row -->

					</div><!-- /.box-body -->
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

    $('#frm').validate({
      
      rules: {
        idCard: {
          required: true
        }
      },
      
      messages: {
        idCard: {
          required: "กรอกเลขประจำตัวประชาชน/Passport No."
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
