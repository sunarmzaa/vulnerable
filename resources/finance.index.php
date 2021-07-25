<?php
  session_start();
  
  include("finance.constant.php");
  date_default_timezone_set("Asia/Bangkok");
  
  if ($_SERVER["REQUEST_METHOD"]=="POST") {
	$_SESSION["consensus"]=true;
	header("Location: finance.php");
    die();
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
	.fontsize18px {
      font-size: 18px;
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
			<h1>ข้อตกลงและเงื่อนไขการใช้บริการ</h1>
		</section>

		<!-- Main content -->
		<section class="content">
			<!-- Default box -->
			<div class="box box-primary">
				<form id="frm" name="frm" role="form" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
					<div class="box-body">
					
						<div class="row" style="margin: 10px">
							<span class="fontsize18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สำนักงานจังหวัดภูเก็ตสงวนสิทธิ์ในการจัดให้มีเว็บไซต์นี้เพื่ออำนวยความสะดวกในการเป็นสื่อกลางช่วยติดต่อสื่อสารระหว่างผู้ประกอบการกับธนาคารที่ต้องการรับการช่วยเหลือตามมาตรการช่วยเหลือลูกค้าที่ได้รับผลกระทบจากสภาวะเศรษฐกิจ สำหรับการแพร่ระบาดของโรคติดเชื้อ COVID–19 ของธนาคารต่างๆ ในจังหวัดภูเก็ต ทั้งนี้ ข้อมูลและสาระสำคัญที่ปรากฏในหน้าจอต่างๆ ตลอดจนข้อกำหนด เงื่อนไข และรายละเอียดต่างๆ ความถูกต้องครบถ้วนสมบูรณ์ ความเป็นปัจจุบัน และความต่อเนื่องของข้อมูลในเว็บไซต์นั้น อาจเปลี่ยนแปลงได้ตามดุลยพินิจของสำนักงานจังหวัดภูเก็ต โดยสำนักงานจังหวัดภูเก็ตขอสงวนสิทธิ์ในคัดเลือกผู้ประสงค์ใช้บริการ การระงับหรือจำกัดขอบเขต รวมถึงการปฏิเสธสิทธิในการใช้บริการทางเว็บไซต์ทั้งหมดหรือบางส่วนแก่ผู้ใดก็ได้ตามเกณฑ์ของสำนักงานจังหวัดภูเก็ต โดยไม่ต้องทำการแจ้งให้ท่านทราบแต่อย่างใด และไม่ถือว่าเป็นการกระทำให้ท่าน หรือบุคคลใดเกิดความเสียหายใดๆ ไม่ว่าทางตรงหรือทางอ้อม และจะไม่ยกเว้นเงื่อนไขการให้บริการข้อมูลนี้ไม่ว่าส่วนใดให้แก่ผู้ใดทั้งสิ้น เว้นแต่จะทำเป็นลายลักษณ์อักษร และลงนามโดยผู้มีอำนาจลงนามของจังหวัดภูเก็ต ทั้งนี้ หากท่านไม่สามารถดำเนินการได้ตามข้อตกลงและเงื่อนไขการใช้บริการ กรุณาหยุดการเข้าเว็บไซต์โดยทันที</span>
						</div><!-- /.row -->
              
						<div class="row">
							<div class="col-md-12">
								<h3 class="box-title"><u>นโยบายข้อมูลส่วนบุคคล</u></h3>
							</div>
						</div><!-- /.row -->
						
						<div class="row" style="margin: 10px">
							<div class="col-md-12">
								<span class="fontsize18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ปัจจุบันการเก็บรักษาข้อมูลส่วนบุคคลเป็นสิ่งสำคัญ และสำนักงานจังหวัดภูเก็ต พยายามอย่างยิ่งที่จะให้ท่านได้รับความปลอดภัยสูงสุดจากการใช้บริการเว็บไซต์นี้ ดังนั้น ข้อมูลส่วนบุคคลของท่านที่สำนักงานจังหวัดภูเก็ตได้รับจะถูกเก็บรักษาและดำเนินการอย่างเข้มงวดเพื่อรักษาความปลอดภัย และป้องกันการนำข้อมูลส่วนบุคคลของท่านไปใช้โดยมีเจตนาที่ไม่สุจริตตามพระราชบัญญัติคุ้มครองข้อมูลส่วนบุคคล</span>
							</div>
						</div><!-- /.row -->
						
						<br/>
						<div class="row" style="margin: 10px">
							<div class="col-md-12">
								<span class="fontsize18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สำนักงานจังหวัดภูเก็ตจะเก็บและรวบรวมข้อมูลส่วนบุคคลของท่านเท่าที่จำเป็น ซึ่งขึ้นอยู่กับเนื้อหาและประเภทที่ท่านต้องการรับบริการ รวมถึงจะใช้ข้อมูลส่วนบุคคล หรือข้อเท็จจริงที่ทำให้สามารถระบุตัวบุคคล ไม่ว่าทางตรงหรือทางอ้อม และ/หรือเผยแพร่ข้อมูลส่วนบุคคลของท่าน โดยอาจขอข้อมูลจากท่านโดยใช้บุคคลติดต่อกับท่านโดยตรง ทั้งนี้ สำนักงานจังหวัดภูเก็ตดำเนินการอย่างระมัดระวัง ตามวิธีการที่ชอบด้วยกฎหมาย และเหมาะสม เพื่อให้เป็นไปตามวัตถุประสงค์ในการช่วยเหลือตามมาตรการช่วยเหลือลูกค้าที่ได้รับผลกระทบจากสภาวะเศรษฐกิจ สำหรับการแพร่ระบาดของโรคติดเชื้อ COVID–19 ของธนาคารต่างๆ ในจังหวัดภูเก็ตเป็นหลัก และจะใช้ข้อมูลส่วนบุคคล เหล่านั้นเพื่อประโยชน์ต่อการเยียวยาช่วยเหลือให้กับท่าน หรือเพื่อความจำเป็นในการติดตามผล เพื่อตรวจสอบถึงการโต้ตอบระหว่างท่านและธนาคาร ในกรณีที่ท่านมีข้อสงสัย ซึ่งจะเป็นไปตามความต้องการของท่าน</span>
							</div>
						</div><!-- /.row -->
						
						<br/>
						<div class="row" style="margin: 10px">
							<div class="col-md-12">
								<span class="fontsize18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลส่วนบุคคลของท่านจะไม่ถูกเก็บ รวบรวม เปิดเผย ทำให้แพร่หลาย หรือใช้เพื่อวัตถุประสงค์อื่นใด นอกเหนือจากวัตถุประสงค์ที่ได้แจ้งให้ท่านทราบแล้ว เว้นแต่ได้รับความยินยอมจากท่าน หรือมีกฎหมายบัญญัติเป็นการอื่น</span>
							</div>
						</div><!-- /.row -->
						
						<br/>
						<div class="row">
							<div class="col-md-12">
								<span class="fontsize18px" style="color:#3c8dbc"><u>การเปิดเผยข้อมูลส่วนบุคคล</u></span>
							</div>
						</div><!-- /.row -->
						
						<div class="row" style="margin: 10px">
							<div class="col-md-12">
								<span class="fontsize18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ท่านมีสิทธิในข้อมูลส่วนบุคคลของท่าน โดยสำนักงานจังหวัดภูเก็ตจะไม่อนุญาตให้มีการเปิดเผยข้อมูลส่วนบุคคลของท่านนอกจากผู้ที่ได้รับอนุญาตของสำนักงานจังหวัด ธนาคารที่ท่านติดต่อเพื่อขอรับการเยียวยาตามมาตรการช่วยเหลือลูกค้าที่ได้รับผลกระทบจากสภาวะเศรษฐกิจ สำหรับการแพร่ระบาดของโรคติดเชื้อ COVID–19 และบุคคลที่ได้รับอนุญาตจากท่านให้เข้าถึงข้อมูลส่วนบุคคลของท่าน ตลอดจนจะป้องกันมิให้มีการนำข้อมูลส่วนบุคคลของท่านไปใช้โดยมิได้รับอนุญาตจากท่านก่อน เว้นแต่ได้รับความยินยอมจากท่าน หรือกรณีมีความจำเป็นต้องเปิดเผยเพื่อปฏิบัติตามบทบัญญัติแห่งกฎหมาย หรือตามคำพิพากษา หรือตามคำสั่งของศาล หรือในการพิจารณาของศาล หรืออนุญาโตตุลาการ หรือองค์กรอื่นใดที่มีอำนาจตามกฎหมาย หรือตามประกาศ กฎ ระเบียบ ข้อบังคับ คำสั่ง หรือการร้องขอโดยหน่วยงานอื่นใดที่มีอำนาจตามกฎหมาย</span>
							</div>
						</div><!-- /.row -->
						
						<br/>
						<div class="row" style="margin: 10px">
							<div class="col-md-12">
								<span class="fontsize18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ข้อมูลส่วนบุคคลที่สำนักงานจังหวัดภูเก็ตได้รับจากท่าน สำนักงานจังหวัดภูเก็ตรับประกันกับท่านว่าข้อมูลส่วนบุคคลของท่าน จะได้รับการรักษาอย่างเป็นความลับและได้ใช้มาตรฐานความปลอดภัยชั้นสูง นอกจากนี้แล้ว สำนักงานจังหวัดภูเก็ตขอสงวนสิทธิที่จะนำข้อมูลส่วนบุคคลของท่าน มาใช้ในการวิเคราะห์ ข้อมูลได้ตลอดเวลา และหากมีการแก้ไขใดๆ อันเป็นผลมาจากการวิเคราะห์ข้อมูลดังกล่าวสำนักงานจังหวัดภูเก็ต จะบรรจุการแก้ไขดังกล่าวไว้ในเว็บไซต์จังหวัดภูเก็ต</span>
							</div>
						</div><!-- /.row -->
						
						<br/>
						<div class="row">
							<div class="col-md-12">
								<span class="fontsize18px" style="color:#3c8dbc"><u>การดูแลความถูกต้องของข้อมูลส่วนบุคคลของท่าน และการมีส่วนร่วมของเจ้าของข้อมูล</u></span>
							</div>
						</div><!-- /.row -->
						
						<div class="row" style="margin: 10px">
							<div class="col-md-12">
								<span class="fontsize18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;สำนักงานจังหวัดภูเก็ตพยายามอย่างเต็มที่ในการดูแลข้อมูลส่วนบุคคลของท่านให้มีความถูกต้องตรงตามความเป็นจริงอยู่เสมอ โดยท่านสามารถตรวจสอบได้ว่าข้อมูลส่วนบุคคลของท่านมีความถูกต้อง สมบูรณ์และเป็นปัจจุบันอยู่เสมอ ทั้งนี้ หากท่านพบว่าข้อมูลส่วนบุคคลของท่านไม่ครบถ้วนสมบูรณ์ หรือไม่ถูกต้อง โปรดติดต่อ กลุ่มงานยุทธศาสตร์และข้อมูลเพื่อการพัฒนาจังหวัด สำนักงานจังหวัดภูเก็ต 0 7621 1366 หรือเพื่อดำเนินการแก้ไขให้ถูกต้องต่อไป</span>
							</div>
						</div><!-- /.row -->
						
						<br/>
						<div class="row">
							<div class="col-md-12">
								<span class="fontsize18px" style="color:#3c8dbc"><u>การยอมรับนโยบายข้อมูลส่วนบุคคล ตลอดจนการเปลี่ยนแปลงนโยบายดังกล่าว</u></span>
							</div>
						</div><!-- /.row -->
						
						<div class="row" style="margin: 10px">
							<div class="col-md-12">
								<span class="fontsize18px">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เอกสารฉบับนี้เป็นนโยบายข้อมูลส่วนบุคคลของสำนักงานจังหวัดภูเก็ต ซึ่งเป็นนโยบายข้อมูลส่วนบุคคลสำหรับเว็บไซต์ของจังหวัดภูเก็ตที่สำนักงานจังหวัดภูเก็ตจัดทำขึ้นในปัจจุบัน<br/><br/>
									&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ในอนาคตสำนักงานจังหวัดภูเก็ตอาจเปลี่ยนแปลงข้อความในนโยบายดังกล่าวโดยจะเผยแพร่ให้ทราบผ่านทางเว็บไซต์นี้ หรือช่องทางอื่นตามที่สำนักงานจังหวัดภูเก็ตกำหนด</span>
							</div>
						</div><!-- /.row -->
						
					</div><!-- /.box-body -->
            
					<div class="box-footer">
						<div class="form-inline">
							<button id="submit" name="submit" type="submit" class="btn btn-primary pull-right" style="margin: 5px;"><i class="fa fa-check"></i> ยอมรับ</button>
							<!--<a href="javascript:window.close();" class="btn btn-danger pull-right" style="margin: 5px;"><i class="fa fa-times" ></i> ปฏิเสธ</a>-->
							<br/>
						</div>
					</div><!-- /.box-footer-->
				</form>
			</div><!-- /.box -->
		</section><!-- /.content -->
    </div><!-- /.container -->
  </div><!-- /.content-wrapper -->
  <?php include "footer.php"; ?>
</div><!-- ./wrapper -->

<!-- Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h3 class="modal-title" id="exampleModalLongTitle">ประกาศสำนักงานจังหวัดภูเก็ต</h3>
        <!--
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
		-->
      </div>
      <div class="modal-body">
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
      </div>
      <div class="modal-footer">
        <!--<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
        <button type="button" class="btn btn-primary" data-dismiss="modal">รับทราบ</button>
      </div>
    </div>
  </div>
</div>

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

    $('[data-mask]').inputmask();
	
	//$('#exampleModalCenter').modal({
      //keyboard: false
    //});

    $.validator.addMethod("checkedFromHouseNo", function(value, element) {
      if($('#fromHouseNo').val().match(/^[0-9\.\-\/]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลขและเครื่องหมาย / เท่านั้น");
	
	$.validator.addMethod("checkedToHouseNo", function(value, element) {
      if($('#toHouseNo').val().match(/^[0-9\.\-\/]+$/)) { 
        return true;
      }else{ 
        return false;
      }
    }, "กรอกเฉพาะตัวเลขและเครื่องหมาย / เท่านั้น");
    
    $('#frm').validate({
      
      rules: {
        idCard: {
          required: true
        },
        fullname: {
          required: true
        },
		phone: {
          required: true
        },
		age: {
		  required: true
		},
		vehicleLicenseNo: {
		  required: true
		},
        fromHouseNo: {
          required: true,
          checkedFromHouseNo: true,
        },
        fromVillageNo: {
          required: true
        },
        fromSubDistrict: {
          required: true
        },
        fromDistrict: {
          required: true
        },
        toHouseNo: {
          required: true,
          checkedToHouseNo: true,
        },
        toVillageNo: {
          required: true
        },
        toSubDistrict: {
          required: true
        },
        toDistrict: {
          required: true
        },
		toProvince: {
          required: true
        },
		'reason[]': {
          required: true
        }
      },
      
      messages: {
        idCard: {
          required: "กรอกเลขประจำตัวประชาชน/ Passport No."
        },
        fullname: {
          required: "กรอกชื่อ สกุล"
        },
		phone: {
          required: "กรอกเบอร์โทรศัพท์"
        },
		age: {
          required: "กรอกอายุ"
        },
		vehicleLicenseNo: {
		  required: "กรอกเลขทะเบียนยานพาหนะ"
		},
        fromHouseNo: {
          required: "กรอกบ้านเลขที่"
        },
        fromVillageNo: {
          required: "กรอกหมู่ที่"
        },
        fromSubDistrict: {
          required: "กรอกตำบล"
        },
        fromDistrict: {
          required: "กรอกอำเภอ"
        },
        toHouseNo: {
          required: "กรอกบ้านเลขที่"
        },
        toVillageNo: {
          required: "กรอกหมู่ที่"
        },
        toSubDistrict: {
          required: "กรอกตำบล"
        },
        toDistrict: {
          required: "กรอกอำเภอ"
        },
		toProvince: {
          required: "กรอกจังหวัด"
        },
		'reason[]': {
          required: "ต้องแจ้งเหตุผลอย่างน้อย 1 รายการ"
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
