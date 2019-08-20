<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['task_id']) && isset($_REQUEST['user_id']) && isset($_REQUEST['time']) && isset($_REQUEST['user_type'])) {
        if (!empty($_REQUEST['task_id']) AND !empty($_REQUEST['user_id']) AND !empty($_REQUEST['time']) AND !empty($_REQUEST['user_type'])) {

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
			$date = strtotime($date);

			$obj = new DB_connect();
			if ($_REQUEST['user_type'] === 'teacher') {
                $query = "SELECT * FROM teacher_tasks WHERE task_id = ".$_REQUEST['task_id']." AND teacher_id = ".$_REQUEST['user_id'];
                $result = $obj->select_records($conn, $query);

                foreach ($result as $key => $value) {
                    if ($value['on_date'] == 0 && $value['total_time'] == 0) {
                        $table = "teacher_tasks";
                        $columns = array("total_time" => $_REQUEST['time'], "on_date" => $date);
                        $conditions = array("task_id" => $_REQUEST['task_id'], "teacher_id" => $_REQUEST['user_id']);
                        $obj->update($conn, $table, $columns, $conditions);
                    }
                    else if ($value['on_date'] == $date) {
                        $table = "teacher_tasks";
                        $columns = array("total_time" => $_REQUEST['time']);
                        $conditions = array("task_id" => $_REQUEST['task_id'], "teacher_id" => $_REQUEST['user_id'], "on_date" => $date);
                        $obj->update($conn, $table, $columns, $conditions);
                    }
                    else {
                        $table = "teacher_tasks";
                        $columns = array("task_id", "teacher_id", "on_date", "total_time");
                        $values = array($_REQUEST['task_id'], $_REQUEST['user_id'], $date, $_REQUEST['time']);
                        $obj->insert($conn, $table, $columns, $values);
                    }
                }
    			
			}
			// else if ($_REQUEST['user_type'] === 'student') {
			// 	$table = "student_tasks";
			//     $columns = array("total_time" => $_REQUEST['time']);
			//     $conditions = array("task_id" => $_REQUEST['task_id'], "student_id" => $_REQUEST['user_id']);
			//     $obj->update($conn, $table, $columns, $conditions);
			// }
			
		}
	}
?>