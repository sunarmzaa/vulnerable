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
								<h3 class="box-title"><u>ค้นหาข้อมูลผู้แจ้งความประสงค์จะเดินทางออกนอกเขตจังหวัดภูเก็ตเพื่อกลับภูมิลำเนา</u></h3>
							</div>
						</div><!-- /.row -->
						<br/>
						<br/>
						<div class="row">
							<div class="col-md-12">
								<div class="form-group">
									<span class="fontsize16px">เลขประจำตัวประชาชน/Passport No.</span>
									<div class="form-inline">
										<div class="input-group">
											<input id="idCard" name="idCard" type="text" class="form-control" placeholder=""> <!--data-inputmask='"mask": "9999999999999"' data-mask-->
										</div>
										<button id="submit" name="submit" type="submit" class="btn btn-primary"><i class="fa fa-search"></i> ค้นหา</button><br/>
										<!--<h3 class="box-title" style="color:red">เนื่องจากมีการฝ่าฝืน การอนุญาตเดินทางออกนอกเขตจังหวัดภูเก็ตเพื่อกลับภูมิลำเนา จึงดำเนินการปิดระบบชั่วคราวเพื่อตรวจสอบข้อมูลให้ถูกต้องตรงกันกับจังหวัดปลายทางทั่วประเทศ 
ตั้งแต่เวลา 10:20 น. เป็นต้นไป</h3>-->
									</div>
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