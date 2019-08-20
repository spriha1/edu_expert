<?php 
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	//$result = 0;
	if (isset($_POST) && !empty($_POST)) {
		$obj = new DB_connect();
		$table = "holiday";

		if (isset($_POST['day']) && !empty($_POST['day'])) {
			$length = count($_POST['day']);
			for($i = 0; $i < $length; $i++)
			{
				$columns = array("dow");
				$values = array($_POST['day'][$i]);
				$obj->insert($conn, $table, $columns, $values);
			}
			
		}

		else if (isset($_POST['start_date']) && isset($_POST['end_date']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {

			$date_format = $_POST['date_format'];
        	$start_date = $_POST['start_date'];
        	$end_date = $_POST['end_date'];
        	if ($date_format === "yyyy/mm/dd") {
        		$start_date = DateTime::createFromFormat("Y/m/d" , $start_date);
        		$end_date = DateTime::createFromFormat("Y/m/d" , $end_date);
        	}
        	else if ($date_format === "yyyy.mm.dd") {
        		$start_date = DateTime::createFromFormat("Y.m.d" , $start_date);
        		$end_date = DateTime::createFromFormat("Y.m.d" , $end_date);
        	}
        	else if ($date_format === "yyyy-mm-dd") {
        		$start_date = DateTime::createFromFormat("Y-m-d" , $start_date);
        		$end_date = DateTime::createFromFormat("Y-m-d" , $end_date);
        	}
        	else if ($date_format === "dd/mm/yyyy") {
        		$start_date = DateTime::createFromFormat("d/m/Y" , $start_date);
        		$end_date = DateTime::createFromFormat("d/m/Y" , $end_date);
        	}
        	else if ($date_format === "dd-mm-yyyy") {
        		$start_date = DateTime::createFromFormat("d-m-Y" , $start_date);
        		$end_date = DateTime::createFromFormat("d-m-Y" , $end_date);
        	}
        	else if ($date_format === "dd.mm.yyyy") {
        		$start_date = DateTime::createFromFormat("d.m.Y" , $start_date);
        		$end_date = DateTime::createFromFormat("d.m.Y" , $end_date);
        	}
        	$start_date = $start_date->format('Y-m-d');
        	$end_date = $end_date->format('Y-m-d');

			$start_date  = strtotime($start_date);
			$end_date  = strtotime($end_date);
			$columns = array("start_date", "end_date");
			$values = array($start_date, $end_date);
			$obj->insert($conn, $table, $columns, $values);
		}
		print_r("Added successfully");
	}
?>