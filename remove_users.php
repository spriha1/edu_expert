<?php 
session_start();

	if (isset($_GET['username']) && !empty($_GET['username'])) {
		$username = $_GET['username'];
		include 'db_connection.php';
		include 'db_credentials.php';

	    $obj = new DB_connect();
	    $conn = $obj->connect('localhost','php_project',$username,$password);
	    $sql = "DELETE FROM users WHERE username = '".$username."'";
	    $conn->exec($sql);
	}
 ?>