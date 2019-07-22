<?php 
	session_start();
	include_once 'header.html';
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	?>
	<body>
		<br><br>
		<?php if (isset($_GET["q"]) AND !empty($_GET["q"]) AND isset($_GET["t"]) AND !empty($_GET["t"])) {
			$token = base64_decode($_GET["q"]);
			$_SESSION['token'] = $token;
			$expiry_time = base64_decode($_GET["t"]);
			$current_time = time();
			if ($current_time > $expiry_time) {
				echo "The link has expired";
				$obj = new DB_connect();
				$table = "users";
			    $columns = array("token" => NULL);
			    $conditions = array("token" => $token);
			    $obj->update($conn, $table, $columns, $conditions);
				//$query = "UPDATE users SET token = NULL WHERE token = '".$token."'";
			}
			else { ?>
				<div class="container" style="text-align: center">
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
				</div>
				<?php 
			}
		} 
?>
</body>
</html>