<?php 
  session_start();
  
  if(!isset($_SESSION["AUTHEN"]["USER_ID"])){
    header("Location: login.php");
    die(); 
  }
  
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
  
  $isMsg=false;
  $msg="";
  $msgStatus="";
  $msgIcon="";
  $msgTitle="";
  if(isset($_POST["submit"])){
    $comm="UPDATE user SET password=:password WHERE user_id=:user_id";
	$query=$conn->prepare($comm);
	$result=$query->execute(array(
	  "password"=>$_POST["password1"],
	  "user_id"=>$_SESSION["AUTHEN"]["USER_ID"]
    ));
	if($result){
      $isMsg=true;
	  $msg="บันทึกข้อมูลการเปลี่ยนรหัสผ่านเรียบร้อยแล้ว";
	  $msgStatus="callout-success";
	  $msgIcon="fa-check";
	  $msgTitle="ดำเนินการเรียบร้อย";
	}else{
	  $isMsg=true;
	  $msg="เกิดข้อผิดพลาดในการบันทึกข้อมูลการเปลี่ยนรหัสผ่าน";
	  $msgStatus="callout-danger";
	  $msgIcon="fa-ban";
	  $msgTitle="พบข้อผิดพลาด";
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Change Password</title>
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
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/iCheck/all.css">
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
<body class="hold-transition skin-blue sidebar-mini"> <!-- sidebar-mini -->
<!-- Site wrapper -->
<div class="wrapper clearfix" >
  
  <?php include "header.php"; ?>
  
  <?php include "sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		เปลี่ยนรหัสผ่าน
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <form id="frm" name="frm" role="form" method="POST" action="change <?php //echo htmlentities($_SERVER['PHP_SELF']); ?>">
          <div class="box-body">
			
            <div class="row">
		      <div class="col-md-6">
			    <div id="result" name="result" class="callout <?php echo $msgStatus; ?>" style="display:<?php echo ($isMsg==true?'block':'none'); ?>" >
				  <h4><i class="icon fa <?php echo $msgIcon; ?>"></i> <?php echo $msgTitle; ?></h4>
				  <p><?php echo $msg; ?></p>
                </div>
			  </div>
              <!-- /.col -->
			  <div class="col-md-6">
			  </div>
              <!-- /.col -->
		    </div>
            <!-- /.row -->
			
		    <div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">รหัสผ่าน</span>
				  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input id="password1" name="password1" type="password" class="form-control" placeholder="">
                  </div>
                  <!-- /.input group -->
                </div>
			  </div>
              <!-- /.col -->
			  <div class="col-md-6"></div>
              <!-- /.col -->
		    </div>
            <!-- /.row -->
			
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">ยืนยันรหัสผ่าน</span>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-key"></i>
                    </div>
                    <input id="password2" name="password2" type="password" class="form-control" placeholder="">
                  </div>
                  <!-- /.input group -->
                </div>
			  </div>
              <!-- /.col -->
			  <div class="col-md-6"></div>
              <!-- /.col -->
		    </div>
            <!-- /.row -->
			
          </div>
          <!-- /.box-body -->
		  
          <div class="box-footer">
			<button id="submit" name="submit" type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> ส่งคำขอ</button>
          </div>
          <!-- /.box-footer-->
		</form>
      </div>
      <!-- /.box -->

    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <?php include "footer.php"; ?>

  <?php include "control.php"; ?>
  
</div>
<!-- ./wrapper -->

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
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
	
	$('#password1').change(function(){
      HideMsg();
    })
	
	$('#password1').keypress(function(){
	  if($('#password1').val()==''){
        HideMsg();
	  }
    })
	
	$('#password2').change(function(){
      HideMsg();
    })
	
	$('#password2').keypress(function(){
	  if($('#password2').val()==''){
        HideMsg();
	  }
    })

	$('#frm').validate({
      rules: {
		password1: {
		  required: true
		},
		password2: {
		  required: true,
		  equalTo : '#password1'
		}
      },
	  
	  messages: {
		password1: {
          required: 'กรุณาระบุข้อมูลรหัสผ่าน'
        },
		password2: {
          required: 'กรุณาระบุข้อมูลรหัสผ่าน',
		  equalTo : 'กรุณาระบุข้อมูลยืนยันรหัสผ่าน ให้ตรงกับรหัสผ่าน'
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
  
  function HideMsg(){
    $("#result").css("display", "none");
  }
</script>
</body>
</html>
