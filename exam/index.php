<?php
	ob_start();
	session_start();
	include("db_connect.php");
	if(isset($_SESSION["role"])){
        if($_SESSION["role"] == 1){
            header('location: /exam/student/');
        }else if($_SESSION["role"] == 2){
            header('location: /exam/faculty/');
        }else if($_SESSION["role"] == 3){
            header('location: /exam/management/');
        }
    }else{
		header('location: /exam/login.php');
	}
?>
<!doctype html>
<html>
	<head>
		<title>Index</title>
		<link rel="stylesheet" type="text/css" href="css/index.css" />
		<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
	</head>
	
	<body>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.js"></script>
	</body>
</html>
<?php
	ob_end_flush();
?>
