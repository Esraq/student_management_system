<?php
	include_once("../../header.php");
	if($_SESSION["role"] != 2){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Faculty | Exams Detail</title>
    <style>
        .err-container{
            display: flex;
            justify-content: center;
            align-items: center;
            flex-direction: column;
        }
        @media print {
            .ppp{
                display: none !important;
            }
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

    <div class="">
        <h1 class="ppp">Exam Detail</h1>
        <div class="ui divider ppp"></div>

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
        <div class="single-row ppp">
            <button type="button" class="ui blue button" onclick="window.print();return false;">Print Remuneration</button>
        </div>
    </div>

    <?php
        $s_query = "SELECT * FROM exam_subject WHERE exam='$examid' ORDER BY id desc";
        $s_result = $conn->query($s_query);
        $s_row_count = $s_result->num_rows;
    ?>

    <?php
        $query_s=mysqli_query($conn, "SELECT * FROM settings WHERE id = 1");
        $row_s=mysqli_fetch_array($query_s);
        $db_remuneration = $row_s["remuneration"];
    ?>

    <?php
        if($s_row_count > 0){
    ?>
        <div class="user-label ppp" style="margin-top: 50px;">
            <h1>Showing <?php echo $s_row_count; ?> subjects</h1>
        </div>

        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Course Code</th>
                    <th>Credit</th>
                    <th>Remuneration (<?php echo $db_remuneration; ?>)</th>
                    <th>Total Bill(per paper=100 BDT)</th>
                    <th>Total Income</th>
                    <th>Exam Date</th>
                    <th class="ppp">Action</th>
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
                        <td data-label="Name"><?php echo $row["credit"] * $db_remuneration; ?> BDT</td>
                        <td data-label="Name">
                           <?php
                          
                          $subject_name=$row["id"];
                          $query_s=mysqli_query($conn, "SELECT COUNT(student) from student_subject_relation WHERE subject='$subject_name'");///these query is showing the total studdent
                          $row_s=mysqli_fetch_array($query_s);
                          $total = $row_s[0];
                          $result=$total*100;
                          echo "" . $result;





                           ?>
                          


                        </td>
                        <td data-label="Name">

                        
                        <?php 
                        
                        
                        
                        $query_s=mysqli_query($conn, "SELECT COUNT(student) from student_subject_relation WHERE subject=17");///these query is showing the total studdent
                        $row_s=mysqli_fetch_array($query_s);
                        $total = $row_s[0];
                        $result=$total*100;
                       $income=$row["credit"] * $db_remuneration;

                        $total=$result+$income; 
                        echo $total;
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        
                        ?> 








                        </td>
                        <td data-label="Name"><?php echo $row["exam_date"]; ?></td>
                        <td data-label="Name" class="ppp">
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