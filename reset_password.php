<?php 
	session_start();
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_SESSION['token'])) {
	
		if (isset($_POST["password"]) AND !empty($_POST["password"])) {
			
			$password = $_POST["password"];
		    $obj = new DB_connect();
		
		    $query = "SELECT username FROM users WHERE token ='".$_SESSION['token']."' AND user_reg_status = 1";
		    $result = $obj->select_records($conn, $query);
		    if($result)
		    {
		    	$query = "UPDATE users SET password='".md5($password)."' WHERE token ='".$_SESSION['token']."'";
		    	$obj->update($query);
		        echo '<div>Your password has been reset, you can now <a href="index.php"> login</a></div>';
		    }
		    else
		    {
		        echo '<div>Your request has not been accepted by the admin yet</div>';
		    }
		}  
	}           
 ?>
</body>
</html>