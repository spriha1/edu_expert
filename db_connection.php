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
		function update($conn, $table, $columns, $conditions)
		{
			$query = "UPDATE ".$table." SET ";

			$columns_length = count($columns);
			for ($i=0; $i < $columns_length-1; $i++) 
			{ 
				foreach ($columns as $key => $value) 
				{
					if (is_string($value)) 
					{
						$query .= $key." = '".$value."' , ";
					}
					else
					{
						$query .= $key." = ".$value." , ";
					}
				}
			}
			end($columns);
			$last_key = key($columns);
			$last_value = $columns[$last_key];
			if (is_string($last_value)) 
			{
				$query .= $last_key." = '".$last_value."'";
			}
			else
			{
				$query .= $last_key." = ".$last_value;
			}

			$conditions_length = count($conditions);
			if ($conditions_length > 0)
			{
				$query .= " WHERE ";
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
				end($conditions);
				$last_key = key($conditions);
				$last_value = $conditions[$last_key];
				if (is_string($last_value)) 
				{
					$query .= $last_key." = '".$last_value."'";
				}
				else
				{
					$query .= $last_key." = ".$last_value;
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
				end($conditions);
				$last_key = key($conditions);
				$last_value = $conditions[$last_key];
				if (is_string($last_value)) 
				{
					$query .= $last_key." = '".$last_value."'";
				}
				else
				{
					$query .= $last_key." = ".$last_value;
				}
				
			}
		    $conn->exec($query);
		}

		function insert($conn, $table, $columns, $values)
		{
			$i = 0;
			$query = "INSERT INTO ".$table." (";
			$columns_length = count($columns);
			for ($i=0; $i < $columns_length-1; $i++) 
			{ 
				$query .= $columns[$i].", ";
			}
			$query .= $columns[$i].") VALUES (";
			$values_length = count($values);

			for ($i=0; $i < $values_length-1; $i++) 
			{ 
				if (is_string($values[$i])) 
				{
					$query .= "'".$values[$i]."' ,";
				}
				else
				{
					$query .= $values[$i]." ,";
				}
			}
			if (is_string($values[$i])) 
			{
				$query .= "'".$values[$i]."')";
			}
			else
			{
				$query .= $values[$i].")";
			}
			$conn->exec($query);
		}

	}
 ?>