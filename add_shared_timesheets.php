<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	if (isset($_REQUEST['user_id']) && isset($_REQUEST['date'])) {
        if (!empty($_REQUEST['user_id']) && !empty($_REQUEST['date'])) {

			$obj = new DB_connect();

			$query = "SELECT user_type FROM user_types INNER JOIN users ON (users.user_type_id = user_types.id) WHERE users.id = ".$_REQUEST['user_id'];
		    $result = $obj->select_records($conn, $query);

		    foreach ($result as $key => $value)
		    {
		    	if ($value['user_type'] === 'Teacher') {
		    		$query1 = "SELECT users.id FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_types.user_type = 'Admin'";
		    		$result1 = $obj->select_records($conn, $query1);
		    		foreach ($result1 as $key1 => $value1) 
		    		{
		    			$to_id = $value1['id'];
		    		}
		    	}
		    	else {
		    		$query1 = "SELECT class FROM users WHERE id = ".$_REQUEST['user_id'];
		    		$result1 = $obj->select_records($conn, $query1);
		    		foreach ($result1 as $key1 => $value1) 
		    		{
		    			$query2 = "SELECT id FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE user_types.user_type = 'Teacher' AND users.class = ".$value1['class'];
		    			$result2 = $obj->select_records($conn, $query2);
		    			foreach ($result2 as $key2 => $value2) 
		    			{
		    				$to_id = $value2['id'];
		    			}
		    		}
		    	}		    	
		    }
		    $table = "shared_timesheets";
	    	$columns = array("from_id", "to_id", "of_date");
	    	$values = array($_REQUEST['user_id'], $to_id, $_REQUEST['date']);
	    	$obj->insert($conn, $table, $columns, $values);
		}
	}
?>