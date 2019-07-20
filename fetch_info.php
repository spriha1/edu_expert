<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	$search_field = $_GET['q1'];
	$search_field_value = $_GET['q2'];
	$res = 0;
	$obj = new DB_connect();
	$query = "SELECT ".$search_field." FROM users";
	$result = $obj->select_records($conn, $query);
	foreach ($result as $key => $value) 
	{
		if($value[$search_field] === $search_field_value)
		{
			$res = 1;
		}
	}
	print_r ($res);
 ?>