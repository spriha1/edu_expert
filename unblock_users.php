<?php 
	session_start();
	require_once 'csrf_token.php';
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if(isset($_SESSION["username"]))
	{
		if (isset($_GET['username']) && !empty($_GET['username']) && Token::check($_GET['t'])) {
			$username = $_GET['username'];
		    $obj = new DB_connect();
		    $query = "UPDATE users SET block_status = 0 WHERE username = '".$username."'";
		    $obj->update($conn, $query);   
	    	header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	else
	{
		header("Location:index.php");
	}
?>