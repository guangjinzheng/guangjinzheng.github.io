<?php 
	$servername = "106.53.212.13";
    $password = "CXgd19815function";
    $username = "root";
    $dbname = "mysql";  
    $conn = new mysqli($servername, $username, $password, $dbname); 
    $sql = "SELECT * FROM gjz ORDER BY id DESC";
    $result = $conn->query($sql);
	while($row = $result->fetch_assoc()) {  
		//	'time'=>(string)($row['time']), 
		//	'temperature'=>(float)($row['temperature']))); 
		//echo $row['temperature']."<br>";
		//$tx = $row['time']; 
		//echo strtotime(date($tx))*1000;
		echo $row['noise'];
		echo "<br>";
	}  
	//echo strtotime(date("2020-07-20 19:30:20"))*1000;
	$conn->close();
?> 
