<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_POST['class_id']) && !empty($_POST['class_id']))
	{
		$obj = new DB_connect();
		$query = "SELECT subjects.id,name from subjects INNER JOIN class ON (subjects.id = class.subject_id) WHERE class.class = ".$_POST['class_id'];
		$result = $obj->select_records($conn, $query);
		print_r(json_encode($result));
	}
 ?>