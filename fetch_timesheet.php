<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_REQUEST['from_id']) && isset($_REQUEST['of_date']) && isset($_REQUEST['timesheet_check'])) {
        if (!empty($_REQUEST['from_id']) && !empty($_REQUEST['of_date']) && !empty($_REQUEST['timesheet_check'])) {

			$obj = new DB_connect();

        	if ($_REQUEST['timesheet_check'] == 0) {

				$query = "SELECT * FROM goal_plan WHERE user_id = ".$_REQUEST['from_id']." AND from_time LIKE '%".$_REQUEST['of_date']."%'";
			    $result = $obj->select_records($conn, $query);
			    print_r(json_encode($result));
			}

			else if ($_REQUEST['timesheet_check'] == 1) {

				$query = "SELECT name, class, total_time FROM teacher_tasks INNER JOIN tasks ON (tasks.id = teacher_tasks.task_id) INNER JOIN subjects ON (subjects.id = tasks.subject_id) WHERE teacher_id = ".$_REQUEST['from_id']." AND of_date LIKE '%".$_REQUEST['of_date']."%'";
			    $result = $obj->select_records($conn, $query);
			    print_r(json_encode($result));
			}
		}
	}
?>