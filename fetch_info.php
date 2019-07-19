<?php 
	include_once 'db_connection.php';
	include_once 'db_credentials.php';
	$search_field = $_GET['q1'];
	$search_field_value = $_GET['q2'];
	$res = 0;
	$obj = new DB_connect();
	$conn = $obj->connect($server_name,$db_name,$db_username,$db_password);
	$query = "SELECT ".$search_field." FROM users";
	$result = $obj->select_records($query);
	foreach ($result as $key => $value) 
	{
		if($value[$search_field] === $search_field_value)
		{
			$res = 1;
		}
	}
	print_r ($res);
 ?>