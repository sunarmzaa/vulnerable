<?php
  session_start();
  
  if(!isset($_SESSION["AUTHEN"]["USER_ID"]) || $_SESSION["AUTHEN"]["GROUP"]!="Business Agent"){
    header("Location: finance.login.php");
    die(); 
  }
  
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
  
  $conn=PDOConnector();
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="bower_components/Ionicons/css/ionicons.min.css">
  <!-- bootstrap datepicker -->
  <link rel="stylesheet" href="bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
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
  
  <?php include "finance.header.php"; ?>
  
  <?php include "finance.sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>
		แบบแจ้งความประสงค์รับการช่วยเหลือตามมาตรการช่วยเหลือผู้ประกอบการที่ได้รับผลกระทบด้านเศรษฐกิจจากสถานการณ์การแพร่ระบาดของโรคติดเชื้อ COVID–19 ของสถาบันการเงินต่างๆ ในจังหวัดภูเก็ต (<?php echo $_SESSION["AUTHEN"]["OPTION1"]; ?>)
      </h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
	    <div class="box-header with-border">
		  
		  <div class="row">
		    
			<div class="col-md-4">
			  <div class="form-group">
                <span class="fontsize16px">เลือกวันที่</span>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="startdate" name="startdate" type="text" class="form-control pull-right" onkeydown="return false" value=<?php echo "11/05/2020"; ?>>
                </div>
                <!-- /.input group -->
              </div>
			</div>
            <!-- /.col -->
			
			<div class="col-md-4">
			  <div class="form-group">
                <span class="fontsize16px">&nbsp;</span>
                <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
                  <input id="stopdate" name="stopdate" type="text" class="form-control pull-right" onkeydown="return false" value=<?php echo date("d/m/Y"); ?>>
                </div>
                <!-- /.input group -->
              </div>
			</div>
            <!-- /.col -->
			
			<div class="col-md-4">
		      <div class="form-group">
			    <span class="fontsize16px">&nbsp;</span>
                <div class="input-group ">
                  <a id="search" name="search" href="#" target="_blank" class="btn btn-success "><i class="fa fa-search"></i> ค้นหา</a>
                </div>
                <!-- /.input group -->  
              </div>
		    </div>
            <!-- /.col -->
		  </div>
          <!-- /.row -->
		  
          <!--<h3 class="box-title">Select2</h3>-->
		  <!--
          <div class="box-tools pull-right">
            <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
            <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-remove"></i></button>
          </div>
		  -->
        </div>
        <div class="box-body">
		  <input type="hidden" id="businessTypeId" name="businessTypeId" value="<?php echo $_SESSION["AUTHEN"]["OPTION1"]; ?>">
		  <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
                <th>รหัสอ้างอิง</th>
				<th>เลขที่เสียภาษีนิติบุคคล</th>
                <th>ชื่อสถานประกอบการ</th>
                <th>ประเภทธุรกิจ</th>
                <th>ชื่อ-นามสกุล</th>
				<th>เบอร์โทรศัพท์</th>
				<th>อีเมล</th>
				<th>วันที่ยื่นแบบฯ</th>
				<th>สถานะการติดตาม</th>
				<th>รายละเอียด</th>
              </tr>
            </thead>
		  </table>
        </div>
        <!-- /.box-body -->
		<!--
		<div class="box-footer">
		</div>
		-->
        <!-- /.box-footer-->
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
<!-- DataTables -->
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- bootstrap datepicker -->
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/locales/bootstrap-datepicker.th.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script>
  var table;
  $(document).ready(function () {
	
    $('.sidebar-menu').tree()
	
	//Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
	
    table=$('#example1').DataTable({
	  'ajax': "finance.data3.php?startdate="+$('#startdate').val()+"&stopdate="+$('#stopdate').val()+"&business="+$('#businessTypeId').val(),
	  "columns": [
            { "data": "TransectionID" },
            { "data": "TaxID" },
            { "data": "CompanyName" },
            { "data": "BusinessType" },
            { "data": "ContactName" },
            { "data": "Phone" },
			{ "data": "Email" },
			{ "data": "CreateDate" },
			{ "data": "Trace" },
			{ "data": "Action" }
        ],
	  'pagingType': 'numbers',
	  'oLanguage': {
        'sLengthMenu': 'แสดง _MENU_ รายการ',
        'sZeroRecords': 'ไม่พบข้อมูลที่ค้นหา',
        'sInfo': 'แสดง _START_ ถึง _END_ ของ _TOTAL_ รายการ',
        'sInfoEmpty': 'แสดง 0 ถึง 0 ของ 0 รายการ',
        'sInfoFiltered': '(จากเร็คคอร์ดทั้งหมด _MAX_ รายการ)',
        'sSearch': 'ค้นหา '
      }
	})
	
	$('#startdate').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	//.on('changeDate',function(e){
	//	table.ajax.url('data.php?date='+$('#select_date').val()).load();
	//})
	
	$('#stopdate').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	//.on('changeDate',function(e){
	//	table.ajax.url('data.php?date='+$('#select_date').val()).load();
	//})
	
	$('#search').click(function() {
		//alert("finance.data3.php?startdate="+$('#startdate').val()+"&stopdate="+$('#stopdate').val()+"&business="+$('#businessTypeId').val());
		table.ajax.url("finance.data3.php?startdate="+$('#startdate').val()+"&stopdate="+$('#stopdate').val()+"&business="+$('#businessTypeId').val());
		table.ajax.reload();
		return false;
	});
	
    /*
	$('#example2').DataTable({
      'paging'      : true,
      'lengthChange': false,
      'searching'   : false,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
	*/

  })
  
  /*function cancelInfo(infoId){
    if(confirm("Are you sure you want to delete this item?")){
	  $.ajax({
        url:"cancel.php?id="+infoId,  
        success:function(data) {
           table.ajax.reload(null, false); 
        }
      });
	} 
  }*/  
</script>
</body>
</html>
