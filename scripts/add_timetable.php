<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['teacher_id']) && isset($_REQUEST['subject_id']) && isset($_REQUEST['class_id'])) {
        if (!empty($_REQUEST['teacher_id']) && !empty($_REQUEST['subject_id']) && !empty($_REQUEST['class_id'])) {
        	$date = date("Y-m-d");
			$obj = new DB_connect();
			$table = "timetables";
			$columns = array("teacher_id", "of_date", "subject_id", "class");
			$values = array($_REQUEST['teacher_id'], $date, $_REQUEST['subject_id'], $_REQUEST['class_id']);
			$obj->insert($conn, $table, $columns, $values);
			
			print_r("Successfully added");
		}
	}
?>