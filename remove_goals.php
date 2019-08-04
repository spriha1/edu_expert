<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['goal_id'])) {
        if (!empty($_REQUEST['goal_id'])) {
			$obj = new DB_connect();
		    $table = "goal_plan";
		    $conditions = array("id" => $_REQUEST['goal_id']);
		    $obj->delete($conn, $table, $conditions);
		}
	}
?>