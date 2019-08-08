<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_REQUEST['class_id']) && isset($_REQUEST['subject_id'])) {
        if (!empty($_REQUEST['class_id']) && !empty($_REQUEST['subject_id'])) {
			$obj = new DB_connect();
		    $table = "class";
		    $conditions = array("class" => $_REQUEST['class_id'], "subject_id" => $_REQUEST['subject_id']);
		    $obj->delete($conn, $table, $conditions);
		}
	}
?>