<?php
	include_once("../../header.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | Exams Detail</title>
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
        $examid = $_GET['examid'];
        $query=mysqli_query($conn, "SELECT * FROM exam WHERE id = '$examid'");
        $row=mysqli_fetch_array($query);
    ?>

    <?php
        if(isset($_POST['exam_delete'])){
            $sql = "DELETE FROM exam WHERE id='$examid'";
            if ($conn->query($sql) === TRUE) {
                header('location: ./');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>

    <div class="">
        <h1>Exam Detail</h1>
        <div class="ui divider"></div>

        <div class="single-row">
            <div class="label">Exam Name: </div>
            <div class="value"><?php echo $row["name"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Department: </div>
            <div class="value"><?php echo $row["department"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Session: </div>
            <div class="value"><?php echo $row["session"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Semester: </div>
            <div class="value"><?php echo $row["semister"]; ?></div>
        </div>
        <form method="post">
            <button type="submit" name="exam_delete" class="ui negative button">
                Delete Exam
            </button>
        </form>
    </div>


    <?php
        $s_query = "SELECT * FROM exam_subject WHERE exam='$examid' ORDER BY id desc";
        $s_result = $conn->query($s_query);
        $s_row_count = $s_result->num_rows;
    ?>

    <?php
        if($s_row_count > 0){
    ?>
        <div class="user-label" style="margin-top: 50px;">
            <h1>Showing <?php echo $s_row_count; ?> subjects</h1>
            <a href="./add_subject.php?examid=<?php echo $examid; ?>" class="ui blue button add-user-btn">Add Subject</a>
        </div>

        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course Code</th>
                    <th>Credit</th>
                    <th>Exam Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($s_result as $row) {
                ?>
                    <tr>
                        <td data-label="Name"><?php echo $row["name"]; ?></td>
                        <td data-label="Age"><?php echo $row["code"]; ?></td>
                        <td data-label="Name"><?php echo $row["credit"]; ?></td>
                        <td data-label="Name"><?php echo $row["exam_date"]; ?></td>
                        <td data-label="Name">
                            <a href="./subject_detail.php?subjectid=<?php echo $row["id"]; ?>" class="ui positive tiny button">Detail</a>
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

    <div class="err-container" style="margin-top: 50px;">
        <h3>Not any subject found</h3>
        <a href="./add_subject.php?examid=<?php echo $examid; ?>" class="ui blue button add-user-btn">Add Subject</a>
    </div>

    <?php
        }
    ?>

	<?php
		include_once("../../footer.php");
	?>