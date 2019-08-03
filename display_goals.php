<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['date']) && isset($_REQUEST['user_id'])) {
        if (!empty($_REQUEST['date']) AND !empty($_REQUEST['user_id'])) {
			$obj = new DB_connect();
			$query = "SELECT * FROM goal_plan WHERE user_id = ".$_REQUEST['user_id']." AND from_time LIKE '%".$_REQUEST['date']."%'";
			$result = $obj->select_records($conn, $query);
			print_r(json_encode($result));
		}
	}
?>