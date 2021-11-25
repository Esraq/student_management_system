<?php
	include_once("../../header.php");
    include_once("../../variables.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | New Exam</title>
</head>
<body>
	<?php
		include_once("../../grid.php");
        $m_query = "SELECT * FROM user WHERE role=2 ORDER BY id desc";
        $m_results = $conn->query($m_query);
        $m_results_count = $m_results->num_rows;
	?>
    
    <?php
        if(isset($_POST['submit'])){
            $name = $_POST['name'];
            $department = $_POST['department'];
            $session = $_POST['session'];
            $semister = $_POST['semister'];
            $management = $_POST['management'];
            
            $query=mysqli_query($conn, "SELECT * FROM exam WHERE department = '$department' AND session = '$session' AND semister = '$semister'");
            $num_rows=mysqli_num_rows($query);
            
            if($num_rows > 0){
                $err_msg = "Exam exists!";
            }else{
                $query = "INSERT INTO exam
                (department, session, semister, name, management)
                VALUES ('".$department."','".$session."','".$semister."','".$name."', '".$management."')";
                if ($conn->query($query) === TRUE) {
                    header('location: ./');
                } else {
                    echo "Error: " . $sql . "<br>" . $conn->error;
                }
            }
        }
    ?>

    <div class="user-label">
        <h1>Add new exam</h1>
    </div>

    <form class="ui form" method="post" style="margin-top: 30px;">
        <div class="field">
            <label>Exam Name</label>
            <input type="text" name="name" placeholder="Enter name" required style="width: 400px;" />
        </div>

        <div class="field">
            <label>Department</label>
            <select required name="department" style="width: 400px">
                <option value="">Select Department</option>
                <?php
                    foreach($department_list as $dpl){
                        echo '<option value="'.$dpl.'">'.$dpl.'</option>';
                    }
                ?>
            </select>
        </div>
        <div class="field">
            <label>Session</label>
            <select required name="session" style="width: 400px">
                <option value="">Select Session</option>
                <?php
                    foreach($session_list as $sl){
                        echo '<option value="'.$sl.'">'.$sl.'</option>';
                    }
                ?>
            </select>
        </div>

        <div class="field">
            <label>Semester</label>
            <select required name="semister" style="width: 400px">
                <option value="">Select Semester</option>
                <?php
                    foreach($semister_list as $semister_l){
                        echo '<option value="'.$semister_l.'">'.$semister_l.'</option>';
                    }
                ?>
            </select>
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