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
		function update($conn, $query)
		{
			$sql = $conn->prepare($query);
		    $sql->execute();
		}
	}
 ?>