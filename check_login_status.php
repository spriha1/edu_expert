<?php 
    if (isset($_SESSION['username'])) {
		include_once 'db_credentials.php';
    	include_once 'db_connection.php';
    	$obj = new DB_connect();
        $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
        //$query = "SELECT user_type FROM user_types WHERE id = (SELECT user_type_id FROM users WHERE username = '".$_SESSION['username']."')";
        $query = "SELECT user_type FROM user_types INNER JOIN users ON (users.user_type_id = user_types.id) WHERE username = '".$_SESSION['username']."'";
        $result = $obj->select_records($query);
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