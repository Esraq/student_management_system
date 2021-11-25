<?php 
	// $server_name = "localhost";
	// $server_user_name = "root";
	// $server_password = "";
				
	// try{
	// 	$conn = new PDO("mysql:host=$server_name;dbname=exam",$server_user_name,$server_password);
	// 	$conn->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);
					
	// 	}catch(PDOException $e){
	// 		echo "Could not connect to the database." . $e->getMessage();
	// 	}

	$conn = mysqli_connect('localhost', 'root', '') or
        die ('Unable to connect. Check your connection parameters.');
        mysqli_select_db($conn, 'exam' ) or die(mysqli_error($db));
?>