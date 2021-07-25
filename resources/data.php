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
  
  if(isset($_GET["date"])){
	if($_GET["date"]!=""){
	  $selected=ConvertDateToMySQLDate($_GET["date"]);
	  
	  $comm="SELECT info.*, pier.* FROM info INNER JOIN pier ON info.departure=pier.pier_id WHERE date(info.departure_date)='".$selected."' AND info.active=1 ORDER BY info.info_id DESC";
	  $query=$conn->prepare($comm); 
	  $query->execute();
	  $results=array();
	  if($query->rowCount()>0){
		$rows=$query->fetchALL();
		for($i=0; $i<$query->rowCount(); $i++){
		  $result=array();
		  $result["info_id"]=$rows[$i]["info_id"];
          $result["createdon"]=ConvertMySQLDateTimeToDateTime($rows[$i]["createdon"]);
          $result["shipname"]=$rows[$i]["shipname"];
          $result["captain"]=$rows[$i]["captain"];
          $result["departure"]=$rows[$i]["pier_name"];
          $result["arrival"]=$rows[$i]["arrival"];
          $result["departure_datetime"]=ConvertMySQLDateTimeToDateTime($rows[$i]["departure_date"]." ".$rows[$i]["departure_time"]);
          $approveArr=explode(',', $rows[$i]["approve_status"]);
		  $result["approve"]=(count($approveArr)-1)."/9";
          //$result["action"]="<a href='approve.php?info_id=".$rows[$i]["info_id"]."' class='fa fa-pencil'></a> <a href='javascript:cancelInfo(".$rows[$i]["info_id"].");' class='fa fa-trash'></a>";
		  $result["action"]="<a href='form/".$rows[$i]["info_id"]."' class='fa fa-pencil'></a> <a href='javascript:cancelInfo(".$rows[$i]["info_id"].");' class='fa fa-trash'></a>";
          array_push($results, $result);
		}
	  }
	  echo json_encode(array('data' => $results), JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
    }   
  }
  
  function ConvertDateToMySQLDate($selected){
    list($day, $month, $year)=explode('/', $selected);
	return $year."-".$month."-".$day;
  }
  
  function ConvertMySQLDateTimeToDateTime($date){
    list($date, $time)=explode(' ', $date);
	list($year, $month, $day)=explode('-', $date);
	$date=$day."/".$month."/".$year;
	
	list($hour, $minute, $sec)=explode(':', $time);
	$time=$hour.".".$minute;
	return $date." - ".$time;
  }
?>
