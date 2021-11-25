<?php
	include_once("../header.php");
	if($_SESSION["role"] != 1){
		header("Location: /exam/login.php");
	}
?>
    <link rel="stylesheet" type="text/css" href="/exam/css/admin/index.css" />
	<title>Student | Exams Marksheet</title>
    <style>
      /* .printable{
				display: flex;
				width: 70%;
				border: 1px solid red;
				margin: 0 auto;
				height: 500px;
			} */
			/* body{
				background-color: #c5cae9;
				padding: 25px;
			} */

			@media print {
				.printable-row{
					display: none !important;
				}
			}

			.container{
				width: 720px;
				min-height: 440px;
				margin: 0 auto;
				padding-bottom: 20px;
				padding-left: 32px;
				padding-right: 32px;
				padding-top: 40px;
				border-radius: 12px;
				background-color: #90a4ae;
				font-family: Lato;
			}

			.summery{

			}

			.container h2{
				text-align: center;
			}

			table{
				width: 100%;
				margin: 0 auto;
			}

			td, th {
				padding: 12px;
				border: 2px dotted;
			}

    </style>
</head>
<body>
	<?php
    $userid = $_SESSION["id"];
		$total_credit_get = 0;
		$total_subject_credit = 0;
	?>
    <?php
        $examid = $_GET['examid'];
        $query=mysqli_query($conn, "SELECT * FROM exam WHERE id = '$examid'");
        $row=mysqli_fetch_array($query);
    ?>

		<?php
        $query_s=mysqli_query($conn, "SELECT * FROM profile WHERE user_id = '$userid'");
        $row_s=mysqli_fetch_array($query_s);
    ?>

    <div class="printable">
			<div class="container">
				<div class="summery">
					<div class="single-row">
						<div class="label">Name: </div>
						<div class="value"><?php echo $_SESSION["username"]; ?></div>
					</div>
					<div class="single-row">
						<div class="label">Roll: </div>
						<div class="value"><?php echo $row_s["roll"]; ?></div>
					</div>
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
				</div>
				
				<?php
					$s_query = "SELECT * FROM exam_subject WHERE exam='$examid' ORDER BY id desc";
					$s_result = $conn->query($s_query);
					$s_row_count = $s_result->num_rows;
				?>

				<?php
        	if($s_row_count > 0){
    		?>
					<table>
						<thead>
							<tr>
								<th>Subject Name</th>
								<th>Course Code</th>
								<th>Credit</th>
								<th>Grade</th>
							<tr>  
						</thead>
						<tbody>
							<?php
								foreach($s_result as $row) {
										$subject_id = $row["id"];  
										$m_query=mysqli_query($conn, "SELECT * FROM student_subject_relation WHERE exam='$examid' && subject='$subject_id' && student='$userid'");
										$m_row=mysqli_fetch_array($m_query);
							?>
								<?php 
									$total_subject_credit += $row["credit"];
								?>
								<tr>
									<td><?php echo $row["name"]; ?></td>
									<td><?php echo $row["code"]; ?></td>
									<td><?php echo $row["credit"]; ?></td>
									<td>
										<?php 
											$marks = $m_row["marks"];
											if($marks > 79){
												echo "A+";
												$total_credit_get += 4 * $row["credit"];
											}else if($marks > 74 && $marks < 80){
												echo "A";
												$total_credit_get += 3.75 * $row["credit"];
											}else if($marks > 69 && $marks < 75){
												echo "A-";
												$total_credit_get += 3.5 * $row["credit"];
											}else if($marks > 64 && $marks < 70){
												echo "B+";
												$total_credit_get += 3.25 * $row["credit"];
											}else if($marks > 59 && $marks < 65){
												echo "B";
												$total_credit_get += 3 * $row["credit"];
											}else if($marks > 54 && $marks < 60){
												echo "B-";
												$total_credit_get += 2.75 * $row["credit"];
											}else if($marks > 49 && $marks < 55){
												echo "C+";
												$total_credit_get += 2.5 * $row["credit"];
											}else if($marks > 44 && $marks < 50){
												echo "C";
												$total_credit_get += 2.25 * $row["credit"];
											}else if($marks > 39 && $marks < 45){
												echo "D";
												$total_credit_get += 2 * $row["credit"];
											}else if($marks < 40){
												echo "F";
												$total_credit_get += 0 * $row["credit"];
											}
										?>
									</td>
								</tr>
							<?php
								}
							?>
						</tbody>
					</table>

					<div class="single-row" style="margin-top: 20px;">
						<div class="label">Total Grade: </div>
						<div class="value"><?php echo round($total_credit_get / $total_subject_credit, 2); ?></div>
					</div>
					<div class="single-row printable-row" style="margin-top: 20px;">
						<button type="button" class="ui blue button print">Print</button>
					</div>
					<div class="single-row printable-row" style="margin-top: 20px;">
						<a href="./exam_detail.php?examid=<?php echo $examid; ?>" class="ui grey button">Back</a>
					</div>
				<?php
        	}
    		?>
			</div>
    </div>


    <?php
        $s_query = "SELECT * FROM exam_subject WHERE exam='$examid' ORDER BY id desc";
        $s_result = $conn->query($s_query);
        $s_row_count = $s_result->num_rows;
    ?>

	<?php
		include_once("../footer.php");
	?>

	<script>
		$(".print").click(function(){
			window.print();
		})
	</script>