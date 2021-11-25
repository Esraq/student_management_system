<?php
	include_once("../header.php");
	if($_SESSION["role"] != 1){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Student | Exams Detail</title>
    <style>
        .err-container{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
				.head{
					display: flex;
					justify-content: space-between;
					align-items: center;
				}
    </style>
</head>
<body>
	<?php
		include_once("../grid.php");
        $userid = $_SESSION["id"];
	?>
    <?php
        $examid = $_GET['examid'];
        $query=mysqli_query($conn, "SELECT * FROM exam WHERE id = '$examid'");
        $row=mysqli_fetch_array($query);
    ?>

    <div class="">
				<div class="head">
					<h1>Exam Detail</h1>
					<a class="ui positive button" href="./exam_marksheet.php?examid=<?php echo $examid; ?>">See Marksheet</a>
				</div>
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
        </div>

        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course Code</th>
                    <th>Credit</th>
                    <th>Exam Date</th>
                    <th>Marks</th>
                </tr>
            </thead>
            
            <tbody>
                <?php
                    foreach($s_result as $row) {
                        $subject_id = $row["id"];  
                        $m_query=mysqli_query($conn, "SELECT * FROM student_subject_relation WHERE exam='$examid' && subject='$subject_id' && student='$userid'");
                        $m_row=mysqli_fetch_array($m_query);
                ?>
                    <tr>
                        <td data-label="Name"><?php echo $row["name"]; ?></td>
                        <td data-label="Age"><?php echo $row["code"]; ?></td>
                        <td data-label="Name"><?php echo $row["credit"]; ?></td>
                        <td data-label="Name"><?php echo $row["exam_date"]; ?></td>
                        <td data-label="Name"><?php echo $m_row["marks"]; ?></td>
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
    </div>

    <?php
        }
    ?>

	<?php
		include_once("../footer.php");
	?>