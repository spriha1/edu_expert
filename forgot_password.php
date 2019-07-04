<?php 
	session_start();
	if (isset($_SESSION['username'])) {
		session_unset();
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