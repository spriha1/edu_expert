<?php 
	session_start();
	require_once 'csrf_token.php';
	include_once 'db_connection.php';
	include_once 'db_credentials.php';

	if(isset($_SESSION["username"]))
	{
		if (isset($_GET['username']) && !empty($_GET['username']) && Token::check($_GET['t'])) {
			$username = $_GET['username'];
		    $obj = new DB_connect();
		    $conn = $obj->connect($server_name,$db_name,$db_username,$db_password);
		    $query = "UPDATE users SET block_status = 1 WHERE username = '".$username."'";
		    $obj->update($query);
		    header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	else
	{
		header("Location:index.php");
	}
?>