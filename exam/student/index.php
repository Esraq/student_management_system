<?php
	include_once("../header.php");
	if($_SESSION["role"] != 1){
		header("Location: /exam/login.php");
	}
?>
	<title>Student</title>
</head>
<body>
	<?php
		include_once("../grid.php");
	?>

	<?php
		include_once("../footer.php");
	?>