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
        $query=mysqli_query($conn, "SELECT * FROM exam_subject WHERE id = '$subjectid'");
        $row=mysqli_fetch_array($query);
        $exam_id = $row["exam"];
        
        $e_query=mysqli_query($conn, "SELECT * FROM exam WHERE id = '$exam_id'");
        $e_row=mysqli_fetch_array($e_query);
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
    </div>


    <?php
        // use PHPMailer\PHPMailer\PHPMailer;
        // use PHPMailer\PHPMailer\Exception;
        // include '../../PHPMailer/Exception.php';
        include '../../PHPMailer/PHPMailer.php';
        include '../../PHPMailer/SMTP.php';

        if(isset($_POST['send_result_email'])){
            $user_email = $_POST['user_email'];
            $mail = new PHPMailer(true);
            
            $email_body = "
                <p>Hi,</p>
                <p>Result for exam: ". $e_row["name"] ."</p>
                <p>Department: ". $e_row["department"] ."</p>
                <p>Session: ". $e_row["session"] ."</p>
                <p>Semester: ". $e_row["semister"] ."</p>
                <p>Course name: ". $row["name"] ."</p>
                <p>Course Code: ". $row["code"] ."</p>
                <p>Has been published</p>
            ";

            try {
                //Server settings
                // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      
                $mail->isSMTP();                                            //Send using SMTP
                $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                $mail->Username   = 'mubarakamirplaycard@gmail.com';                     //SMTP username
                $mail->Password   = 'nstu1234~!@';                               //SMTP password
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom('mubarak117136@gmail.com', 'Faculty');
                $mail->addAddress($user_email, '');     //Add a recipient

                //Content
                $mail->isHTML(true);                                  //Set email format to HTML
                $mail->Subject = 'Result has been published!';
                $mail->Body    = $email_body;

                $mail->send();
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        }
    ?>


    <?php
        $s_query = "SELECT student_subject_relation.id, student_subject_relation.student, student_subject_relation.marks, user.username, user.email from student_subject_relation INNER JOIN user ON student_subject_relation.student=user.id WHERE student_subject_relation.subject='$subjectid'";
        $s_result = $conn->query($s_query);
        $s_row_count = $s_result->num_rows;
    ?>

    <?php
        if($s_row_count > 0){
    ?>
        <div class="user-label" style="margin-top: 50px;">
            <h1>Showing <?php echo $s_row_count; ?> students</h1>
        </div>

        <table class="ui celled table">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Marks</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    foreach($s_result as $row) {
                ?>
                    <tr>
                        <td data-label="Name"><?php echo $row["username"]; ?></td>
                        <td data-label="Age"><?php
                            if($row["marks"]){
                                echo $row["marks"];
                            }else{
                                echo "Not add";
                            }
                        ?></td>
                        <td data-label="Name">
                            <a href="./add_marks.php?subjectid=<?php echo $subjectid; ?>&student_subject=<?php echo $row["id"]; ?>&student=<?php echo $row["student"]; ?>" class="ui positive tiny button">Add marks</a>
                            <form style="margin-top: 10px;" method="post">
                                <input type="hidden" name="user_email" value="<?php echo $row['email']; ?>" />
                                <button name="send_result_email" class="ui red tiny button">Send Result Email</button>
                            </form>
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
        <h3>Not any student found</h3>
    </div>

    <?php
        }
    ?>

	<?php
		include_once("../../footer.php");
	?>