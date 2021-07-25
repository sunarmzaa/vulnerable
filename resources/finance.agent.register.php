<?php
  session_start();
  
  include("finance.constant.php");
  
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
  
  // ENCODE
  function encode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
	$j = 0;
	$hash = "";
    for ($i = 0; $i < $strLen; $i++) {
        $ordStr = ord(substr($string,$i,1));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= strrev(base_convert(dechex($ordStr + $ordKey),16,36));
    }
    return $hash;
  }
  
  // DECODE
  function decode($string,$key) {
    $key = sha1($key);
    $strLen = strlen($string);
    $keyLen = strlen($key);
	$j = 0;
	$hash = "";
    for ($i = 0; $i < $strLen; $i+=2) {
        $ordStr = hexdec(base_convert(strrev(substr($string,$i,2)),36,16));
        if ($j == $keyLen) { $j = 0; }
        $ordKey = ord(substr($key,$j,1));
        $j++;
        $hash .= chr($ordStr - $ordKey);
    }
    return $hash;
  }
  
  $conn=PDOConnector();
  
  $isError=0;
  $result=0;
  if ($_SERVER["REQUEST_METHOD"]=="POST") {
	//$password = encode($_POST["password"], $_POST["email"]);
	$password = $_POST["password"];
	
    $comm="SELECT * FROM user WHERE Email='".$_POST["email"]."'";
	$query=$conn->prepare($comm); 
	$query->execute();
	
	$isError=0;
	$msg="";
	if($query->rowCount()==0){
		
		$comm="INSERT INTO user(";
		$comm.="IDCard, ";
		$comm.="FullName, ";
		$comm.="Phone, ";
		$comm.="Email, ";
		$comm.="Password, ";
		$comm.="UserGroup, ";
		$comm.="Option1, ";
		$comm.="Active ";
		
		$comm.=") VALUES (";
		$comm.=":IDCard, ";
		$comm.=":FullName, ";
		$comm.=":Phone, ";
		$comm.=":Email, ";
		$comm.=":Password, ";
		$comm.=":UserGroup, ";
		$comm.=":Option1, ";
		$comm.=":Active ";
		
		$comm.=")";
		
		$query=$conn->prepare($comm);
		$result=$query->execute(array(
			"IDCard"=>$_POST["idCard"],
			"FullName"=>$_POST["fullname"],	
			"Phone"=>$_POST["phone"],
			"Email"=>$_POST["email"],	
			"Password"=>$password,	
			"UserGroup"=>"Business Agent",	
			"Option1"=>$_POST["businessType"],	
			"Active"=>"0"
		));
		
		if($result){
			$result=1;
			$msg="ทำการสมัครเรียบร้อยแล้ว กรุณายืนยันกับเจ้าหน้าที่จังหวัดภูเก็ตเพื่อยืนยันตัวตนเพื่อเปิดใช้งานระบบ";
		}else{
			$isError=1;
			$msg="ไม่สามารถทำการสมัครได้";
		}
	}else{
		$isError=1;
		$msg="ไม่สามารถทำการสมัครได้ เนื่องจากในระบบมีอีเมลของท่านแล้ว";
	}
  }
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Register</title>
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
    <a href="#">สมัครสมาชิก </a>
	<br/><span class="fontsize16px">(ตัวแทนกลุ่มธุรกิจ)</span>
  </div>
  
  <!-- /.login-logo -->
  <div class="login-box-body">

	<div id="error" name="error" class="callout callout-danger" style="display:<?php echo ($isError==1?'block':'none'); ?>" ><?php echo $msg; ?></div> <!--style="display:none;"-->
	<div id="result" name="result" class="callout callout-success" style="display:<?php echo ($result==1?'block':'none'); ?>" ><?php echo $msg; ?></div> <!--style="display:none;"-->
	
    <p class="login-box-msg"><!--Sign in to start your session--></p>

    <form id="frm" name="frm" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
	  <div class="form-group has-feedback">
	    <input id="idCard" name="idCard" type="text" class="form-control" placeholder="เลขที่ประจำตัวประชาชน" data-inputmask='"mask": "9999999999999"' data-mask>
		<span class="glyphicon glyphicon-credit-card form-control-feedback"></span>
	  </div>
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
	  <div class="form-group has-feedback">
	    <select id='businessType' name='businessType' class='form-control select2' style='width: 100%;'>
		  <option value='0' selected>เลือกประเภทธุรกิจ</option>
		  <?php
				$comm="SELECT * FROM businesstype WHERE Active=1";
				$query=$conn->prepare($comm); 
				$query->execute();
				if($query->rowCount()>0){
					while ($row = $query->fetch()) {
					  //if(isset($transection) && $row["FinancialInstituteID"]==$transection[""]){ 
					  //	echo "<option value='".$row["FinancialInstituteID"]."' selected>".$row["BusinessTypeName"]."</option>";
					  //}else{
					        echo "<option value='".$row["BusinessTypeName"]."'>".$row["BusinessTypeName"]."</option>";
					  //}
					}
				}
		  ?>
		  </select>
	  </div>
      <div class="row">
        <div class="col-xs-8">
		  <a href="finance.login.php" class="btn btn-primary">กลับหน้าหลัก</a>
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
          <button id="submit" name="submit" type="submit" class="btn btn-primary btn-block btn-flat"> สมัคร </button>
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

    <!--<a href="forgot_password.php"> ลืมรหัสผ่าน?</a><br>-->
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
	
	$.validator.addMethod("businessType", function(value, element) {
      if($('#businessType').children("option:selected").val()=="0") {
        return false;
      }else{
	  	return true;
	  }
    }, "กรุณาระบุข้อมูลประเภทธุรกิจ");
	
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
		idCard: {
          required: true
        },
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
		businessType: {
			businessType: true
		}
      },
	  
	  messages: {
		idCard: {
          required: "กรุณาระบุข้อมูลเลขที่ประจำตัวประชาชน"
        },
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
