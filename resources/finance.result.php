<?php
  include("finance.constant.php");
  
  $result=$_GET["result"];
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
      <section class="content-header">
      </section>

      <!-- Main content -->
      <section class="content">
	    <?php
		  if(isset($_GET["result"]) && isset($_GET["referanceId"])){
		    if($result==1){
			  $lastId=$_GET["referanceId"];
		?>
		      <div class="callout callout-success">
                <h3><i class="icon fa fa-check"></i> ดำเนินการเรียบร้อย</h3>

                <p><?php echo "รหัสอ้างอิง ".$lastId." โปรดบันทึกไว้สำหรับอ้างอิงกับเจ้าหน้าที่" ?> </p>
              </div>
		<?php
		    }else{
		?>
		      <div class="callout callout-danger">
                <h3><i class="icon fa fa-ban"></i> พบข้อผิดพลาด</h3>

                <p><?php echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล  โปรดลองอีกครั้งภายหลัง"; ?> </p>
              </div>
		<?php
		    }
		  }
		?>
		
		<?php
		  if(isset($_GET["result"]) && isset($_GET["action"])){
		    if($result==1){
			  $action=$_GET["action"];
			  if($action="finance"){
		?>
		        <div class="callout callout-success">
                   <h3><i class="icon fa fa-check"></i> ดำเนินการเรียบร้อย</h3>

                    <p><?php echo "ระบบบันทึกรายการข้อมูลเรียบร้อยแล้ว"; ?> </p>
              </div>
			  <div class="form-group pull-right">
                <div class="input-group ">
                  <a href="finance.management.php" class="btn btn-default "><i class="fa fa-undo"></i> หน้าหลัก</a>
                </div> 
              </div>
		<?php
		    }else{
		?>
		      <div class="callout callout-danger">
                <h3><i class="icon fa fa-ban"></i> พบข้อผิดพลาด</h3>

                <p><?php echo "เกิดข้อผิดพลาดในการบันทึกข้อมูล  โปรดลองอีกครั้งภายหลัง"; ?> </p>
              </div>
			  <div class="form-group pull-right">
                <div class="input-group ">
                  <a href="finance.management.php" class="btn btn-default "><i class="fa fa-undo"></i> หน้าหลัก</a>
                </div> 
              </div>
		<?php
			  }
		    }
		  }
		?>
        
		<!--<div class="form-group pull-right">
          <div class="input-group ">
            <a href="index.php" class="btn btn-default "><i class="fa fa-pencil"></i> เพิ่มข้อมูลรายการใหม่ ?</a>
          </div> 
        </div>-->
      </section>
      <!-- /.content -->
    </div>
    <!-- /.container -->
  </div>
  <!-- /.content-wrapper -->
</div>
<!-- ./wrapper -->

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
