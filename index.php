<?php 
	session_start();
	include_once 'check_login_status.php';
	include_once 'header.html';
	require_once 'csrf_token.php'; 
	include_once 'login.php';
	include_once 'db_tables_creation.php';
?>
<body class="body1">
	<div class="container" style="text-align: center">
		<br>
		<br>
		<div class="row h-100">
	   		<div class="col-sm-12 my-auto">
				<div class="card bg-light mx-auto responsive">
					<div class="card-header">
						<h3>Sign In</h3>
					</div>
					<div class="card-body">
						<p style="color:#ff0000;"><?php echo $msg; ?></p>
				    	<form action="" method="POST" id="login" name="login">
				    		<div id="alert">
				    		</div>
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
						  	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
				    	    <button class="btn btn-success form-control" type="submit">Login</button>
				    	</form>
				    	<br>
				    	<a href="forgot_password.php" style="padding: 15px" >Forgot Password?</a>
				    	<a href="register.php">Signup</a>
		    		</div>
		    	</div>
	    	</div>
		</div>
    </div>
	<script src="validate.js?v=1"></script>
</body>
</html>