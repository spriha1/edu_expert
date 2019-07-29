<?php 
	session_start();
	include_once 'check_login_status.php';
	include_once 'header.html';
	// include_once 'send_verification_mail.php';
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	include_once 'static_file_version.php';
?>
<body class="body1">
	<div class="container">
	<br><br>
	<div class="d-flex justify-content-center">
		<div class="card bg-light responsive">
			<div class="card-header" style="text-align: center;">
				<h4>Create Account </h4>
				<p style="color: #ff0000;"> <?php //echo $msg; ?> </p>
			</div>
			<div class="card-body">
				<form method="POST" action="" id="registration" name="registration">
					<div id="alert" class='alert alert-danger' style="display: none;">
				    </div>
				    <div id="info" class='alert alert-info' style="display: none;">
				    </div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="fname" placeholder="Your First Name" name="fname">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php //echo $firstname_msg; ?> </p>	
					</div>

					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="lname" placeholder="Your Last Name" name="lname">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php //echo $lastname_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-envelope"></i></span>
						</div>
						<input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php //echo $email_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
						<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php //echo $username_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input autocomplete="off" type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php //echo $password_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-users"></i></span>
						</div>
						<select class="form-control" id="user_type" name="user_type">
					        <option value="0">Select User Type</option>
					        <?php 
								$obj = new DB_connect();
	            				$query = "SELECT user_type FROM user_types WHERE user_type != 'Admin'";
	            				$result = $obj->select_records($conn, $query);
	            				foreach ($result as $key => $value) {
	            					echo '<option value="'.$value['user_type'].'">'.$value['user_type'].'</option>';
	            				}
							?>
				      	</select>
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php //echo $user_type_msg; ?> </p>
					</div>
					<div class="form-group">
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
	<script src="<?php autoVer('/scripts/validate.js'); ?>"></script>
</body>
</html>