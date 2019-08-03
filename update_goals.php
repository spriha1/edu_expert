<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['goal_id'])) {
        if (!empty($_REQUEST['goal_id'])) {
			$obj = new DB_connect();
			$table = "goal_plan";
			//pd("hi")
			$to_time = date('Y-m-d H:i:s',time());
		    $columns = array("to_time" => $to_time, "check_status" => 1);
		    $conditions = array("id" => $_REQUEST['goal_id']);
		    $obj->update($conn, $table, $columns, $conditions);
		    $query = "SELECT total_time FROM goal_plan WHERE id = ".$_REQUEST['goal_id'];
			$result = $obj->select_records($conn, $query);
			// //$result = 1;
			print_r(json_encode($result));
		}
	}
?>