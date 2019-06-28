<?php 
session_start();

	if (isset($_GET['username']) && !empty($_GET['username'])) {
		$username = $_GET['username'];
		include 'db_connection.php';
		include 'db_credentials.php';

	    $obj = new DB_connect();
	    $conn = $obj->connect('localhost','php_project',$username,$password);
	    $sql = "UPDATE users SET user_reg_status = 2 WHERE username = '".$username."'";
	    $stmt = $conn->prepare($sql);
	    $stmt->execute();
	}
 ?>