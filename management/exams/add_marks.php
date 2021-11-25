<?php
	include_once("../../header.php");
	if($_SESSION["role"] != 2){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Faculty | Subject Detail</title>
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
        $subjectid = $_GET['subjectid'];
        $student_subject_id = $_GET['student_subject'];

        $query=mysqli_query($conn, "SELECT * FROM exam_subject WHERE id = '$subjectid'");
        $row=mysqli_fetch_array($query);
        $exam_id = $row["exam"];
        
        $e_query=mysqli_query($conn, "SELECT * FROM exam WHERE id = '$exam_id'");
        $e_row=mysqli_fetch_array($e_query);

        $studentid = $_GET['student'];
        $s_query=mysqli_query($conn, "SELECT * FROM user WHERE id = '$studentid'");
        $s_row=mysqli_fetch_array($s_query);
    ?>

    <div class="">
        <h1>Subject Detail</h1>
        <div class="ui divider"></div>

        <div class="single-row">
            <div class="label">Exam Name: </div>
            <div class="value"><?php echo $e_row["name"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Department: </div>
            <div class="value"><?php echo $e_row["department"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Session: </div>
            <div class="value"><?php echo $e_row["session"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Semester: </div>
            <div class="value"><?php echo $e_row["semister"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Course Name: </div>
            <div class="value"><?php echo $row["name"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Course Code: </div>
            <div class="value"><?php echo $row["code"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Credit: </div>
            <div class="value"><?php echo $row["credit"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Exam Date: </div>
            <div class="value"><?php echo $row["exam_date"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Student Name: </div>
            <div class="value"><?php echo $s_row["username"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Student Email: </div>
            <div class="value"><?php echo $s_row["email"]; ?></div>
        </div>

        <?php
            if(isset($_POST['submit'])){
                $marks = $_POST['marks'];
                $query = "UPDATE student_subject_relation SET marks='$marks' WHERE id='$student_subject_id' && student='$studentid' && subject='$subjectid'";
                if ($conn->query($query) === TRUE) {
                    // header('location: ./');
                    header('location: /exam/faculty/exams/subject_detail.php?subjectid='.$subjectid);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        ?>

        <h1>Add marks</h1>
        <div class="ui divider"></div>

        <form class="ui form" method="post" style="margin-top: 30px;">
            <div class="field">
                <label>* Marks</label>
                <input type="number" name="marks" placeholder="Enter marks" required style="width: 400px;" />
            </div>

            <?php	
            if(isset($err_msg)){
                echo '<div class="ui red message">';
                echo "*".$err_msg;
                echo '</div>';
            }
            ?>
            <button class="ui button" name="submit" type="submit">Add</button>
        </form>
    </div>

	<?php
		include_once("../../footer.php");
	?>