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
	    $sql = "DELETE FROM users WHERE username = '".$username."'";
	    $conn->exec($sql);
	}
}
else
{
	header("Location:index.php");
}
 ?>