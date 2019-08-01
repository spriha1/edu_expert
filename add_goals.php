<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['goal']) && isset($_REQUEST['user_id'])) {
        if (!empty($_REQUEST['goal']) AND !empty($_REQUEST['user_id'])) {
			$obj = new DB_connect();
			$table = "goal_plan";
			$columns = array("user_id", "goal");
			$values = array($_REQUEST['user_id'], $_REQUEST['goal']);
			$obj->insert($conn, $table, $columns, $values);
			$query = "SELECT * from goal_plan WHERE id = (SELECT LAST_INSERT_ID())";
			$result = $obj->select_records($conn, $query);
			//$result = 1;
			print_r(json_encode($result));
		}
	}
?>