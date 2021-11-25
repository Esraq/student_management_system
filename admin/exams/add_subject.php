<?php
	include_once("../../header.php");
    include_once("../../variables.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | New Subject</title>
</head>
<body>
	<?php
		include_once("../../grid.php");
        $examid = $_GET['examid'];
        $query=mysqli_query($conn, "SELECT * FROM exam WHERE id = '$examid'");
        $row=mysqli_fetch_array($query);
        
        $e_department = $row["department"];
        $e_session = $row["session"];
        $e_semister = $row["semister"];
	?>

    <?php
        $m_query = "SELECT * FROM user WHERE role=2 ORDER BY id desc";
        $m_results = $conn->query($m_query);
        $m_results_count = $m_results->num_rows;
	?>
    
    <?php
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $code = $_POST['code'];
            $credit = $_POST['credit'];
            $exam_date = $_POST['exam_date'];
            $management = $_POST['management'];
            $exam_id_int = (int)$examid;
            
            $query=mysqli_query($conn, "SELECT * FROM exam_subject WHERE exam='$examid' AND code = '$code'");
            $num_rows=mysqli_num_rows($query);
            
            if($num_rows > 0){
                $err_msg = "Subject exists!";
            }else{
                $query = "INSERT INTO exam_subject
                (name, code, credit, exam_date, management, exam)
                VALUES ('".$name."','".$code."','".$credit."','".$exam_date."', '".$management."', '".$exam_id_int."')";
                if ($conn->query($query) === TRUE) {
                    $exam_sub_id = $conn->insert_id;

                    //add student to subject student relation
                    $s_query = "SELECT * FROM profile WHERE department='$e_department' AND session='$e_session' AND current_semister='$e_semister'";
                    $s_result = $conn->query($s_query);
                    $s_row_count = $s_result->num_rows;
                    foreach($s_result as $s_row) {
                        $user_id = $s_row["user_id"];
                        $x_query = "INSERT INTO student_subject_relation
                        (student, subject, exam)
                        VALUES ('".$user_id."','".$exam_sub_id."','".$examid."')";
                        if ($conn->query($x_query) === TRUE) {

                        }else{
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }

                    $link_text = "?examid=".$examid;
                    header('location: ./exam_detail.php'.$link_text);
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    ?>

    <div class="user-label">
        <h1>Add new subject</h1>
    </div>

    <form class="ui form" method="post" style="margin-top: 30px;">
        <div class="field">
            <label>Subject Name</label>
            <input type="text" name="name" placeholder="Enter name" required style="width: 400px;" />
        </div>

        <div class="field">
            <label>Subject Code</label>
            <input type="text" name="code" placeholder="Enter subject code" required style="width: 400px;" />
        </div>
        <div class="field">
            <label>Credit</label>
            <input type="number" name="credit" placeholder="Enter credit" required style="width: 400px;" />
        </div>

        <div class="field">
            <label>Exam Date</label>
            <input type="text" name="exam_date" placeholder="Enter exam date (2021-10-12)" required style="width: 400px;" />
        </div>

        <div class="field">
            <label>Faculty</label>
            <select required name="management" style="width: 400px">
                <option value="">Select Faculty</option>
                <?php
                    foreach($m_results as $m_results_l){
                ?>
                    <option value="<?php echo $m_results_l['id']; ?>">
                        <?php echo $m_results_l["username"];?>
                    </option>
                <?php
                    }
                ?>
            </select>
        </div>

        <?php	
        if(isset($err_msg)){
            echo '<div class="ui red message">';
            echo "*".$err_msg;
            echo '</div>';
        }
        ?>
        <button class="ui button" name="submit" type="submit">Create</button>
    </form>

	<?php
		include_once("../../footer.php");
	?>