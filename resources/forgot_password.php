<?php
  session_start();
  
  include("constant.php");
  require_once('class.phpmailer.php');
  
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
	
    $comm="SELECT * FROM user WHERE email='".$_POST["email1"]."' AND active=1 LIMIT 1";
	$query=$conn->prepare($comm); 
	$query->execute();
	
	if($query->rowCount()>0){
	  
	  try {
	    $salt="498#2D83B631%3800EBD!801600D*7E3CC13";
	    $token=hash("sha512", $salt.$_POST["email1"]);
	    $pwrurl=URI."reset_password.php?usr=".$_POST["email1"]."&token=".$token;
			
	    $mail=new PHPMailer(true);
	    $mail->CharSet="UTF-8";
	    $mail->IsHTML(true);
	    $mail->IsSMTP();
	    $mail->SMTPDebug=false;
	    $mail->SMTPAuth=true; // enable SMTP authentication
	    $mail->SMTPSecure="tls"; // sets the prefix to the servier
	    $mail->Host="smtp.gmail.com"; // sets GMAIL as the SMTP server
	    $mail->Port=587; // set the SMTP port for the GMAIL server
	    $mail->Username="ton.jaitrong@gmail.com"; // GMAIL username
	    $mail->Password="T0n@d3pa"; // GMAIL password
	    $mail->From="noreply@depa.or.th"; // "name@yourdomain.com";
	    //$mail->AddReplyTo = "support@thaicreate.com"; // Reply
	    $mail->FromName="noreply@depa.or.th";  // set from Name
	    $mail->Subject="ตั้งค่ารหัสผ่านใหม่"; 
	    $mail->Body="<div>เรียน</div><div>ตามที่ท่านประสงค์ขอให้ทางระบบฯ ตั้งค่ารหัสผ่านใหม่นั้น</div><div>ท่านสามารถตั้งค่ารหัสผ่านใหม่ได้ที่  <a href='".$pwrurl."' target='_blank'>ลิงค์</a>.</div>";
	    $mail->AddAddress($_POST["email1"], ""); // to Address
	    $mail->set('X-Priority', '1'); //Priority 1 = High, 3 = Normal, 5 = low
	    $mail->Send();
		
		$isMsg=true;
		$msg="ระบบฯ ส่งอีเมล์การตั้งค่ารหัสผ่านใหม่เรียบร้อยแล้ว กรุณาทำรายการจากอีเมล์ดังกล่าว";
		$msgStatus="callout-success";
		
	  }catch (phpmailerException $e) {
	    $isMsg=true;
	    //$msg=$e->errorMessage(); //Pretty error messages from PHPMailer
		$msg="ระบบฯ ไม่สามารถส่งอีเมล์การตั้งค่ารหัสผ่านใหม่ได้";
		$msgStatus="callout-danger";
      }catch (Exception $e) {
        $isMsg=true;
		$msg=$e->getMessage(); //Boring error messages from anything else!
		$msgStatus="callout-danger";
      }
	}else{
	  // Push Notification
	  $isMsg=true;
	  $msg="ข้อมูลอีเมล์ไม่ถูกต้อง ลองอีกครั้ง";
	  $msgStatus="callout-danger";
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Forgot Password</title>
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

    <form id="frm" name="frm" role="form" method="POST" action="reset<?php //echo htmlentities($_SERVER['PHP_SELF']); ?>">
      <div class="form-group has-feedback">
        <input id="email1" name="email1" type="email" class="form-control" placeholder="อีเมล์">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
	  <!--
      <div class="form-group has-feedback">
        <input id="password1" name="password1" type="password" class="form-control" placeholder="รหัสผ่าน">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
	  -->

      <div class="row">
        <div class="col-xs-8">
		  <a href="login"> กลับเข้าสู่ระบบ</a><br>
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

    <!--<a href="login.php"> กลับเข้าสู่ระบบ</a><br>-->
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
	
	$('#email1').change(function(){
      HideMsg();
    })
	
	$('#email1').keypress(function(){
	  if($('#email1').val()==''){
        HideMsg();
	  }
    })
	
	$('#frm').validate({
	  rules: {
        email1: {
          required: true,
		  email: true
        }
      },
	  
	  messages: {
		email1: {
          required: 'กรุณาระบุข้อมูลอีเมล์',
		  email: 'กรุณารตรวจสอบรูปแบบอีเมล์'
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
