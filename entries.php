<?php
  session_start();
  
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
  
  $error=0;
  $result=0;
  $msg="";
  if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$password = $_POST["password"];
	
    $comm="SELECT * FROM user WHERE email='".$_POST["email"]."'";
	$query=$conn->prepare($comm); 
	$query->execute();
	
	if($query->rowCount()==0){
		
		$comm="INSERT INTO user(fullname, email, password, phone, role, active) VALUES(:fullname, :email, :password, :phone, :role, :active)";
		
		$query=$conn->prepare($comm);
		$result=$query->execute(array(
			"fullname"=>$_POST["fullname"],	
			"email"=>$_POST["email"],
			"password"=>$password,	
			"phone"=>$_POST["phone"],	
			"role"=>"DataEntry",
			"active"=>"0"
		));
		
		if($result){
			$result=1;
			$msg="ทำการขึ้นทะเบียนเรียบร้อยแล้ว กรุณายืนยันกับเจ้าหน้าที่จังหวัดภูเก็ตเพื่อยืนยันตัวตนเพื่อเปิดใช้งานระบบ";
		}else{
			$error=1;
			$msg="ไม่สามารถทำการขึ้นทะเบียนได้";
		}
	}else{
		$error=1;
		$msg="ไม่สามารถทำการขึ้นทะเบียนได้ เนื่องจากในระบบมีอีเมลของท่านแล้ว";
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Data Entries</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/iCheck/square/blue.css">

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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">ขึ้นทะเบียนผู้บันทึกข้อมูล</a>
  </div>
  
  <!-- /.login-logo -->
  <div class="login-box-body">

	<div id="error" name="error" class="callout callout-danger" style="display:<?php echo ($error==1?'block':'none'); ?>" ><?php echo $msg; ?></div>
	<div id="result" name="result" class="callout callout-success" style="display:<?php echo ($result==1?'block':'none'); ?>" ><?php echo $msg; ?></div>
	
    <p class="login-box-msg"><!--Sign in to start your session--></p>

    <form id="frm" name="frm" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <div class="form-group has-feedback">
	    <input id="fullname" name="fullname" type="text" class="form-control" placeholder="ชื่อ-นามสกุล">
		<span class="glyphicon glyphicon-user form-control-feedback"></span>
	  </div>
	  <div class="form-group has-feedback">
        <input id="phone" name="phone" type="text" class="form-control" placeholder="หมายเลขโทรศัพท์" data-inputmask='"mask": "9999999999"' data-mask>
        <span class="glyphicon glyphicon-phone form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="email" name="email" type="email" class="form-control" placeholder="อีเมล">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="password" name="password" type="password" class="form-control" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input id="repassword" name="repassword" type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน">
        <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
		  <a href="index.php" class="btn btn-primary">กลับหน้าหลัก</a>
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="submit" name="submit" type="submit" class="btn btn-primary btn-block btn-flat"> สมัคร </button>
        </div>
        <!-- /.col -->
      </div>
    </form>

  </div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="plugins/iCheck/icheck.min.js"></script>

<!-- InputMask -->
<script src="plugins/input-mask/jquery.inputmask.js"></script>
<script src="plugins/input-mask/jquery.inputmask.date.extensions.js"></script>
<script src="plugins/input-mask/jquery.inputmask.extensions.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
  $(document).ready(function () {
	  
	$('[data-mask]').inputmask()
    
	$('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    })
	
	$('#email').change(function(){
      HideMsg();
    })
	
	$('#email').keypress(function(){
	  if($('#email').val()==''){
        HideMsg();
	  }
    })
	
	$('#phone').change(function(){
      HideMsg();
    })
	
	$('#phone').keypress(function(){
	  if($('#phone').val()==''){
        HideMsg();
	  }
    })
	
	$('#password').change(function(){
      HideMsg();
    })
	
	$('#password').keypress(function(){
	  if($('#password1').val()==''){
        HideMsg();
	  }
    })
	
	$('#repassword').change(function(){
      HideMsg();
    })
	
	$('#repassword').keypress(function(){
	  if($('#password1').val()==''){
        HideMsg();
	  }
    })
	
	$.validator.addMethod("phone", function(value, element) {
	  var rexg = /^\d*(?:\.\d{1,2})?$/;
	  var phone=$('#phone').val();
	  
      if(rexg.test(phone) && phone.length == 10) {
        return true;
	  }else{
        return false;
      }
    }, "กรุณาระบุข้อมูลหมายเลขโทรศัพท์ให้ถูกต้อง");
	
	$('#frm').validate({
	  rules: {
        fullname: {
          required: true
        },
		phone: {
          required: true,
		  phone: true
        },
        email: {
          required: true,
		  email: true
        },
		password: {
		  required: true
		},
		repassword: {
		  required: true,
		  equalTo: "#password"
		},
		financialInstitute1: {
			financialInstitute: true
		}
      },
	  
	  messages: {
        fullname: {
          required: "กรุณาระบุข้อมูลชื่อ-นามสกุล"
        },
		phone: {
          required: "กรุณาระบุหมายเลขโทรศัพท์"
        },
		email: {
          required: 'กรุณาระบุข้อมูลอีเมล',
		  email: 'กรุณารตรวจสอบรูปแบบอีเมล'
        },
		password: {
          required: 'กรุณาระบุข้อมูลรหัสผ่าน'
        },
		repassword: {
          required: 'กรุณาระบุข้อมูลยืนยันรหัสผ่าน',
		  equalTo: 'กรุณาระบุข้อมูลรหัสผ่านและยืนยันรหัสผ่านให้ตรงกัน',
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
	
  });
  
  function HideMsg(){
	$("#error").css("display", "none");
    $("#result").css("display", "none");
  }
  
</script>
</body>
</html>
