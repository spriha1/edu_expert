<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['date']) && isset($_REQUEST['user_id']) && isset($_REQUEST['user_type'])) {
        if (!empty($_REQUEST['date']) AND !empty($_REQUEST['user_id']) AND !empty($_REQUEST['user_type'])) {
        	$date_format = $_REQUEST['date_format'];
        	$date = $_REQUEST['date'];
        	if ($date_format === "yyyy/mm/dd") {
        		$date = DateTime::createFromFormat("Y/m/d" , $date);
        	}
        	else if ($date_format === "yyyy.mm.dd") {
        		$date = DateTime::createFromFormat("Y.m.d" , $date);
        	}
        	else if ($date_format === "yyyy-mm-dd") {
        		$date = DateTime::createFromFormat("Y-m-d" , $date);
        	}
        	else if ($date_format === "dd/mm/yyyy") {
        		$date = DateTime::createFromFormat("d/m/Y" , $date);
        	}
        	else if ($date_format === "dd-mm-yyyy") {
        		$date = DateTime::createFromFormat("d-m-Y" , $date);
        	}
        	else if ($date_format === "dd.mm.yyyy") {
        		$date = DateTime::createFromFormat("d.m.Y" , $date);
        	}
        	$date = $date->format('Y-m-d');
			$obj = new DB_connect();
			$date = strtotime($_REQUEST['date']);
			//$date = strtotime($date);
			if ($_REQUEST['user_type'] === 'teacher') {
				$query = "SELECT task_id, class, name FROM teacher_tasks INNER JOIN tasks ON (tasks.id = teacher_tasks.task_id) INNER JOIN subjects ON (tasks.subject_id = subjects.id) WHERE teacher_id = ".$_REQUEST['user_id']." AND start_date <= ".$date." AND end_date >= ".$date;
				$result = $obj->select_records($conn, $query);
			}
			else if ($_REQUEST['user_type'] === 'student') {
				$query = "SELECT teacher_tasks.task_id, teacher.firstname, name 
				FROM student_tasks 
				INNER JOIN tasks ON (tasks.id = student_tasks.task_id) 
				INNER JOIN teacher_tasks ON (tasks.id = teacher_tasks.task_id)
				INNER JOIN subjects ON (tasks.subject_id = subjects.id) 
				INNER JOIN users teacher ON (teacher.id = teacher_tasks.teacher_id) WHERE student_id = ".$_REQUEST['user_id']." AND start_date <= ".$date." AND end_date >= ".$date;
				$result = $obj->select_records($conn, $query);
			}
			//pd($result);
			print_r(json_encode($result));
		}
	}
?>