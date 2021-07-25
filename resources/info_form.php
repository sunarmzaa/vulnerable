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
  
  if(isset($_POST["submit"])){
	$checkedList="";
	foreach($_POST['check_list'] as $checked) {
		$checkedList.=$checked.",";
	}
    
	$comm="INSERT INTO info(shipname, captain, captain_mobile, departure, departure_date, departure_time, arrival, crew, passenger, guide, guide_mobile, created, createdon, approve_status, approved, approvedon, active) 
	  VALUES (:shipname, :captain, :captain_mobile, :departure, :departure_date, :departure_time, :arrival, :crew, :passenger, :guide, :guide_mobile, :created, :createdon, :approve_status, :approved, :approvedon, :active)";
				
	$query=$conn->prepare($comm);
	$result=$query->execute(array(
	  "shipname"=>$_POST["shipname"],				//"HMS"
	  "captain"=>$_POST["captain"],					//"(C)Ton Jaitrong"
	  "captain_mobile"=>$_POST["captain_mobile"],	//"(083) 508 8051"
	  "departure"=>$_POST["departure"],				//"1"
	  "departure_date"=>ConvertDateToMySQLDate($_POST["departure_date"]),	//"2019-04-17"
	  "departure_time"=>$_POST["departure_time"],	//"06:30"
	  "arrival"=>$_POST["arrival"], 				//"เกาะราชาใหญ่ จ.ภูเก็ต"
	  "crew"=>$_POST["crew"],						//3
	  "passenger"=>$_POST["passenger"],				//25
	  "guide"=>$_POST["guide"],						//"Kochanipa Chaipon"
	  "guide_mobile"=>$_POST["guide_mobile"],		//"(085) 806 9090"
	  "created"=>$_SESSION["AUTHEN"]["USER_ID"],
	  "createdon"=>date("Y-m-d h:i:s"),
	  "approve_status"=>$checkedList,
	  "approved"=>$_SESSION["AUTHEN"]["USER_ID"],
	  "approvedon"=>date("Y-m-d h:i:s"),
	  "active"=>1
	));
	
	header("Location: info");
	die();
  }
  
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
		ใบตรวจสอบเรือก่อนออกจากท่าเทียบเรือ
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
        <form id="frm" name="frm" role="form" method="POST" action="<?php echo htmlentities($_SERVER['PHP_SELF']); ?>">
          <div class="box-body">
		
            <div class="row">
		      <div class="col-md-12">
			    <span class="fontsize16px pull-right"><?php echo ConvertDateToTH(getdate()); ?></span>
			  </div>
              <!-- /.col -->
		    </div>
            <!-- /.row -->
			
		    <div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">ชื่อเรือ</span>
                  <input id="shipname" name="shipname" type="text" class="form-control" placeholder="">
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
                  <span class="fontsize16px">นายเรือ ชื่อ</span>
                  <input id="captain" name="captain" type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col -->
			  <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">เบอร์โทรศัพท์</span>
				  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input id="captain_mobile" name="captain_mobile" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
			  </div>
              <!-- /.col -->
		    </div>
            <!-- /.row -->
			
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">ท่าเรือที่ออกเรือ</span>
				  <?php 
					$comm="SELECT pier.* FROM pier WHERE pier.active=1";
					$query=$conn->prepare($comm); 
					$query->execute();
					if($query->rowCount()>0){
					  echo "<select id='departure' name='departure' class='form-control select2' style='width: 100%;'>";
					  $rows=$query->fetchALL();
					  for($i=0; $i<$query->rowCount(); $i++){
					    echo "<option value='".$rows[$i]["pier_id"]."'>".$rows[$i]["pier_name"]."</option>";
					  }
					  echo "</select>";
					}
				  ?>
                </div>
			  </div>
              <!-- /.col -->
			  <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">จุดหมายที่จะไป</span>
                  <input id="arrival" name="arrival" type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col -->
		    </div>
            <!-- /.row -->
			
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">วันที่ออกเรือ</span>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-calendar"></i>
                    </div>
                    <input id="departure_date" name="departure_date" type="text" class="form-control pull-right" onkeydown="return false" value=<?php echo date("d/m/Y"); ?>>
                  </div>
                  <!-- /.input group -->
                </div>
			  </div>
              <!-- /.col -->
			  <div class="col-md-6">
				<div class="form-group">
                  <span class="fontsize16px">เวลาออกเรือ</span>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-clock-o"></i>
                    </div>
                    <input id="departure_time" name="departure_time" type="text" class="form-control pull-right" onkeydown="return false">
                  </div>
                  <!-- /.input group -->
                </div>
			  </div>
              <!-- /.col -->
		    </div>
            <!-- /.row -->
			
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">จำนวนคนประจำเรือ (คน)</span>
                  <input id="crew" name="crew" type="number" class="form-control" placeholder="" min="1" value="1">
                </div>
			  </div>
              <!-- /.col -->
			  <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">จำนวนผู้โดยสาร (คน)</span>
                  <input id="passenger" name="passenger" type="number" class="form-control" placeholder="" min="0" value="0">
                </div>
			  </div>
              <!-- /.col -->
			</div>
			<!-- /.row -->
			
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">มัคคุเทศก์/ไกด์ ชื่อ</span>
                  <input id="guide" name="guide" type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col -->
			  <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">เบอร์โทรศัพท์</span>
                  <div class="input-group">
                    <div class="input-group-addon">
                      <i class="fa fa-phone"></i>
                    </div>
                    <input id="guide_mobile" name="guide_mobile" type="text" class="form-control" data-inputmask='"mask": "(999) 999-9999"' data-mask>
                  </div>
                  <!-- /.input group -->
                </div>
			  </div>
              <!-- /.col -->
		    </div>
			  
          </div>
          <!-- /.box-body -->
          <div class="box-footer">
            
			<h3 class="box-title">รายการ / ผลตรวจสอบ (Checklist) <small>(หากตรวจพบว่ามีให้ทำเครื่องหมาย / หากตรวจไม่พบให้ทำเครื่องหมาย X)</small></h3>
			<br/>
			<?php 
			  $comm="SELECT list.* FROM list WHERE list.active=1";
			  $query=$conn->prepare($comm); 
			  $query->execute();
			  if($query->rowCount()>0){
				$rows=$query->fetchALL();
			    for($i=0; $i<$query->rowCount(); $i++){
				  echo "<div class='row'>";
				  echo "  <div class='col-md-12'>";
			      echo "    <div class='form-group'>";
                  echo "      <span class='fontsize16px'> ";
				  echo "        <input type='checkbox' class='flat-red' name='check_list[]' value='".$rows[$i]["list_id"]."'>";
				  echo " ".$rows[$i]["list_name"];
				  echo "      </span>";
                  echo "    </div>";
				  echo "  </div>";
				  echo "</div>";
				}
			  }
		    ?>
			
			<br/>
			<button id="submit" name="submit" type="submit" class="btn btn-primary pull-right"><i class="fa fa-save"></i> บันทึกข้อมูล</button>
			<br/>
			<hr>
			
			<h3 class="box-title">* หมายเหตุ <small></small></h3>
			<br/>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					1. นายเรือต้องออกเรือเมือคลื่นลมสงบและมีความปลอดภัยต่อการเดินเรือเท่านั้น
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					2. นายเรือต้องติเตามข่าวพยากรณ์อากาศเพื่อการเดินเรือนำมาประกอบการตัดสินใจเรืออกจากท่า
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					3. นายเรือต้องปฏิบัติตามคำสั่งหรือคำแนะนำของหน่วยงานท่เกี่ยวข้องอย่างเคร่งครัด
				  </span>
                </div>
			  </div>
		    </div>
			
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
	
	//Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
	
	$('.select2').select2()
    $('[data-mask]').inputmask()
	
	$('#departure_date').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
	  startDate: moment().format('DD/MM/YYYY')
    })
	
	//Timepicker
    $('#departure_time').timepicker({
      showInputs: false,
	  showMeridian: false,
	  minuteStep: 5,
    })
	
	$('#frm').validate({
      rules: {
        shipname: {
          required: true
        },
		captain: {
		  required: true
		},
		captain_mobile: {
		  required: true
		},
		arrival: {
		  required: true
		},
		crew: {
		  required: true
		},
		passenger: {
		  required: true
		}
		//guide: {
		//  required: true
		//},
		//guide_mobile: {
		//  required: true 	
		//}
      },
	  messages: {
		shipname: {
          required: "กรุณาระบุข้อมูลชื่อเรือ"
        },
		captain: {
          required: "กรุณาระบุข้อมูลชื่อนายเรือ"
        },
		captain_mobile: {
		  required: "กรุณาระบุข้อมูลเบอร์โทรศัพท์ของนายเรือ"
		},
		arrival: {
		  required: "กรุณาระบุข้อมูลจุดหมายที่จะไป"
		},
		crew: {
		  required: "กรุณาระบุข้อมูลจำนวนคนประจำเรือ"
		},
		passenger: {
		  required: "กรุณาระบุข้อมูลจำนวนผู้โดยสาร"
		}
		//guide: {
		//  required: "กรุณาระบุข้อมูลชื่อมัคคุเทศก์/ไกด์"
		//},
		//guide_mobile: {
		//  required: "กรุณาระบุข้อมูลเบอร์โทรศัพท์ของมัคคุเทศก์/ไกด์"	
		//}
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
