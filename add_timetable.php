<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['class']) && isset($_REQUEST['subject'])) {
        if (!empty($_REQUEST['class']) && !empty($_REQUEST['subject'])) {
        	$date = date("Y-m-d");
			$obj = new DB_connect();

			$length = count($_REQUEST['subject']);
			for($i = 0; $i < $length; $i++)
			{
				$table = "tasks";
				$columns = array("of_date", "subject_id", "class");

				$subject_id = $_REQUEST['subject'][$i];
				$values = array($date, $subject_id, $_REQUEST['class']);
				$obj->insert($conn, $table, $columns, $values);

				$task_id = $conn->lastInsertId();

				$query = "SELECT DISTINCT teacher_id FROM class WHERE class = ".$_REQUEST['class']." AND subject_id = ".$subject_id;
				$result = $obj->select_records($conn, $query);
				foreach ($result as $key => $value) {
					$table = "teacher_tasks";
					$columns = array("task_id", "teacher_id");
					$values = array($task_id, $value['teacher_id']);
					$obj->insert($conn, $table, $columns, $values);
				}

				$query = "SELECT users.id from users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_type = 'Student' AND class = ".$_REQUEST['class'];
				$result = $obj->select_records($conn, $query);
				foreach ($result as $key => $value) {
					$table = "student_tasks";
					$columns = array("task_id", "student_id");
					$values = array($task_id, $value['id']);
					$obj->insert($conn, $table, $columns, $values);
				}
			}
			print_r("Successfully added");
		}
	}
?>