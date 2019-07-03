<?php 
	session_start();
	include_once 'header.html';?>
	<body>
		<br><br>
		<?php if (isset($_GET["q"]) AND !empty($_GET["q"]) AND isset($_GET["t"]) AND !empty($_GET["t"])) {
			$token = base64_decode($_GET["q"]);
			$_SESSION['token'] = $token;
			$expiry_time = base64_decode($_GET["t"]);
			$current_time = time();
			if($current_time > $expiry_time)
			{
				echo "The link has expired";
				include_once 'db_connection.php';
				include_once 'db_credentials.php';
				$obj = new DB_connect();
			    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
				$sql = "UPDATE users SET token = NULL WHERE token = '".$token."'";
				$stmt = $conn->prepare($sql);
				$stmt->execute();
			}
			else
			{
				echo '<div class="container" style="text-align: center">
					
					<div class="card bg-secondary mx-auto" style="width: 50%">
		    			<div class="card-body">
							<form method="POST" action="reset_password.php">
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
			}
		} ?>
	</body>
</html>