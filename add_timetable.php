<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	//pd(gettype($_REQUEST['start_date']));
	if (isset($_REQUEST['class']) && isset($_REQUEST['subject']) && isset($_REQUEST['start_date']) && isset($_REQUEST['end_date'])) {
        if (!empty($_REQUEST['class']) && !empty($_REQUEST['subject']) && !empty($_REQUEST['start_date']) && !empty($_REQUEST['end_date'])) {
        	//$date = date("Y-m-d");
			$obj = new DB_connect();
			$start_date  = strtotime($_REQUEST['start_date']);
			$end_date  = strtotime($_REQUEST['end_date']);

			$length = count($_REQUEST['subject']);
			for($i = 0; $i < $length; $i++)
			{
				$table = "tasks";
				$columns = array("subject_id", "class", "start_date", "end_date");

				$subject_id = $_REQUEST['subject'][$i];
				$values = array($subject_id, $_REQUEST['class'], $start_date, $end_date);
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