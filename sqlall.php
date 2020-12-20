<?php 
	$servername = "106.53.212.13";
    $password = "CXgd19815function";
    $username = "root";
    $dbname = "mysql";  
    $conn = new mysqli($servername, $username, $password, $dbname); 
    $sql = "SELECT * FROM gjz ORDER BY id DESC  LIMIT 1";
    $result = $conn->query($sql);
	//$result = mysql_query("SELECT * FROM gjz ORDER BY humidity DESC LIMIT 1"); 

	$userage=$_GET['id'];  
	$tx = array("12","27","23","25","15","35","29","22","18","20"); 
	// 2020-07-18 guangjinzheng
	while($row = $result->fetch_assoc()) { 
		
		//echo json_encode(array ( 
		//	'time'=>(string)($row['time']), 
		//	'temperature'=>(float)($row['temperature']))); 
	}  
	echo json_encode(array ('data'=>$tx[$userage],'b'=>2,'c'=>5)); 
	// echo json_encode(array ('data'=>11,'b'=>2,'c'=>5));
	$conn->close();
?> 
