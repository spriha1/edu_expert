<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['task_id']) && isset($_REQUEST['user_id']) && isset($_REQUEST['time']) && isset($_REQUEST['user_type'])) {
        if (!empty($_REQUEST['task_id']) AND !empty($_REQUEST['user_id']) AND !empty($_REQUEST['time']) AND !empty($_REQUEST['user_type'])) {
			$obj = new DB_connect();
			if ($_REQUEST['user_type'] === 'teacher') {
				$table = "teacher_tasks";
			    $columns = array("total_time" => $_REQUEST['time']);
			    $conditions = array("task_id" => $_REQUEST['task_id'], "teacher_id" => $_REQUEST['user_id']);
			    $obj->update($conn, $table, $columns, $conditions);
			}
			else if ($_REQUEST['user_type'] === 'student') {
				$table = "student_tasks";
			    $columns = array("total_time" => $_REQUEST['time']);
			    $conditions = array("task_id" => $_REQUEST['task_id'], "student_id" => $_REQUEST['user_id']);
			    $obj->update($conn, $table, $columns, $conditions);
			}
			
		}
	}
?>