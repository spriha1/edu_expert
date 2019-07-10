<?php 
	session_start();
	require_once 'csrf_token.php';
	if(isset($_SESSION["username"]))
	{
		if (isset($_GET['username']) && !empty($_GET['username']) && Token::check($_GET['t'])) {
			$username = $_GET['username'];

			include_once 'db_connection.php';
			include_once 'db_credentials.php';
		    $obj = new DB_connect();
		    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
		    $query = "UPDATE users SET user_reg_status = 1 WHERE username = '".$username."'";
		    $obj->update($query);

	    	header("Location:admin_dashboard.php");
		}
	}
	else
	{
		header("Location:index.php");
	}
 ?>
