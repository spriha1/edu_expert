<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_REQUEST['class_id'])) {
        if (!empty($_REQUEST['class_id'])) {
			$obj = new DB_connect();
		    $table = "class";
		    $conditions = array("class" => $_REQUEST['class_id']);
		    $obj->delete($conn, $table, $conditions);
		}
	}
?>