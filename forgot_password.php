<?php 
	session_start();
	include_once 'check_login_status.php';
	include_once 'header.html';
	require_once 'csrf_token.php';
?>
	<body class="body1">
		<?php include_once 'send_password_mail.php'; ?>
		<br><br>
		<div class="container" style="text-align: center">
			<div class="card bg-light responsive mx-auto">
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
					    	<input type="hidden" name="token" value="<?php echo Token::generate(); ?>">
					    	<button type="submit" class="btn btn-success">Reset Password</button>
					    	<button formaction="index.php" class="btn btn-success">Go Back</button>
					    </div>
					</form>
				</div>
			</div>
		</div>
	</body>
</html>