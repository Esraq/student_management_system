<?php
	include_once("../../header.php");
    include_once("../../variables.php");
    if($_SESSION["role"] != 3){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Management | Edit Settings</title>
</head>
<body>
    <?php
        include_once("../../grid.php");
        $query1=mysqli_query($conn, "SELECT * FROM settings WHERE id = 1");
        $row=mysqli_fetch_array($query1);
        $db_remuneration = $row["remuneration"];
    ?>    
    <?php
        if(isset($_POST['submit'])){
            $remuneration = $_POST['remuneration'];
            
            $query = "UPDATE settings SET remuneration='$remuneration' WHERE id=1";
            if ($conn->query($query) === TRUE) {
                header('location: /exam/management/exams/settings.php');
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    ?>

    <div class="user-label">
        <h1>Edit Settings</h1>
    </div>

    <form class="ui form" method="post" style="margin-top: 30px;">
        <div class="field">
            <label>Remuneration Per Credit</label>
            <input 
                type="number" 
                name="remuneration" 
                placeholder="Enter remuneration per credit" 
                required 
                style="width: 400px;" 
                value="<?php echo $db_remuneration; ?>"
            />
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
		include_once("../../footer.php");
	?>