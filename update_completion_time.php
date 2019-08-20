<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_POST['time']) && isset($_POST['date']) && isset($_POST['task_id']) && isset($_POST['user_id'])) {
        if (!empty($_POST['time']) && !empty($_POST['date']) && !empty($_POST['task_id']) && !empty($_POST['user_id'])) {
			$obj = new DB_connect();
        	
			$table = "teacher_tasks";
		    $columns = array("total_time" => $_REQUEST['time']);
		    $conditions = array("task_id" => $_REQUEST['task_id'], "teacher_id" => $_REQUEST['user_id'], "on_date" => $_REQUEST['date']);
		    $obj->update($conn, $table, $columns, $conditions);
			
        }
    }
?>