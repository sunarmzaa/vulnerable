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
    <!-- Content Header (Page header) --
    <section class="content-header">
      <h1>
		?????????????????????????????????????????????????????????????????????????????????????????????????????????
      </h1>
    </section>

    <!-- Main content --
    <section class="content">

      <!-- Default box --
      <div class="box box-primary">
        <form role="form">
          <div class="box-body">
		
            <div class="row">
		      <div class="col-md-12">
			    <span class="fontsize16px pull-right">?????????????????? 15 ?????????????????? 2562</span>
			  </div>
              <!-- /.col --
		    </div>
            <!-- /.row --
		    <div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">????????????????????????</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
			  <div class="col-md-6">
			  </div>
              <!-- /.col --
		    </div>
            <!-- /.row --
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">????????????????????? ????????????</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
			  <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">???????????????????????????????????????</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
		    </div>
            <!-- /.row --
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">???????????????????????????????????????????????????</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
			  <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">??????????????????????????????????????????</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
		    </div>
            <!-- /.row --
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">?????????????????????????????????</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
			  <div class="col-md-6">
			  </div>
              <!-- /.col --
		    </div>
            <!-- /.row --
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">???????????????????????????????????????????????? (??????)</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
			  <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">?????????????????????????????????????????? (??????)</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
			</div>
			<div class="row">
		      <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">??????????????????????????????/???????????? ????????????</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
			  <div class="col-md-6">
			    <div class="form-group">
                  <span class="fontsize16px">???????????????????????????????????????</span>
                  <input type="text" class="form-control" placeholder="">
                </div>
			  </div>
              <!-- /.col --
		    </div>
          </div>
          <!-- /.box-body --
          <div class="box-footer">
            <button type="button" class="btn btn-primary pull-right"><i class="fa fa-save"></i> ????????????????????????????????????</button>
			
			<br/>
			
			<h3 class="box-title">?????????????????? / ??????????????????????????? (Checklist) <small>(?????????????????????????????????????????????????????????????????????????????????????????? / ???????????????????????????????????????????????????????????????????????????????????? X)</small></h3>
			<br/>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" checked disabled>
					1. ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? (??????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" disabled>
					2. ????????????????????? ??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? (??????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" checked disabled>
					3. ??????????????? ??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? (??????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" checked disabled>
					4. ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? (??????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" checked disabled>
					5. ?????????????????????????????? ???????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? ?????????????????????????????????????????????????????? (??????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" checked disabled>
					6. ????????????????????????????????????????????????????????? (??????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" checked disabled>
					7. ?????????????????????????????????????????????????????????????????????????????????????????? (????????????????????????????????????????????????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" checked disabled>
					8. ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????? (?????????????????????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					<input type="checkbox" class="flat-red" checked disabled>
					9. ??????????????????????????????????????????????????????/???????????? (?????????????????????????????????????????????)
				  </span>
                </div>
			  </div>
		    </div>
	
			<hr>
			
			<h3 class="box-title">* ???????????????????????? <small></small></h3>
			<br/>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					1. ??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					2. ??????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
				  </span>
                </div>
			  </div>
		    </div>
			<div class="row">
		      <div class="col-md-12">
			    <div class="form-group">
                  <span class="fontsize16px">
					3. ?????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????????
				  </span>
                </div>
			  </div>
		    </div>
			
          </div>
          <!-- /.box-footer--
		</form>
      </div>
      <!-- /.box --

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
<!-- SlimScroll -->
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="dist/js/demo.js"></script>
<!-- iCheck 1.0.1 -->
<script src="plugins/iCheck/icheck.min.js"></script>

<script>
  $(document).ready(function () {
    $('.sidebar-menu').tree()
	
	//Flat red color scheme for iCheck
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
      checkboxClass: 'icheckbox_flat-green',
      radioClass   : 'iradio_flat-green'
    })
  })
</script>
</body>
</html>
