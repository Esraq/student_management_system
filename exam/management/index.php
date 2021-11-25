<?php
	include_once("../header.php");
	if($_SESSION["role"] != 2){
		header("Location: /exam/login.php");
	}
?>
	<title>Faculty</title>
</head>
<body>
	<?php
		include_once("../grid.php");
	?>

	Faculty

	<?php
		include_once("../footer.php");
	?>