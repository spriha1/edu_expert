<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_REQUEST['from_id']) && isset($_REQUEST['of_date'])) {
        if (!empty($_REQUEST['from_id']) && !empty($_REQUEST['of_date'])) {

			$obj = new DB_connect();

			$query = "SELECT * FROM goal_plan WHERE user_id = ".$_REQUEST['from_id']." AND from_time LIKE '%".$_REQUEST['of_date']."%'";
		    $result = $obj->select_records($conn, $query);
		    print_r(json_encode($result));
		}
	}
?>