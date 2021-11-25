<?php
	include_once("../../header.php");
	if($_SESSION["role"] != 2){
		header("Location: /exam/login.php");
	}
?>
	<title>Faculty | Exam</title>
</head>
<body>
	<?php
		include_once("../../grid.php");
	?>

    <?php
        $user_id = $_SESSION["id"];
        $query = "SELECT DISTINCT exam FROM exam_subject WHERE management='$user_id'";
        $result = $conn->query($query);
        $row_count = $result->num_rows;
    ?>

    <div class="user-label">
        <h1>Showing <?php echo $row_count; ?> exams</h1>
    </div>

    <table class="ui celled table">
        <thead>
            <tr>
                <th>Exam Name</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach($result as $row) {
                    $exam_id = $row["exam"];
                    $e_query=mysqli_query($conn, "SELECT * FROM exam WHERE id = '$exam_id'");
                    $e_row=mysqli_fetch_array($e_query);
            ?>
                <tr>
                    <td data-label="Name"><?php echo $e_row["name"]; ?></td>
                    <td data-label="Name">
                        <a href="./exam_detail.php?examid=<?php echo $exam_id; ?>" class="ui positive tiny button">Detail</a>
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