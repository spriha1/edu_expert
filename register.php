<?php 
	session_start();
	if (isset($_SESSION['username'])) {
		session_unset();
	}
	include_once 'header.html';
?>
<body class="body1">
	<?php include_once 'send_verification_mail.php'; ?>
	<div class="container">
		<br><br>
	<div class="d-flex justify-content-center">
		<div class="card bg-light" style="width: 30%">
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
						<input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php echo $username_msg; ?> </p>
					</div>
					<div class="input-group form-group">
						<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
						<input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
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
					        <option value="Teacher">Teacher</option>
					        <option value="Student">Student</option>
				      	</select>
					</div>
					<div style="text-align: center;">
						<p style="color: #ff0000;"> <?php echo $user_type_msg; ?> </p>
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
</body>
</html>