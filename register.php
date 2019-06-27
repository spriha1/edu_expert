<?php include 'header.html';?>
	<body>
		<?php
			$msg = "";
			if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['fname']) && !empty($_POST['fname']) AND isset($_POST['lname']) && !empty($_POST['lname']) AND isset($_POST['password']) && !empty($_POST['password'])){
				$username = $_POST['username'];
				$email = $_POST['email'];
				$firstname = $_POST['fname'];
				$lastname = $_POST['lname'];
				$password = $_POST['password'];
				$server = "localhost";
				$db = "php_project";
				$uname = "spriha";
				$pass = "mindfire";
				$msg = "Please verify it by clicking the activation link that has been send to your email.";
				$hash = md5(uniqid());

				$conn = new PDO("mysql:host=$server;dbname=$db", $uname, $pass);
			    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
				$sql = "INSERT INTO users (firstname, lastname, email, username, password, verify_hash)
			    VALUES ('".$firstname."','".$lastname."','".$email."','".$username."','".$password."','".$hash."')";

			    $conn->exec($sql);

			    $to = $email;
				$subject = 'Signup | Verification';
				$message = '
				 
				Thanks for signing up!
				Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
				 
				------------------------
				Username: '.$username.'
				Password: '.$password.'
				------------------------
				 
				Please click this link to activate your account:
				php.project.com/verify.php?email='.$email.'&hash='.$hash.'
				 
				';
				                     
				$headers = 'From:php.project.com' . "\r\n";
				mail($to, $subject, $message, $headers);
										
			}
			
				
		?>
		<div class="container" style="text-align: center">
			<h1>Create Account </h1>
			<p> <?php echo $msg; ?> </p>
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
						        <option>Select User Type</option>
						        <option>Teacher</option>
						        <option>Student</option>
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