<?php
	include_once("../header.php");
	if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
	<title>Management</title>
</head>
<body>
	<?php
		include_once("../grid.php");
	?>

	

	<?php
		include_once("../footer.php");
	?>