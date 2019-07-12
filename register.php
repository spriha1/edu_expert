<?php 
	session_start();
	include_once 'check_login_status.php';
	include_once 'header.html';
	require_once 'csrf_token.php'; 
?>
<body class="body1">
	<?php 
		include_once 'send_verification_mail.php';
		$tooltip_msg = "The password : 
		Must be a minimum of 8 characters
		Must contain at least 1 number
		Must contain at least one uppercase character
		Must contain at least one lowercase character";
	 ?>
	<div class="container">
	<br><br>
	<div class="d-flex justify-content-center">
		<div class="card bg-light responsive">
			<div class="card-header" style="text-align: center;">
				<h4>Create Account </h4>
				<p style="color: #ff0000;"> <?php echo $msg; ?> </p>
			</div>
			<div class="card-body">
				<form method="POST" action="">
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="fname" placeholder="Your First Name" name="fname">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php echo $firstname_msg; ?> </p>	
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="lname" placeholder="Your Last Name" name="lname">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php echo $lastname_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php echo $email_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="username" data-toggle="tooltip" title="The username can contain letters, digits, @ and _" placeholder="Enter Username" name="username">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php echo $username_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" id="password" data-toggle="tooltip" title="<?php echo $tooltip_msg; ?>" placeholder="Enter Password" name="password">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php echo $password_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-users"></i></span>
						</div>
						<select class="form-control" id="user_type" name="user_type">
					        <option value="0">Select User Type</option>
					        <?php 
								include_once 'db_credentials.php';
								include_once 'db_connection.php';
								$obj = new DB_connect();
	            				$conn = $obj->connect($server_name,$db_name,$db_username,$db_password);
	            				$query = "SELECT user_type FROM user_types WHERE user_type != 'Admin'";
	            				$result = $obj->select_records($query);
	            				foreach ($result as $key => $value) {
	            					echo '<option value="'.$value['user_type'].'">'.$value['user_type'].'</option>';
	            				}
							?>
				      	</select>
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php echo $user_type_msg; ?> </p>
					</div>
					<div class="form-group">
						<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				    	<button type="submit" class="btn btn-success btn-block">Register</button>
				    </div>
				</form>
			</div>
			<div class="card-footer">
				<div class="d-flex justify-content-center links">
					<p>Already have an account? <a href="index.php" style="color: #000000">Log In</a></p>
				</div>
			</div>
		</div>
	</div>
</body>
</html>