<?php 
	session_start();
	require_once 'csrf_token.php';
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if(isset($_SESSION["username"]))
	{
		if (isset($_GET['username']) && !empty($_GET['username']) && Token::check($_GET['t'])) 
		{
			$username = $_GET['username'];
		    $obj = new DB_connect();
		    $table = "users";
		    $conditions = array("username" => $username);
		    $obj->delete($conn, $table, $conditions);
		    header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	else
	{
		header("Location:index.php");
	}
?>