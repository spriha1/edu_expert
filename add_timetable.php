<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['teacher_id']) && isset($_REQUEST['subject_id']) && isset($_REQUEST['class_id'])) {
        if (!empty($_REQUEST['teacher_id']) && !empty($_REQUEST['subject_id']) && !empty($_REQUEST['class_id'])) {
        	$date = date("Y-m-d");
			$obj = new DB_connect();

			$table = "tasks";
			$columns = array("of_date", "subject_id", "class");
			$values = array($date, $_REQUEST['subject_id'], $_REQUEST['class_id']);
			$obj->insert($conn, $table, $columns, $values);

			$task_id = $conn->lastInsertId();

			$table = "teacher_tasks";
			$columns = array("task_id", "teacher_id");
			$values = array($task_id, $_REQUEST['teacher_id']);
			$obj->insert($conn, $table, $columns, $values);

			$query = "SELECT id from users WHERE class = ".$_REQUEST['class_id'];
			$result = $obj->select_records($conn, $query);
			foreach ($result as $key => $value) {
				$table = "student_tasks";
				$columns = array("task_id", "student_id");
				$values = array($task_id, $value['id']);
				$obj->insert($conn, $table, $columns, $values);
			}
			print_r("Successfully added");
		}
	}
?>