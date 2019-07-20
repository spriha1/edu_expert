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
		    $sql = "DELETE FROM users WHERE username = '".$username."'";
		    $conn->exec($sql);
		    header('Location: ' . $_SERVER['HTTP_REFERER']);
		}
	}
	else
	{
		header("Location:index.php");
	}
?>