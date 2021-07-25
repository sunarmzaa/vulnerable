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
  
  $conn=PDOConnector();
  
  $idCard="";
  if(isset($_GET["idCard"])){
    if($_GET["idCard"]!=""){
	  $idCard=$_GET["idCard"];
	  $comm="SELECT * FROM transaction WHERE IDCard='".$idCard."'";
	  $query=$conn->prepare($comm); 
	  $query->execute();
	  if($query->rowCount()>0){
		$isExist=true;
	    $transection=$query->fetch();
		
		//$comm="UPDATE transaction 
		//	SET Print=:Print,
		//	PrintDate=:PrintDate
		//	WHERE IDCard=:IDCard";
			
		//$query=$conn->prepare($comm);
		//$result=$query->execute(array(
		//	"IDCard"=>$idCard,		
		//	"Print"=>"1",			
		//	"PrintDate"=>date("Y-m-d h:i:s")
		//));
		
	  }
	}
  }
  
  if($isExist==true){
	  
  }

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
	$monthArr=Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พฤษภาคม","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
	$monthName=$monthArr[$month];
	$day=$current["mday"];
	return thainumDigit($day)."  ".$monthName."  ".thainumDigit($year);
  }
  
  function thainumDigit($num){
    return str_replace(array( '0' , '1' , '2' , '3' , '4' , '5' , '6' ,'7' , '8' , '9' ),
    array( "o" , "๑" , "๒" , "๓" , "๔" , "๕" , "๖" , "๗" , "๘" , "๙" ),
    $num);
};
 
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
	@import url('https://fonts.googleapis.com/css2?family=Sarabun&display=swap');
	
    .fontsize16px {
      font-size: 16px;
	}
	.fontsize20px {
      font-size: 20px;
	}
	@media print 
	{ 
		#non-printable { display: none; } 
		#printable { display: block; } 	
	}
  </style>
