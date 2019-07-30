<?php 
	session_start();
	include_once 'check_login_status.php';
	include_once 'header_login.html';
	require_once 'csrf_token.php'; 
	//include_once 'login.php';
	include_once 'db_tables_creation.php';
	include_once 'static_file_version.php';
?>

<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		Edu<b>Xpert</b>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Sign in to start</p>

		<form action="" method="POST" id="login" name="login">
			<div id="alert" class='alert alert-danger' style="display: none;">
			</div>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Username" id="username" name="username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<div class="form-group has-feedback">
				<input type="password" class="form-control" placeholder="Password" id="password" name="password">
				<span class="glyphicon glyphicon-lock form-control-feedback"></span>
			</div>
			<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>">
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<a href="forgot_password.php">Forgot Password?</a>
						</label>
				</div>
			</div>
			<div class="col-xs-4">
				<button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
			</div>
		</div>
		</form>

   
    <a href="register.php" class="text-center">Register Here</a>

  </div>
</div>

<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="plugins/iCheck/icheck.min.js"></script>
<script src="<?php autoVer('/scripts/validate.js'); ?>"></script>
<script>
	$(function () {
		$('input').iCheck({
			checkboxClass: 'icheckbox_square-blue',
			radioClass: 'iradio_square-blue',
			increaseArea: '20%' /* optional */
		});
	});
</script>
</body>
</html>
<!--<body class="body1">
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
						<p style="color:#ff0000;"><?php //echo $msg; ?></p>
				    	<form action="" method="POST" id="login" name="login">
				    		<div id="alert" class='alert alert-danger' style="display: none;">
				    		</div>
				    		<div class="input-group form-group">
						    	<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-user"></i></span>
								</div>
						      	<input class="form-control" id="username" name="username" type="text" placeholder="Enter Username">
						  	</div>
						  	<div>
						  		<p style="color:#ff0000;"><?php //echo $username_msg; ?></p>
						  	</div>
				    	    <div class="input-group form-group">
						    	<div class="input-group-prepend">
									<span class="input-group-text"><i class="fas fa-key"></i></span>
								</div>
						      	<input class="form-control" id="password" name="password" type="password" placeholder="Enter Password">
						  	</div>
				    	    <div>
						  		<p style="color:#ff0000;"><?php //echo $password_msg; ?></p>
						  	</div>
						  	<input type="hidden" id="token" name="token" value="<?php //echo Token::generate(); ?>">
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
	<script src="<?php //autoVer('/scripts/validate.js'); ?>"></script>
</body>
</html>
