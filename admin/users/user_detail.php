<?php
	include_once("../../header.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | User Detail</title>
</head>
<body>
	<?php
		include_once("../../grid.php");
	?>
    <?php
        $userid = $_GET['userid'];
        $query=mysqli_query($conn, "SELECT * FROM user WHERE id = '$userid'");
        $row=mysqli_fetch_array($query);
    ?>

    <?php
        if(isset($_POST['user_delete'])){
            $sql = "DELETE FROM user WHERE id='$userid'";
            if ($conn->query($sql) === TRUE) {
                header('location: ./');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>

    <div class="">
        <h1>User: <?php echo $row["username"]; ?></h1>
        <div class="ui divider"></div>

        <div class="single-row">
            <div class="label">Username: </div>
            <div class="value"><?php echo $row["username"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Email: </div>
            <div class="value"><?php echo $row["email"]; ?></div>
        </div>
        <div class="single-row">
            <div class="label">Role: </div>
            <div class="value"><?php 
                if($row["role"] == 1){
                    echo "Student";
                }else if($row["role"] == 2){
                    echo "Faculty";
                }else if($row["role"] == 3){
                    echo "Management";
                }
            ?></div>
        </div>
        <form method="post">
            <button type="submit" name="user_delete" class="ui negative button">
                Delete user
            </button>
        </form>
    </div>

	<?php
		include_once("../../footer.php");
	?>