</head>
<!-- ADD THE CLASS layout-top-nav TO REMOVE THE SIDEBAR. -->
<body class="hold-transition skin-blue layout-top-nav">
<div class="wrapper">

  <header class="main-header">
  </header>
	<!-- Full Width Column -->
	<div class="content-wrapper" style="background-color: #FFFFFF;">
		<div class="container">
			<div class="row">
				<div class="col-md-12">
					<div id="non-printable">
						<div class="form-inline">
							<a href="javascript:window.printstat(<?php echo $idCard; ?>); javascript:window.print();" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-print" ></i> พิมพ์เอกสาร</a>
							<a href="inform.php?idCard=<?php echo $idCard; ?>" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-undo" ></i> ย้อนกลับ</a>
							<a href="index.php" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-undo" ></i> หน้าแรก</a>
						</div>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<div id="printable" style="font-family: 'Sarabun', sans-serif;">
					
					
						<div class="row">
							<div class="col-md-12 text-center">
							   <img src="garuda.png" height="128">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<span class="pull-right">
									เขียนที่ ศาลากลางจังหวัดภูเก็ต<br/>
									๕ ถนนนริศร  ภก  ๘๓๐๐๐<br/><br/>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<span >
									วันที่  <?php echo ConvertDateToTH(getdate()); ?><br/><br/><br/>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<span style="padding-left: 1in; letter-spacing: 0px; line-height: 20pt;">
									หนังสือฉบับนี้ให้ไว้เพื่อรับรองว่า&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FullName"]; ?>&nbsp;&nbsp;</u>&nbsp;
									เลขบัตรประจำตัวประชาชน/เลขที่หนังสือเดินทาง&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["IDCard"]; ?>&nbsp;&nbsp;</u>&nbsp;
									อายุ&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["Age"]; ?>&nbsp;&nbsp;</u>&nbsp;ปี
									สัญชาติ&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;
									อยู่บ้านเลขที่&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromHouseNo"]; ?>&nbsp;&nbsp;</u>&nbsp;
									หมู่&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromVillageNo"]; ?>&nbsp;&nbsp;</u>&nbsp;
									ซอย&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;
									ตำบล&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromSubDistrict"]; ?>&nbsp;&nbsp;</u>&nbsp;
									อำเภอ&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromDistrict"]; ?>&nbsp;&nbsp;</u>&nbsp;
									จังหวัด&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromProvince"]; ?>&nbsp;&nbsp;</u>&nbsp;
									มีความจำเป็นต้องเดินทางจากเขตพื้นที่จังหวัด&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromProvince"]; ?>&nbsp;&nbsp;</u>&nbsp;
									ไปยังเขตพื้นที่บ้านเลขที่&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToHouseNo"]; ?>&nbsp;&nbsp;</u>&nbsp;
									หมู่&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToVillageNo"]; ?>&nbsp;&nbsp;</u>&nbsp;
									ซอย&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</u>&nbsp;
									ตำบล&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToSubDistrict"]; ?>&nbsp;&nbsp;</u>&nbsp;
									อำเภอ&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToDistrict"]; ?>&nbsp;&nbsp;</u>&nbsp;
									จังหวัด&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToProvince"]; ?>&nbsp;&nbsp;</u>&nbsp;
								</span><br/>
								<span style="letter-spacing: 0px; line-height: 20pt;">เนื่องจาก</span>&nbsp;&nbsp;
								<input type='checkbox' class='flat-red' name='reason1' value='1' <?php if(isset($transection)){ if($transection["Reason1"]==1){ echo "checked"; } }?>> ครบกำหนดระยะเวลาที่เจ้าพนักงานควบคุมโรคติดต่อได้สั่งให้บุคคลดังกล่าวแยกกัก/กักกัน/<b>คุมไว้สังเกต</b> และมีความประสงค์จะกลับไปยังภูมิลำเนา/ที่พักอาศัยเป็นการประจำของตน<br/>
								&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type='checkbox' class='flat-red' name='reason2' value='1' <?php if(isset($transection)){ if($transection["Reason2"]==1){ echo "checked"; } }?>> เหตุจำเป็นอื่น ๆ 
								<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["Reason2Description"]; ?>&nbsp;&nbsp;</u>&nbsp;<br/><br/><br/>
							</div>
						</div>
						<div class="row">
							<div class="pull-right">
								<div class="col-md-12 text-center " style="line-height: 20pt;">
									 ........................................................................<br/>
									(........................................................................)<br/>
									ตำแหน่ง ...................................................<br/><br/>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="pull-right">
								<div class="col-md-12 text-center " style="line-height: 20pt;">
									 ........................................................................<br/>
									(........................................................................)<br/>
									ตำแหน่ง ...................................................<br/><br/>
								</div>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12"><br/><br/>
								<b>เงื่อนไข</b><br/> 
								๑. หนังสือรับรองฉบับนี้ให้ไว้เพื่อใช้แสดงต่อพนักงานเจ้าหน้าที่/เจ้าหน้าที่ตามมาตรการดูแลความสงบเรียบร้อย ณ ด่านตรวจหรือจุดตรวจตามถนน  เส้นทางคมนาคม สถานีขนส่งหรือสถานีโดยสาร กรณี การเดินทางข้ามเขตพื้นที่จังหวัดเท่านั้น<br/>
								๒. ให้บุคคลดังกล่าวสวมหน้ากากผ้าหรือหน้ากากอนามัยตลอดเวลาที่เดินทาง <br/>
								๓. เมื่อเดินทางไปถึงเขตพื้นที่จังหวัดที่เป็นจุดหมายปลายทางแล้ว บุคคลดังกล่าวต้องปฏิบัติตามมาตรการ ตรวจคัดกรอง  มาตรการป้องกันโรค หรือมาตรการใด ๆ ที่จังหวัดปลายทางกำหนด<br/>
							</div>
						</div>
						
						<div class="row">
							<div class="col-md-12">
							   <span class="pull-right">ที่ <?php echo thainumDigit($transection["TransectionID"]); ?> / ๒๕๖๓
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
							   <img src="garuda.png" height="128">
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<span class="pull-right">
									สำนักงานสาธารณสุขจังหวัดภูเก็ต<br/>
									๕๘/๑  ถนนนริศร  ภก  ๘๓๐๐๐<br/><br/>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								<span >
									วันที่  <?php echo ConvertDateToTH(getdate()); ?><br/><br/><br/>
								</span>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12">
								<span style="padding-left: 1in; letter-spacing: 0px; line-height: 20pt;">
									หนังสือฉบับนี้ให้ไว้เพื่อรับรองว่า&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FullName"]; ?>&nbsp;&nbsp;</u>&nbsp;
									เลขบัตรประจำตัวประชาชน&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["IDCard"]; ?>&nbsp;&nbsp;</u>&nbsp;
									อายุ&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["Age"]; ?>&nbsp;&nbsp;</u>&nbsp;ปี
									อยู่บ้านเลขที่&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromHouseNo"]; ?>&nbsp;&nbsp;</u>&nbsp;
									ตำบล&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromSubDistrict"]; ?>&nbsp;&nbsp;</u>&nbsp;
									อำเภอ&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromDistrict"]; ?>&nbsp;&nbsp;</u>&nbsp;
									จังหวัด&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["FromProvince"]; ?>&nbsp;&nbsp;</u>&nbsp;
									หมายเลขโทรศัพท์มือถือ&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["Phone"]; ?>&nbsp;&nbsp;</u>&nbsp;
									เดินทางโดย&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["VehicleType"]; ?>&nbsp;&nbsp;</u>&nbsp;
									ป้ายทะเบียน&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["VehicleLicenseNo"]; ?>&nbsp;&nbsp;</u>&nbsp;
									มีความจำเป็นต้องเดินทางออกจากเขตพื้นที่จังหวัดภูเก็ต ไปยังที่อยู่ปลายทาง บ้านเลขที่&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToHouseNo"]; ?>&nbsp;&nbsp;</u>&nbsp;
									ตำบล&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToSubDistrict"]; ?>&nbsp;&nbsp;</u>&nbsp;
									อำเภอ&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToDistrict"]; ?>&nbsp;&nbsp;</u>&nbsp;
									จังหวัด&nbsp;<u style="margin: 5px;">&nbsp;&nbsp;<?php echo $transection["ToProvince"]; ?>&nbsp;&nbsp;</u>&nbsp;
								</span><br/>
								<span style="padding-left: 1in; letter-spacing: 0px; line-height: 20pt;">
									บุคคลดังกล่าวได้ผ่านการคัดกรองจาก เจ้าพนักงานควบคุมโรคติดต่อ 
								</span><br/>
								<span style="padding-left: 1in; letter-spacing: 0px; line-height: 20pt;">
									๑. ไม่มีไข้สูงเกิน ๓๗.๓ องศา
								</span><br/>
								<span style="padding-left: 1in; letter-spacing: 0px; line-height: 20pt;">
									๒. ไม่มีอาการระบบทางเดินหายใจส่วนบน
								</span><br/>
								<span style="padding-left: 1in; letter-spacing: 0px; line-height: 20pt;">
									๓. ไม่เป็นผู้ที่อยู่ในกลุ่มเสี่ยงที่ต้องเฝ้าระวังโรคติดเชื้อไวรัสโคโรนา ๒๐๑๙ (COVID-19)
								</span><br/>
								<span style="padding-left: 1in; letter-spacing: 0px; line-height: 20pt;">
									เนื่องจากบุคคลดังกล่าวมีความประสงค์จะเดินทางกลับไปยังภูมิลำเนาที่พักอาศัยเป็นการประจำของตน ซึ่งเจ้าพนักงานควบคุมโรคติดต่อ ได้พิจารณาความจำเป็นข้างต้นแล้ว เห็นควรอนุญาตให้เดินทางกลับภูมิลำเนาได้
								</span><br/>
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center"><br/>
								<img src="tanit.png" width="96"><!--width="128"-->
							</div>
						</div>
						<div class="row">
							<div class="col-md-12 text-center">
								           (นายธนิศ  เสริมแก้ว)<br/>
								นายแพทย์สาธารณสุขจังหวัดภูเก็ต<br/>
								เจ้าพนักงานควบคุมโรคติดต่อ
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"><br/><br/>
								<b>เงื่อนไข</b><br/> 
								๑. หนังสือรับรองฉบับนี้ให้ไว้เพื่อใช้แสดงต่อพนักงานเจ้าหน้าที่/เจ้าหน้าที่ตามมาตรการดูแลความสงบ เรียบร้อย ณ ด่านตรวจหรือจุดตรวจตามถนน  เส้นทางคมนาคม สถานีขนส่งหรือสถานีโดยสาร กรณีการเดินทางข้ามเขตพื้นที่จังหวัดเท่านั้น<br/>
								๒. ให้บุคคลดังกล่าวสวมหน้ากากผ้าหรือหน้ากากอนามัยตลอดเวลาที่เดินทาง <br/>
								๓. เมื่อเดินทางไปถึงเขตพื้นที่จังหวัดที่เป็นจุดหมายปลายทางแล้ว บุคคลดังกล่าวต้องปฏิบัติตามมาตรการ  ตรวจคัดกรอง  มาตรการป้องกันโรค หรือมาตรการใด ๆ ที่จังหวัดปลายทางกำหนด<br/>
								๔. เมื่อได้รับหนังสือรับรองแล้วให้รอการอนุมัติโดยสามารถตรวจสอบได้ที่ www.phuket.go.th
							</div>
						</div>
						<div class="row">
							<div class="col-md-12"><br/><br/><br/>
								<img src="announce1.jpg">
							</div>
						</div>
					</div>
				</div>
			</div>
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

<!-- Page script -->
<script>
  $(document).ready(function () {})
  
  function printstat(idCard){
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			//alert(this.responseText);
		}
	};
	xhttp.open("GET", "printstat.php?idCard="+idCard, true);
	xhttp.send();
  }
</script>
</body>
</html>
