<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['goal']) && isset($_REQUEST['user_id'])  && isset($_REQUEST['time'])) {
        if (!empty($_REQUEST['goal']) AND !empty($_REQUEST['user_id']) AND !empty($_REQUEST['time'])) {
			$obj = new DB_connect();
			$table = "goal_plan";
			$from_time = time();
			$columns = array("user_id", "goal", "on_date", "from_time");
			$values = array($_REQUEST['user_id'], $_REQUEST['goal'], $_REQUEST['time'], $from_time);
			$obj->insert($conn, $table, $columns, $values);
			$query = "SELECT * from goal_plan WHERE user_id = ".$_REQUEST['user_id']." AND id = (SELECT LAST_INSERT_ID())";
			$result = $obj->select_records($conn, $query);
			//$result = 1;
			print_r(json_encode($result));
		}
	}
?>