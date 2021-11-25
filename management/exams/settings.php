<?php
	include_once("../../header.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | Settings</title>
    <style>
        .err-container{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
    </style>
</head>
<body>
	<?php
		include_once("../../grid.php");
	?>
    <?php
        $query = "SELECT * FROM settings ORDER BY id desc";
        $result = $conn->query($query);
        $row_count = $result->num_rows;
    ?>

    <?php
        if($row_count > 0){
    ?>
        <div class="user-label">
            <h1></h1>
            <a href="./edit_settings.php" class="ui blue button add-user-btn">Edit Settings</a>
        </div>

        <table class="ui celled table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Remuneration Per Credit</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($result as $row) {
                ?>
                    <tr>
                        <td data-label="Name"><?php echo $row["id"]; ?></td>
                        <td data-label="Age"><?php echo $row["remuneration"]; ?> BDT</td>
                    </tr>
                <?php
                    }
                ?>
            </tbody>
        </table>
    <?php
        }else{
    ?>

    <div class="err-container">
        <h3>Not any settings found</h3>
        <a href="./edit_settings.php" class="ui blue button add-user-btn">Edit Settings</a>
    </div>

    <?php
        }
    ?>

	<?php
		include_once("../../footer.php");
	?>