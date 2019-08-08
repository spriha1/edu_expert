<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_REQUEST['subject'])) {
        if (!empty($_REQUEST['subject'])) {
			$obj = new DB_connect();
			$table = "subjects";
			$columns = array("name");
			$values = array($_REQUEST['subject']);
			$obj->insert($conn, $table, $columns, $values);
			$query = "SELECT * from subjects WHERE id = (SELECT LAST_INSERT_ID())";
			$result = $obj->select_records($conn, $query);
			print_r(json_encode($result));
		}
	}
?>