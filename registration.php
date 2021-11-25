<?php
	ob_start();
	include('xss.php');
	include('db_connect.php');
?>

<!doctype html>
<html>
	<head>
		<title>Registration</title>
		<link rel="stylesheet" type="text/css" href="style/registration.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/semantic-ui@2.4.2/dist/semantic.min.css">
	</head>
	
	<body>
		<?php
			if(isset($_POST['reg-btn'])){
				$username = xss($_POST['username']);
				$email = xss($_POST['email']);
				$phone = xss($_POST['phone']);
				$birth = xss($_POST['birth']);
				$gender = xss($_POST['gender']);
				$password = xss($_POST['reg-password']);
				$password_again = xss($_POST['reg-password-again']);
				$status = "normal";

				if(strlen($username) != 0){
					if(strlen($email) != 0){
						if(filter_var($email, FILTER_VALIDATE_EMAIL)) {
							if(strlen($phone) != 0){
								if(strlen($birth) != 0){
									if($gender != "Select Gender"){
										if(strlen($password) > 4){
											if($password == $password_again){

												$result = $conn->prepare("select count(id) from users where username=:username or email=:email");
												$result->bindParam(':username', $username, PDO::PARAM_INT);
												$result->bindParam(':email', $email, PDO::PARAM_INT);
												$result->execute();
												$total_found = $result->fetchColumn();

												if($total_found == 0){

													$sql = 'INSERT into users(username, email, phone, birth, gender, password, status) values("'. $username .'", "'. $email .'", "'. $phone .'", "'. $birth .'", "'. $gender .'", "'. $password .'", "'. $status .'")';
													$conn->query($sql);

													header('location: /login.php');
												}else{
													$err_msg = "User already exist ! Same username or email found.";
												}
											}else{
												$err_msg = "Password not matched !";
											}
										}else{
											$err_msg = "Password is too short !";
										}
									}else{
										$err_msg = "Select Gender !";
									}	
								}else{
									$err_msg = "Enter your date of birth !";
								}
							}else{
								$err_msg = "Enter your phone !";
							}
						}else{
							$err_msg = "Email address not valid !";
						}	
					}else{
						$err_msg = "Enter your Email !";
					}
				}else{
					$err_msg = "Enter your username !";
				}
			}
		?>

		<form action="" method="post">
			<div class="reg">
				<p>
					<label style="width: 100%; border-bottom: 2px solid gray;font-size: 20px;">User Registration</label>
				</p>

				<p>
					<label for="username">Username : </label>
					<input type="text" name="username" class="username" placeholder="Username" value="<?php if(isset($_POST['username'])){ echo $_POST['username']; } ?>" />
				</p>

				<p>
					<label for="email">Email : </label>
					<input type="text" name="email" class="email" placeholder="Email" value="<?php if(isset($_POST['email'])){ echo $_POST['email']; } ?>" />
				</p>

				<p>
					<label for="phone">Phone : </label>
					<input type="text" name="phone" class="phone" placeholder="Phone" value="<?php if(isset($_POST['phone'])){ echo $_POST['phone']; } ?>" />
				</p>

				<p>
					<label for="birth">Date of Birth : </label>
					<input type="text" name="birth" class="birth" placeholder="Date of birth ( dd-mm-yy )" value="<?php if(isset($_POST['birth'])){ echo $_POST['birth']; } ?>" />
				</p>

				<p>
					<label for="gender">Gender : </label>
					
					<select name="gender" class="gender">
						<option>Select Gender</option>
						<option>Male</option>
						<option>Female</option>
					</select>
				</p>

				<p>
					<label for="reg-password">Password : </label>
					<input type="password" name="reg-password" class="reg-password" placeholder="Password" />
				</p>

				<p>
					<label for="reg-password-again">Password Again : </label>
					<input type="password" name="reg-password-again" class="reg-password-again" placeholder="Password Again" />
				</p>

				<input type="hidden" name="valid" value="<?php echo $request->hash; ?>" />

				<p style="background-color: white;">
					<button type="submit" name="reg-btn" class="reg-btn">Registered</button>
				</p>

				<div style="font-size: 12px;" class="reg-err_msg" id="show">
					
				</div>

					<?php
						if(isset($err_msg)){
							echo '<div style="font-size: 12px;" class="reg-err_msg">';
								echo "*".$err_msg;
							echo '</div>';
						}

						if(isset($success_msg)){
							echo '<div class="reg-err_msg">';
								echo "<h1>".$success_msg."</h1";
							echo '</div>';
						}
					?>
				<p>
					<label style="width: 100%;font-size: 14px;">*Already registred, Login <a style="color: orange;" href="login.php">here</a></label>
				</p>

				<div class="footer">
					<p style="font-size: 12px;margin-left: 20px;margin-top: 5px;line-height: 55px;">Developed by mubarak</p>
				</div>
			</div>	
		</form>
	</body>
</html>
<?php
	ob_end_flush();
?>