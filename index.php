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
	include_once 'header.html';
	include_once 'login.php'; 
?>
<body class="body1">
	<div class="container" style="text-align: center">
		<br>
		<br>
		<div class="card bg-light mx-auto" style="width: 30%">
			<div class="card-header">
				<h3>Sign In</h3>
			</div>
			<div class="card-body">
				<p style="color:#ff0000;"><?php echo $msg; ?></p>
		    	<form action="" method="POST">
		    		<div class="input-group form-group">
				    	<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-user"></i></span>
						</div>
				      	<input class="form-control" id="username" name="username" type="text" placeholder="Enter Username">
				  	</div>
				  	<div>
				  		<p style="color:#ff0000;"><?php echo $username_msg; ?></p>
				  	</div>
		    	    <div class="input-group form-group">
				    	<div class="input-group-prepend">
							<span class="input-group-text"><i class="fas fa-key"></i></span>
						</div>
				      	<input class="form-control" id="password" name="password" type="password" placeholder="Enter Password">
				  	</div>
		    	    <div>
				  		<p style="color:#ff0000;"><?php echo $password_msg; ?></p>
				  	</div>
		    	    <button class="btn btn-success form-control" type="submit">Login</button>
		    	   
		    	</form>
		    	<br>
		    	<a href="forgot_password.php" style="padding: 15px" >Forgot Password?</a>
		    	<a href="register.php">Signup</a>
    		</div>
    	<div>
    </div>
	<?php include_once 'db_tables_creation.php'; ?>
</body>
</html>