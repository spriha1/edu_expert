<?php include_once 'header.html';?>
	<body>
		<br><br>
		<?php if (isset($_GET["q"]) AND !empty($_GET["q"])) {
			$id = $_GET["q"];
			include_once 'reset_password.php';
		echo '<div class="container" style="text-align: center">
			
			<div class="card bg-secondary mx-auto" style="width: 50%">
    			<div class="card-body">
					<form method="POST" action="">
					    <div class="form-group">
					      <input type="password" class="form-control" id="password" placeholder="Enter New Password" name="password">
					  	</div>
					    <div class="form-group">
					    	<button type="submit" class="btn btn-success">Reset Password</button>
					    </div>
					</form>
				</div>
			</div>
		</div>';
} ?>
	</body>
</html>