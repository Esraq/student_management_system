<?php
	include_once("../../header.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | New Users</title>
</head>
<body>
	<?php
		include_once("../../grid.php");
	?>
    
    <?php
        if(isset($_POST['submit'])){
            $user = $_POST['username'];
            $email = $_POST['email'];
            $role = $_POST['role'];
            $password = $_POST['password'];
            $password2 = $_POST['password2'];
            
            $query=mysqli_query($conn, "SELECT * FROM user WHERE username = '$user'");
            $num_rows=mysqli_num_rows($query);
            
            if($num_rows > 0){
                $err_msg = "Username exists!";
            }else{
                $query1=mysqli_query($conn, "SELECT * FROM user WHERE email = '$email'");
                $num_rows1=mysqli_num_rows($query1);
                if($num_rows1 > 0){
                    $err_msg = "Email exists!";
                }else{
                    if($password != $password2){
                        $err_msg = "Password not matched!";
                    }else{
                        $query = "INSERT INTO user
                        (username, email, role, password)
                        VALUES ('".$user."','".$email."','".$role."','".$password."')";
                        if ($conn->query($query) === TRUE) {
                            header('location: ./');
                        } else {
                            echo "Error: " . $sql . "<br>" . $conn->error;
                        }
                    }
                }
            }
        }
    ?>

    <div class="user-label">
        <h1>Add new user</h1>
    </div>

    <form class="ui form" method="post" style="margin-top: 30px;">
        <div class="field">
            <label>* Username</label>
            <input type="text" name="username" placeholder="Enter username" required style="width: 400px;" />
        </div>
        <div class="field">
            <label>* Email</label>
            <input type="email" name="email" placeholder="Enter email" required style="width: 400px;" />
        </div>
        <div class="field">
            <label>* Role</label>
            <select name="role" style="width: 400px;">
                <option value="1">Student</option>
                <option value="2">Faculty</option>
                <option value="3">Management</option>
            </select>
        </div>
        <div class="field">
            <label>* Password</label>
            <input type="password" name="password" placeholder="Enter password" required style="width: 400px;" />
        </div>
        <div class="field">
            <label>* Retype Password</label>
            <input type="password" name="password2" placeholder="Retype password" required style="width: 400px;" />
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

	<?php
		include_once("../../footer.php");
	?>