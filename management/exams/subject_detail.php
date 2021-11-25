<?php
	include_once("../../header.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | Subject Detail</title>
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
        $query=mysqli_query($conn, "SELECT * FROM exam_subject WHERE id = '$subjectid'");
        $row=mysqli_fetch_array($query);
        $management_id = $row["management"];
    ?>

    <?php
        $examid = $row["exam"];
        $e_query=mysqli_query($conn, "SELECT * FROM exam WHERE id = '$examid'");
        $e_row=mysqli_fetch_array($e_query);
    ?>

    <?php
        $query_s=mysqli_query($conn, "SELECT * FROM settings WHERE id = 1");
        $row_s=mysqli_fetch_array($query_s);
        $db_remuneration = $row_s["remuneration"];
    ?>

    <?php
        $query_s=mysqli_query($conn, "SELECT * FROM user WHERE id = '$management_id'");
        $row_s=mysqli_fetch_array($query_s);
        $management_name = $row_s["username"];
    ?>

    <?php
        if(isset($_POST['subject_delete'])){
            $sql = "DELETE FROM exam_subject WHERE id='$subjectid'";
            if ($conn->query($sql) === TRUE) {
                $link_text = "?examid=".$examid;
                header('location: ./exam_detail.php'.$link_text);
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>

    <div class="">
        <h1>Subject Detail</h1>
        <div class="ui divider"></div>

        <div class="single-row">
            <div class="label">Exam Name: </div>
            <div class="value"><?php echo $e_row["name"]; ?></div>
        </div>

        <div class="single-row">
            <div class="label">Subject Name: </div>
            <div class="value"><?php echo $row["name"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Subject Code: </div>
            <div class="value"><?php echo $row["code"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Credit: </div>
            <div class="value"><?php echo $row["credit"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Remuneration: </div>
            <div class="value"><?php echo $row["credit"] * $db_remuneration; ?> BDT</div>
        </div>
        <div class="single-row">
            <div class="label">Faculty: </div>
            <div class="value"><?php echo $management_name; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Exam Date: </div>
            <div class="value"><?php echo $row["exam_date"]; ?></div>
        </div>
        <form method="post">
            <button type="submit" name="subject_delete" class="ui negative button">
                Delete Subject
            </button>
        </form>
    </div>

	<?php
		include_once("../../footer.php");
	?>