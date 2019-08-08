<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//pd($_POST);
	if (isset($_POST['class']) && isset($_POST['subjects']))
	{
		if(!empty($_POST['class']) && !empty($_POST['subjects'])) {
			$obj = new DB_connect();
			$table = "class";
			$length = count($_POST['subjects']);
			for($i = 0; $i < $length; $i++)
			{
				$columns = array("class", "subject_id", "teacher_id");
				$values = array($_POST['class'], $_POST['subjects'][$i], $_POST[$_POST['subjects'][$i]]);
				$obj->insert($conn, $table, $columns, $values);
			}
			
			$query = "SELECT users.id as userid,firstname,subjects.id as subjectid,class.class,name from users INNER JOIN class ON (users.id = class.teacher_id) INNER JOIN subjects ON (class.subject_id = subjects.id) WHERE class.id = (SELECT LAST_INSERT_ID()) AND class.class = ".$_POST['class'];
			$result = $obj->select_records($conn, $query);
			print_r(json_encode($result));
		}
	}
	
?>