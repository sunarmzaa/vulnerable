<html>
<head>
<title>ThaiCreate.Com PHP & MySQL (mysqli)</title>
</head>
<body>
<?php
	ini_set('display_errors', 1);
	error_reporting(~0);

	$serverName = "localhost";
	$userName = "root";
	$userPassword = "";
	$dbName = "vulnerable";

	$conn = mysqli_connect($serverName,$userName,$userPassword,$dbName);

	$strvulnerable_id = $_GET["vulnerable_id"];
	$sql = "DELETE FROM vulnerable
			WHERE vulnerable_id = '".$strvulnerable_id."' ";

	$query = mysqli_query($conn,$sql);

	if(mysqli_affected_rows($conn)) {
        echo "<script type='text/javascript'>";
        //echo "alert('ลบข้อมูลเรียบร้อยแล้ว');";
        echo "window.location = 'vulnerable.management.php'; ";
        echo "</script>";
	}

	mysqli_close($conn);
?>
</body>
</html>