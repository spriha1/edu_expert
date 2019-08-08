<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	
	$obj = new DB_connect();
	$query = "SELECT * FROM subjects";
	$result = $obj->select_records($conn, $query);
	print_r(json_encode($result));
?>