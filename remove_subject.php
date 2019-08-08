<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_REQUEST['subject_id'])) {
        if (!empty($_REQUEST['subject_id'])) {
			$obj = new DB_connect();
		    $table = "subjects";
		    $conditions = array("id" => $_REQUEST['subject_id']);
		    $obj->delete($conn, $table, $conditions);
		}
	}
?>