<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['time']) && isset($_REQUEST['date'])) {
        if (!empty($_REQUEST['time']) AND !empty($_REQUEST['date'])) {
			$table = "teacher_tasks";
		    $columns = array("total_time" => $_REQUEST['time']);
		    $conditions = array("task_id" => $_REQUEST['task_id'], "teacher_id" => $_REQUEST['user_id'], "on_date" => $_REQUEST['date']);
		    $obj->update($conn, $table, $columns, $conditions);
			
        }
    }
?>