<?php 
	include_once 'db_connection.php';
	include_once 'db_credentials.php';
	$search_field = $_GET['q'];
	$res = array();
	$obj = new DB_connect();
	$conn = $obj->connect($server_name,$db_name,$db_username,$db_password);
	$query = "SELECT ".$search_field." FROM users";
	$result = $obj->select_records($query);
	foreach ($result as $key => $value) {
		array_push($res, $value[$search_field]);
	}
	$res = json_encode($res);
	print_r($res);

 ?>