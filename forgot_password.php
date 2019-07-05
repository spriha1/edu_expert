<?php 
	session_start();
	if (isset($_SESSION['username'])) {
		include_once 'db_credentials.php';
    	include_once 'db_connection.php';
    	$obj = new DB_connect();
        $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
        $query = "SELECT user_type FROM user_types WHERE id = (SELECT user_type_id FROM users WHERE username = '".$_SESSION['username']."')";

        $result = $obj->select_records($query);
        foreach ($result as $key => $value) {
        	if ($value['user_type']== "Admin") {
        		header("Location:admin_dashboard.php");
        	}
        	else if ($value['user_type']== "Student") {
        		header("Location:student_dashboard.php");
        	}
        	else if ($value['user_type']== "Teacher") {
        		header("Location:teacher_dashboard.php");
        	}
        }
	}
	include_once 'header.html';?>
	<body class="body1">
		<?php include_once 'send_password_mail.php';	?>
		<br><br>
		<div class="container" style="text-align: center">
			<div class="card bg-light mx-auto" style="width: 30%">
    			<div class="card-header">
    				<h3>Forgot Password ? </h3>
					<p style="color : #ff0000"> <?php echo $msg; ?> </p>
				</div>
				<div class="card-body">
					<form method="POST" action="">
					    <div class="input-group form-group">
					    	<div class="input-group-prepend">
								<span class="input-group-text"><i class="fas fa-user"></i></span>
							</div>
					      	<input type="text" class="form-control" id="username" placeholder="Enter Your Username" name="username">
					  	</div>
					    <div class="form-group">
					    	<button type="submit" class="btn btn-success">Reset Password</button>
					    	<button formaction="index.php" class="btn btn-success">Go Back</button>
					    </div>
					</form>
				</div>
			</div>
		</div>

	</body>
</html>