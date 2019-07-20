<?php 
    if (isset($_SESSION['username'])) {
		include_once 'db_credentials.php';
    	include_once 'db_connection.php';
    	$obj = new DB_connect();
        $query = "SELECT user_type FROM user_types INNER JOIN users ON (users.user_type_id = user_types.id) WHERE username = '".$_SESSION['username']."'";
        $result = $obj->select_records($conn, $query);
        foreach ($result as $key => $value) {
        	if ($value['user_type']== "Admin") {
        		header("Location:admin_dashboard.php");
        	}
        	else if ($value['user_type']== "Student") {
        		header("Location:student_dashboard.php");
        	}
        	else if ($value['user_type']== "Teacher") {
        		header("Location:teacher_dashboard.php");
        	}
        }
	}
?>