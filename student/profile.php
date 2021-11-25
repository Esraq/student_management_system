<?php
	include_once("../header.php");
    if($_SESSION["role"] != 1){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/student/index.css" />
	<title>Student | Profile</title>
</head>
<body>
	<?php
		include_once("../grid.php");
	?>

    <?php
        $userid = $_SESSION["id"];
        $query=mysqli_query($conn, "SELECT * FROM user WHERE id = '$userid'");
        $row=mysqli_fetch_array($query);
        
        $profile_query=mysqli_query($conn, "SELECT * FROM profile WHERE user_id = '$userid'");
        $profile_num_rows=mysqli_num_rows($profile_query);
        if($profile_num_rows > 0){
            $p_query=mysqli_query($conn, "SELECT * FROM profile WHERE user_id = '$userid'");
            $profile=mysqli_fetch_array($p_query);
        }else{
            $query = "INSERT INTO profile(user_id) VALUES ('".$userid."')";
            if ($conn->query($query) === TRUE) {
                header('location: /exam/student/profile.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>

    <h1>Basic</h1>
    <div class="ui divider"></div>
    
    <div class="single-row">
        <div class="label">Username: </div>
        <div class="value"><?php echo $row["username"]; ?></div>
    </div>

    <div class="single-row">
        <div class="label">Email: </div>
        <div class="value"><?php echo $row["email"]; ?></div>
    </div>

    <h1>Profile</h1>
    <div class="ui divider"></div>


    <?php
        include_once("../variables.php");
    ?>
    

    <?php
        if(isset($_POST['submit'])){
            $department = $_POST['department'];
            $session = $_POST['session'];
            $roll = $_POST['roll'];
            $gender = $_POST['gender'];
            $current_semister = $_POST['current_semister'];
            
            $query=mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
            $num_rows=mysqli_num_rows($query);
            
            $query = "UPDATE profile SET department='$department', session='$session', roll='$roll', gender='$gender', current_semister='$current_semister' WHERE user_id='$userid'";
            if ($conn->query($query) === TRUE) {
                header("Refresh:0");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>

    <form class="ui form" method="post" style="margin-top: 30px;">
        <div class="field">
            <label>Department</label>
            <select name="department" style="width: 400px">
                <option value="">Select Department</option>
                <?php
                    foreach($department_list as $dpl){
                        if($dpl == $profile["department"]){
                            echo '<option selected value="'.$dpl.'">'.$dpl.'</option>';
                        }else{
                            echo '<option value="'.$dpl.'">'.$dpl.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="field">
            <label>Session</label>
            <select name="session" style="width: 400px">
                <option value="">Select Session</option>
                <?php
                    foreach($session_list as $sl){
                        if($sl == $profile["session"]){
                            echo '<option selected value="'.$sl.'">'.$sl.'</option>';
                        }else{
                            echo '<option value="'.$sl.'">'.$sl.'</option>';
                        }
                    }
                ?>
            </select>
        </div>
        <div class="field">
            <label>Roll</label>
            <input type="text" value="<?php echo $profile["roll"]; ?>" name="roll" placeholder="Enter roll" required style="width: 400px;" />
        </div>

        <div class="field">
            <label>Gender</label>
            <select name="gender" style="width: 400px">
                <option value="">Select Gender</option>
                <?php
                    foreach($gender_list as $gl){
                        if($gl == $profile["gender"]){
                            echo '<option selected value="'.$gl.'">'.$gl.'</option>';
                        }else{
                            echo '<option value="'.$gl.'">'.$gl.'</option>';
                        }
                    }
                ?>
            </select>
        </div>

        <div class="field">
            <label>Current Semester</label>
            <select name="current_semister" style="width: 400px">
                <option value="">Select Current Semester</option>
                <?php
                    foreach($semister_list as $semister_l){
                        if($semister_l == $profile["current_semister"]){
                            echo '<option selected value="'.$semister_l.'">'.$semister_l.'</option>';
                        }else{
                            echo '<option value="'.$semister_l.'">'.$semister_l.'</option>';
                        }
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
        <button class="ui button" name="submit" type="submit">Update</button>
    </form>

	<?php
		include_once("../footer.php");
	?>