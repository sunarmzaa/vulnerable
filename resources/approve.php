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
  
  //$conn=PDOConnector();

  // Check params
  //echo $_POST["idCard"]."<br/>";
  //echo $_POST["fullname"]."<br/>";
  //echo $_POST["province"]."<br/>";
  //echo $_POST["country"]."<br/>";
  //echo $_POST["arrival"]."<br/>";
  //echo $_POST["houseNo"]."<br/>";
  //echo $_POST["village"]."<br/>";
  //echo $_POST["subDistrict"]."<br/>";
  //echo $_POST["district"]."<br/>";
  //if(isset($_POST["risk1"])){
  //  echo "1 <br/>";
  //}else{
  //  echo "0 <br/>";
  //}
  //if(isset($_POST["risk2"])){
  //  echo "1 <br/>";
  //}else{
  //  echo "0 <br/>";
  //}
  //if(isset($_POST["risk3"])){
  //  echo "1 <br/>";
  //}else{
  //  echo "0 <br/>";
  //}
  //echo $_POST["createFullname"]."<br/>";
  //echo $_POST["createPosition"]."<br/>";
  //echo $_POST["createMobile"]."<br/>";

  //if($_POST["province"]>0){
  //  $arrivalFrom="P.".$_POST["province"];
  //}else if($_POST["country"]>0) {
  //  $arrivalFrom="C.".$_POST["country"];
  //}else{
  //  $arrivalFrom="NON";
  //}

  /*$arrivalFrom=$_POST["arrivalFrom"];
  
  if(isset($_POST["risk1"])){
    $risk1=1;
  }else{
    $risk1=0;
  }

  if(isset($_POST["risk2"])){
    $risk2=1;
  }else{
    $risk2=0;
  }

  if(isset($_POST["risk3"])){
    $risk3=1;
  }else{
    $risk3=0;
  }
  
  if(isset($_POST["submit"])){
    $comm="INSERT INTO targets(idCard, fullname, arrivalFrom, arrivalDate, houseNo, village, subdistrict, district, province, mobile, noOfPeople, risk1, risk2, risk3, createFullname, createPosition, createMobile, createDate) 
    VALUES (:idCard, :fullname, :arrivalFrom, :arrivalDate, :houseNo, :village, :subdistrict, :district, :province, :mobile, :noOfPeople, :risk1, :risk2, :risk3, :createFullname, :createPosition, :createMobile, :createDate)";

    $query=$conn->prepare($comm);
    $result=$query->execute(array(
      "idCard"=>$_POST["idCard"],			
      "fullname"=>$_POST["fullname"],
      "arrivalFrom"=>$arrivalFrom,
      "arrivalDate"=>ConvertDateToMySQLDate($_POST["arrival"]),
      "houseNo"=>$_POST["houseNo"],
      "village"=>$_POST["village"],
      "subdistrict"=>$_POST["subDistrict"],
      "district"=>$_POST["district"],
      "province"=>"ภูเก็ต",
      "mobile"=>$_POST["mobile"],
      "noOfPeople"=>$_POST["noOfPeople"],
      "risk1"=>$risk1,
      "risk2"=>$risk2,
      "risk3"=>$risk3,
      "createFullname"=>$_POST["createFullname"],
      "createPosition"=>$_POST["createPosition"],
      "createMobile"=>$_POST["createMobile"],
      "createDate"=>date("Y-m-d h:i:s")
    ));
  
  }
  */
  
  function ConvertDateToTH($current){
	$year=$current["year"]+543;
	$month=$current["mon"];
	$monthArr=Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$monthName=$monthArr[$month];
	$day=$current["mday"];
	return $day." ".$monthName." ".$year;
  }
 
  function ConvertDateToMySQLDate($selected){
	list($day, $month, $year)=explode('/', $selected);
	return $year."-".$month."-".$day;
  }
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Result</title>
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
	.fontsize20px {
      font-size: 20px;
	}
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
  </header>
	<!-- Full Width Column -->
	<div class="content-wrapper">
		<div class="container">
			<!-- Content Header (Page header) -->
			<section class="content-header"></section>
      
			<!-- Main content -->
			<section class="content">
				<div class="form-group pull-right">
					<div class="input-group ">
						<a href="index.php" class="btn btn-success"><i class="fa fa-check-square"></i> อนุญาต</a>&nbsp;
						
						<a href="index.php" class="btn btn-danger"><i class="fa fa-window-close"></i> ปฎิเสธ</a>
					</div><!-- /.input group -->  
				</div>
				<div class="callout callout-default">
					<h3><i class="icon fa fa-info-circle"></i>  ข้อมูลสำหรับตรวจสอบ </h3><br/>
					<span class="fontsize20px">อนุญาตให้ออกนอกเขตจังหวัดภูเก็ตใน <u>วันที่ 1 พ.ค. 2563 เวลา 04.00-22.00 น.</u></span><br/><br/>
					
					<div class="row">
						<div class="col-md-6">
							<span class="fontsize16px">เลขประจำตัวประชาชน</span><br/>
							<span class="fontsize16px"><u>3567874568901</u></span>
						</div>
						<div class="col-md-6">
							<span class="fontsize16px">ชื่อ-นามสกุล</span><br/>
							<span class="fontsize16px"><u>นายต้น ใจตรง</u></span>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-md-6">
							<span class="fontsize16px">เบอร์โทรศัพท์</span><br/>
							<span class="fontsize16px"><u>0835088051</u></span>
						</div>
						<div class="col-md-6">
							<span class="fontsize16px">ชนิด/เลขทะเบียนยานพาหนะ</span><br/>
							<span class="fontsize16px"><u>รถยนต์ส่วนบุคคล / กธ 4675 ระนอง</u></span>
						</div>
					</div>
					<br/>
					<div class="row">
						<div class="col-md-6">
							<span class="fontsize16px">ที่พักอาศัยปัจจุบัน</span><br/>
							<span class="fontsize16px"><u>304 ม.1 ต.วิชิต อ.เมือง จ.ภูเก็ต</u></span>
						</div>
						<div class="col-md-6">
							<span class="fontsize16px">จุดหมายปลายทาง</span><br/>
							<span class="fontsize16px"><u>70/2 ม.2 ต.หงาว อ.เมือง จ.ระนอง</u></span>
						</div>
					</div>
					
				</div>
			</section><!-- /.content -->
		</div><!-- /.container -->
	</div><!-- /.content-wrapper -->
</div><!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
</body>
</html>
