<?php
	include_once("../../header.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | Exams</title>
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
        $query = "SELECT * FROM exam ORDER BY id desc";
        $result = $conn->query($query);
        $row_count = $result->num_rows;
    ?>

    <?php
        if($row_count > 0){
    ?>
        <div class="user-label">
            <h1>Showing <?php echo $row_count; ?> exams</h1>
            <a href="./add_exam.php" class="ui blue button add-user-btn">Add Exam</a>
        </div>

        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Department</th>
                    <th>Session</th>
                    <th>Semester</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($result as $row) {
                ?>
                    <tr>
                        <td data-label="Name"><?php echo $row["name"]; ?></td>
                        <td data-label="Age"><?php echo $row["department"]; ?></td>
                        <td data-label="Name"><?php echo $row["session"]; ?></td>
                        <td data-label="Name"><?php echo $row["semister"]; ?></td>
                        <td data-label="Name">
                            <a href="./exam_detail.php?examid=<?php echo $row["id"]; ?>" class="ui positive tiny button">Detail</a>
                        </td>
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
        <h3>Not any exam found</h3>
        <a href="./add_exam.php" class="ui blue button add-user-btn">Add Exam</a>
    </div>

    <?php
        }
    ?>

	<?php
		include_once("../../footer.php");
	?>