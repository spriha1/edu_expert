<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	include_once 'csrf_token.php';
	//$result = 0;
	if (isset($_REQUEST['username']) && isset($_REQUEST['value'])) {
        if (!empty($_REQUEST['username']) && !empty($_REQUEST['value'])) {
			$obj = new DB_connect();
			$table = "users";
		    $columns = array("class" => $_REQUEST['value']);
		    $conditions = array("username" => $_REQUEST['username']);
		    $obj->update($conn, $table, $columns, $conditions);
		}
	}
?>