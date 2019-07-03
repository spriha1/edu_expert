<?php 
	include_once 'header.html';
?>
<body>
	<?php include_once 'send_verification_mail.php'; ?>
	<div class="container" style="text-align: center">
		<h1>Create Account </h1>
		<p style="color: #ff0000;"> <?php echo $msg; ?> </p>
		<div class="card bg-secondary mx-auto" style="width: 50%">
			<div class="card-body">
				<form method="POST" action="">
				    <div class="form-group">
				      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
				    </div>
				    <div class="form-group">
				      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
				    </div>
				    <div class="form-group">
				      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
				    </div>
				    <div class="form-group">
				      <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
				    </div>
				    <div class="form-group">
				      <input type="password" class="form-control" id="password" placeholder="Enter Password" name="password">
				    </div>
				    <div class="form-group">
					    <select class="form-control" id="user_type" name="user_type">
					        <option value="0">Select User Type</option>
					        <option value="Teacher">Teacher</option>
					        <option value="Student">Student</option>
				      	</select>
				    </div>
				    <div class="form-group">
				    	<button type="submit" class="btn btn-success">Submit</button>
				    </div>
				    <p>Already have an account? <a href="index.php" style="color: #000000">Log In</a></p> 
				</form>
			</div>
		</div>
	</div>
	
</body>
</html>