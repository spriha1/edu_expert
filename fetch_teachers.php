<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_POST['subject_id']) && !empty($_POST['subject_id']))
	{
		$obj = new DB_connect();
		$query = "SELECT users.id,firstname from users INNER JOIN teacher_subject ON (users.id = teacher_subject.teacher_id) WHERE subject_id = ".$_POST['subject_id'];
		$result = $obj->select_records($conn, $query);
		print_r(json_encode($result));
	}
 ?>