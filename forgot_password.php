<?php 
	session_start();
	include_once 'check_login_status.php';
	include_once 'header_login.html';
	require_once 'csrf_token.php';
	include_once 'send_password_mail.php';
?>

<body class="hold-transition login-page">
<div class="login-box">
	<div class="login-logo">
		Edu<b>Xpert</b>
	</div>
	<div class="login-box-body">
		<p class="login-box-msg">Reset Password</p>

		<form action="" method="POST" id="login" name="login">
			<div id="alert" class='alert alert-danger' style="display: none;">
			</div>
			<p style="color : #ff0000"> <?php echo $msg; ?> </p>
			<div class="form-group has-feedback">
				<input type="text" class="form-control" placeholder="Username" id="username" name="username">
				<span class="glyphicon glyphicon-user form-control-feedback"></span>
			</div>
			<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>">
			<div class="row">
				<div class="col-xs-8">
					<div class="checkbox icheck">
						<label>
							<a href="index.php">Sign In</a>
						</label>
				</div>
			</div>
			<div class="col-xs-4">
				<button type="submit" class="btn btn-primary btn-block btn-flat">Reset</button>
			</div>
		</div>
		</form>
	</div>
</div>

<?php include_once 'footer.html'; ?>
</body>
</html>
	<!--<body class="body1">
		<br><br>
		<div class="container" style="text-align: center">
			<div class="card bg-light responsive mx-auto">
    			<div class="card-header">
    				<h3>Forgot Password ? </h3>
					<p style="color : #ff0000"> <?php //echo $msg; ?> </p>
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
					    	<input type="hidden" name="token" value="<?php //echo Token::generate(); ?>">
					    	<button type="submit" class="btn btn-success">Reset Password</button>
					    	<button formaction="index.php" class="btn btn-success">Go Back</button>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>