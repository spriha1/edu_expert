<?php 
	session_start();
	if(isset($_SESSION["username"]))
	{
		if (isset($_GET['username']) && !empty($_GET['username'])) {
			$username = $_GET['username'];

			include_once 'db_connection.php';
			include_once 'db_credentials.php';
		    $obj = new DB_connect();
		    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
		    $query = "UPDATE users SET user_reg_status = 2 WHERE username = '".$username."'";
		    $obj->update($query);
		    
		    header("Location:admin_dashboard.php");
		}
	}
	else
	{
		header("Location:index.php");
	}
?>