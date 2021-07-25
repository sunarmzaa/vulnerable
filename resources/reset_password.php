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
  
  $isMsg=false;
  $msg="";
  $msqStatus="";
  if(isset($_POST["submit"])){
	$salt="498#2D83B631%3800EBD!801600D*7E3CC13";
    //if(isset($_GET["token"]) && isset($_GET["usr"]) && $_GET["token"]!="" && $_GET["usr"]!=""){
	  $comm="SELECT * FROM user WHERE email='".$_POST["email1"]."' AND active=1 LIMIT 1";
   	  $query=$conn->prepare($comm); 
   	  $query->execute();
	
	  if($query->rowCount()>0){
		  $row=$query->fetch();
		  $key=hash('sha512', $salt.$_POST["email1"]);
		  if($key==$_POST["token"]){
			$comm="UPDATE user SET password=:password WHERE user_id=:user_id";
			$query=$conn->prepare($comm);
			$result=$query->execute(array(
			  "password"=>$_POST["password1"],
			  "user_id"=>$row["user_id"]
		    ));
			if($result){
				
		      $_SESSION["AUTHEN"]["USER_ID"]=$row["user_id"];
		      $_SESSION["AUTHEN"]["FULLNAME"]=$row["fullname"];
		      $_SESSION["AUTHEN"]["LEVEL"]=$row["level"];
				
	  	      header("Location: info");
	  	      die();
			}else{
			  $isMsg=true;
	          $msg="ระบบพบข้อผิดพลาด  ไม่สามารถตั้งค่ารหัสผ่านใหม่ได้";
	          $msgStatus="callout-danger";
			}
		  }else{
			$isMsg=true;
	        $msg="ระบบพบข้อผิดพลาด  ไม่สามารถตั้งค่ารหัสผ่านใหม่ได้";
	        $msgStatus="callout-danger";
		  }
	  }else{
		$isMsg=true;
	    $msg="ข้อมูลอีเมล์ไม่ถูกต้อง ลองอีกครั้ง";
	    $msgStatus="callout-danger";
	  }
    //}else{
	  // Push Notification
	//  echo "ERROR";
	//}
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Reset Password</title>
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
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="#">ตั้งค่ารหัสผ่านใหม่</a>
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">

	<div id="result" name="result" class="callout <?php echo $msgStatus; ?>" style="display:<?php echo ($isMsg==true?'block':'none'); ?>" ><?php echo $msg; ?>  
    </div> <!--style="display:none;"-->
	
    <p class="login-box-msg"><!--Sign in to start your session--></p>

    <form id="frm" name="frm" role="form" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
      <input id="token" name="token" type="hidden" value='<?php echo $_GET["token"]; ?>'>
	  <div class="form-group has-feedback">
        <input id="email1" name="email1" type="email" class="form-control" placeholder="อีเมล์" value="<?php echo $_GET["usr"]; ?>">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input id="password1" name="password1" type="password" class="form-control" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  <div class="form-group has-feedback">
        <input id="password2" name="password2" type="password" class="form-control" placeholder="ยืนยันรหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8">
		  <!--
          <div class="checkbox icheck">
            <label>
              <input type="checkbox"> จำสถานะการเข้าสู่ระบบ
            </label>
          </div>
		  -->
        </div>
        <!-- /.col -->
        <div class="col-xs-4">
          <button id="submit" name="submit" type="submit" class="btn btn-primary btn-block btn-flat">ส่งคำขอ</button>
        </div>
        <!-- /.col -->
      </div>
    </form>
	<!--
    <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a>
      <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
        Google+</a>
    </div>
	-->
    <!-- /.social-auth-links -->

    <a href="login"> กลับเข้าสู่ระบบ</a><br>
    <!--<a href="register.html" class="text-center">Register a new membership</a>-->

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script>
  $(document).ready(function () {
    
	$('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    })
	
	$('#email1').change(function(){
      HideMsg();
    })
	
	$('#email1').keypress(function(){
	  if($('#email1').val()==''){
        HideMsg();
	  }
    })
	
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
        email1: {
          required: true,
		  email: true
        },
		password1: {
		  required: true
		},
		password2: {
		  required: true,
		  equalTo : '#password1'
		}
      },
	  
	  messages: {
		email1: {
          required: 'กรุณาระบุข้อมูลอีเมล์',
		  email: 'กรุณารตรวจสอบรูปแบบอีเมล์'
        },
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
	
  });
  
  function HideMsg(){
    $("#result").css("display", "none");
  }
  
</script>
</body>
</html>
