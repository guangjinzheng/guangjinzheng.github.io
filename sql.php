<?php 
	$servername = "106.53.212.13";
    $password = "CXgd19815function";
    $username = "root";
    $dbname = "mysql";  
    $conn = new mysqli($servername, $username, $password, $dbname); 
    $sql = "SELECT * FROM gjz ORDER BY id DESC  LIMIT 1";
    $result = $conn->query($sql);
	//$result = mysql_query("SELECT * FROM gjz ORDER BY humidity DESC LIMIT 1"); 
	 
	// 2020-07-18 guangjinzheng
	while($row = $result->fetch_assoc()) { 
		echo json_encode(array (
			'data'=>(float)($row['temperature']),
			'id'=>(int)($row['id']),
			'time'=>(string)($row['time']),
			'port'=>(string)($row['port']),
			'temperature'=>(float)($row['temperature']),
			'humidity'=>(float)($row['humidity']),
			'pm25'=>(int)($row['pm25']),
			'airpressure'=>(float)($row['airpressure']),
			'height'=>(float)($row['height']),
			'eco2'=>(int)($row['eco2']),
			'tvoc'=>(int)($row['tvoc']),
			'noise'=>(int)($row['noise']),
			'longitude'=>(string)($row['longitude']),
			'latitude'=>(string)($row['latitude']))); 
	}  
	// echo json_encode(array ('data'=>11,'b'=>2,'c'=>5));
	$conn->close();
?> 
