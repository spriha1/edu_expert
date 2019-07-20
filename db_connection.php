<?php 
	include_once 'db_credentials.php';
	$conn = new PDO("mysql:host=$server_name;dbname=$db_name", $db_username, $db_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	class DB_connect
	{
		function select_records($conn, $query)
		{
			$sql = $conn->prepare($query);
		    $sql->execute();
		    $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
		    $result = $sql->fetchAll();
		    return $result;
		}
		function select($conn, $columns, $table, $conditions)
		{

		}
		function update($conn, $table, $columns, $conditions)
		{
			$query = "UPDATE ".$table." SET ";

			$columns_length = count($columns);
			for ($i=0; $i < $columns_length-1; $i++) 
			{ 
				foreach ($columns as $key => $value) 
				{
					$query .= $key[$i]." = ".$value[$i]." , ";
				}
			}
			foreach ($columns as $key => $value)
			{
				$query .= $key[$i]." = ".$value[$i];
			} 

			$conditions_length = count($conditions);
			if($conditions_length > 0)
			{
				$query .= " WHERE ";
				for ($i=0; $i < $conditions_length-1; $i++) 
				{ 
					foreach ($conditions as $key => $value) 
					{
						$query .= $key[$i]." = ".$value[$i]." AND ";
					}
				}
				foreach ($conditions as $key => $value)
				{
					$query .= $key[$i]." = ".$value[$i];
				} 
			}
			$sql = $conn->prepare($query);
		    $sql->execute();
		}

		function delete($conn, $table, $conditions)
		{
			$query = "DELETE FROM ".$table;
			
			$conditions_length = count($conditions);
			if ($conditions_length > 0)
			{
				$query .= " WHERE ";
				$i=0;
				for ($i=0; $i < $conditions_length-1; $i++) 
				{ 
					foreach ($conditions as $key => $value) 
					{
						if (is_string($value)) 
						{
							$query .= $key." = '".$value."' AND ";
						}
						else
						{
							$query .= $key." = ".$value." AND ";
						}
					}
				}
				foreach ($conditions as $key => $value)
				{
					if (is_string($value)) 
					{
						$query .= $key." = '".$value."'";
					}
					else
					{
						$query .= $key." = ".$value;
					}
				} 
			}
		    $conn->exec($query);
		}

		function insert($conn, $table, $data)
		{

		}
	}
 ?>