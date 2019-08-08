<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_REQUEST['value'])) {
        if (!empty($_REQUEST['value'])) {
			$obj = new DB_connect();
			$table = "feedback_parameters";
			$columns = array("parameter");
			$values = array($_REQUEST['value']);
			$obj->insert($conn, $table, $columns, $values);
			print_r(1);
		}
	}
?>