<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_POST['class']) && !empty($_POST['class']))
	{
		$obj = new DB_connect();
		$query = "SELECT users.id as userid,firstname,subjects.id as subjectid,class.class,name from users INNER JOIN class ON (users.id = class.teacher_id) INNER JOIN subjects ON (class.subject_id = subjects.id) WHERE class.class = ".$_POST['class'];
		$result = $obj->select_records($conn, $query);
		print_r(json_encode($result));
	}
 ?>