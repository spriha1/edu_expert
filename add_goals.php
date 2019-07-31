<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	$result = 0;
	if (isset($_REQUEST['goal']) && isset($_REQUEST['user_id'])) {
        if (!empty($_REQUEST['goal']) AND !empty($_REQUEST['user_id'])) {
			$obj = new DB_connect();
			$table = "goal_plan";
			$columns = array("user_id", "goal");
			$values = array($_REQUEST['user_id'], $_REQUEST['goal']);
			$obj->insert($conn, $table, $columns, $values);
			$result = 1;
			print_r($result);
		}
	}
?>