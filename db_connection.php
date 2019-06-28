<?php 
	class DB_connect
	{
		public $conn;
		function connect($servername,$dbname,$username,$password)
		{
			$this->conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			return $this->conn;
		}
		function select_records($query)
		{
			$sql = $this->conn->prepare($query);
		    $sql->execute();
		    $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
		    $result = $sql->fetchAll();
		    return $result;
		}
	}
 ?>