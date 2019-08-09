<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['subject_id']) && isset($_REQUEST['class_id']) && isset($_REQUEST['teacher_id'])) {
        if (!empty($_REQUEST['subject_id']) && !empty($_REQUEST['class_id']) && !empty($_REQUEST['teacher_id'])) {
			$obj = new DB_connect();
			$table = "class";
		    $columns = array("teacher_id" => $_REQUEST['teacher_id']);
		    $conditions = array("subject_id" => $_REQUEST['subject_id'], "class" => $_REQUEST['class_id']);
		    $obj->update($conn, $table, $columns, $conditions);
		    $query = "SELECT firstname FROM users WHERE id = ".$_REQUEST['teacher_id'];
			$result = $obj->select_records($conn, $query);
			// //$result = 1;
			print_r(json_encode($result));
		}
	}
?>