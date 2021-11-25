<?php
	include_once("../../header.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | Users</title>
</head>
<body>
	<?php
		include_once("../../grid.php");
	?>
    <?php
        $query = "SELECT * FROM user ORDER BY date desc";
        $result = $conn->query($query);
        $row_count = $result->num_rows;
    ?>

    <div class="user-label">
        <h1>Showing <?php echo $row_count; ?> users</h1>
        <a href="./add_user.php" class="ui blue button add-user-btn">Add User</a>
    </div>

    <table class="ui celled table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Join Date</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($result as $row) {
            ?>
                <tr>
                    <td data-label="Name"><?php echo $row["username"]; ?></td>
                    <td data-label="Age"><?php echo $row["email"]; ?></td>
                    <td data-label="Job"><?php 
                        if($row["role"] == 1){
                            echo "<div class='ui grey label'>Student</div>";
                        }else if($row["role"] == 2){
                            echo "<div class='ui blue label'>Faculty</div>";
                        }else if($row["role"] == 3){
                            echo "<div class='ui red label'>Management</div>";
                        }
                    ?>
                    </td>
                    <td data-label="Name"><?php echo $row["date"]; ?></td>
                    <td data-label="Name">
                        <a href="./user_detail.php?userid=<?php echo $row["id"]; ?>" class="ui positive tiny button">Detail</a>
                    </td>
                </tr>
            <?php
                }
            ?>
        </tbody>
    </table>

	<?php
		include_once("../../footer.php");
	?>