<?php
  session_start();
  // if(!$_SESSION["role"] = "Admin"){
  //   header("Location: vulnerable.management1.php");
  //   die();
  //  } 

  
  //if(!isset($_SESSION["AUTHEN"]["USER_ID"]) || $_SESSION["AUTHEN"]["GROUP"]!="Financial Institute"){
  //  header("Location: finance.login.php");
  //  die(); 
  //}

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
  
  $group="";
  $comm="SELECT user_id FROM user WHERE organization='".$_SESSION["AUTHEN"]["ORG"]."' AND Active=1";

  $query=$conn->prepare($comm); 
  $query->execute();
  if($query->rowCount()>0){
	 if($query->rowCount()==1){
		$row=$query->fetch();
		  $group=$row["user_id"];
	 }else{
	    $rows=$query->fetchALL();
		for($i=0; $i<$query->rowCount(); $i++){
		  $group=$group.$rows[$i]["user_id"].", ";
		}
		$group=substr($group, 0, -2);
	 }
  }
  
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title><?php echo APPLICATION_NAME; ?> | Management</title>
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
<div class="wrapper" >
  
  <?php include "header.php"; ?>
  
  <?php include "sidebar.php"; ?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <h1>??????????????????????????????????????????????????????????????????????????????</h1>
    </section>

    <!-- Main content -->
    <section class="content">

      <!-- Default box -->
      <div class="box box-primary">
	    <div class="box-header with-border">
      
        </div>
        <div class="box-body">
		  <table id="example1" class="table table-bordered table-striped">
            <thead>
              <tr>
        <th>#</th>      
        <th>??????????????????????????????????????????????????????</th>
				<th>????????????-?????????????????????</th>
        <th>????????????</th>
        <th>???????????????</th>
        <th>?????????????????????????????????????????????</th>
				<th>??????????????????????????????</th>
				<th>?????????????????????????????????????????????????????????</th>
				<th>?????????????????????????????????????????????</th>
				<th>?????????????????????????????????????????????????????????</th>
				<th>???????????????????????????</th>
        <th>???????????????</th>
        <th>Approve</th>
              </tr>
            </thead>
			<tbody>
				<?php 
				  //$comm="SELECT vulnerable.*, user.fullname FROM vulnerable INNER JOIN user ON vulnerable.created_id=user.user_id WHERE created_id IN (".$group.") ORDER BY vulnerable_id DESC";
				  $comm="SELECT * FROM vulnerable INNER JOIN user ON vulnerable.created_id=user.user_id WHERE created_id";

					$query=$conn->prepare($comm); 
					$query->execute();
					if($query->rowCount()>0){
						$rows=$query->fetchALL();
						for($i=0; $i<$query->rowCount(); $i++){
				?>
							<tr>
								<td><?php echo $rows[$i]["vulnerable_id"]; ?></th>
								<td><?php echo $rows[$i]["id_card"]; ?></th>
								<td><?php echo $rows[$i]["title"]." ".$rows[$i]["firstname"]." ".$rows[$i]["lastname"]; ?></td>
								<td><?php echo $rows[$i]["subdistrict"]; ?></td>
								<td><?php echo $rows[$i]["district"]; ?></td>
								<td><?php echo $rows[$i]["phone"]; ?></td>
								<td><?php echo $rows[$i]["problem_level"]; ?></td>
								<td><?php echo $rows[$i]["vulnerable"]; ?></td>
								<td><?php echo $rows[$i]["status"]; ?></td>
								<td><?php echo $rows[$i]["help"]; ?></td>
								<td><?php echo $rows[$i]["fullname"]; ?></td>
								<td><?php echo $rows[$i]["appove"]; ?></td>
								<td><a href="vulnerable.dform.php?vulnerable_id=<?php echo $rows[$i]["vulnerable_id"];?>" class="fa fa-pencil" target="_blank"></a></td>
							  </tr>
				<?php
						}
					}
				?>
			</tbody>
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
	
    table=$('#example1').DataTable({
	  'pagingType': 'numbers',
	  'oLanguage': {
        'sLengthMenu': '???????????? _MENU_ ??????????????????',
        'sZeroRecords': '?????????????????????????????????????????????????????????',
        'sInfo': '???????????? _START_ ????????? _END_ ????????? _TOTAL_ ??????????????????',
        'sInfoEmpty': '???????????? 0 ????????? 0 ????????? 0 ??????????????????',
        'sInfoFiltered': '(????????????????????????????????????????????????????????? _MAX_ ??????????????????)',
        'sSearch': '??????????????? '
      }
	})
	
	/*
	$('#startdate').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	
	$('#stopdate').datepicker({
      autoclose: true,
	  format: 'dd/mm/yyyy',
	  language: 'th',
    })
	
	$('#search').click(function() {
		//alert("finance.data2.php?startdate="+$('#startdate').val()+"&stopdate="+$('#stopdate').val()+"&finance="+$('#financeId').val());
		table.ajax.url("finance.data2.php?startdate="+$('#startdate').val()+"&stopdate="+$('#stopdate').val()+"&finance="+$('#financeId').val());
		table.ajax.reload();
		return false;
	});
	*/
   
  })
    
</script>
</body>
</html>
