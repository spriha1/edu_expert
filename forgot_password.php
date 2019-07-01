<?php include_once 'header.html';?>
	<body>
		<?php include_once 'send_password_mail.php';	?>
		<br><br>
		<div class="container" style="text-align: center">
			
			<div class="card bg-secondary mx-auto" style="width: 50%">
    			<div class="card-body">
    				<h1>Forgot Password ? </h1>
					<p> <?php echo $msg; ?> </p>
					<form method="POST" action="">
					    <div class="form-group">
					      <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
					  	</div>
					  	<div class="form-group">
					      <input type="password" class="form-control" name="password" placeholder="Enter New Password">
					    </div>
					    <div class="form-group">
					    	<button type="submit" class="btn btn-success">Reset Password</button>
					    </div>
					</form>
				</div>
			</div>
		</div>
		
	</body>
</html>