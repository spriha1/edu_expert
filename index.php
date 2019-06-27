<?php include 'header.html';?>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
	  <form class="form-inline" action="login.php">
	    <input class="form-control mr-sm-2" type="text" placeholder="Enter Username">
	    <input class="form-control mr-sm-2" type="text" placeholder="Enter Password">
	    <button class="btn btn-success form-control mr-sm-2" type="submit">Login</button>
	    <a href="register.php">Signup</a>
	  </form>
	</nav>
<br>
	<div class="container">
		<h1 class="justify-content-center">WELCOME</h1>
	</div>
	<?php
	//create database
	$servername = "localhost";
	$username = "spriha";
	$password = "mindfire";
	try {
	    $conn = new PDO("mysql:host=$servername", $username, $password);
	    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	    $sql = "CREATE DATABASE IF NOT EXISTS php_project";
	    $conn->exec($sql);
    }
	catch(PDOException $e)
	    {
	    echo $sql . "<br>" . $e->getMessage();
	    }
	//create table
	$conn = new PDO("mysql:host=$servername;dbname=php_project", $username, $password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			firstname VARCHAR(20),
			lastname VARCHAR(20),
			email VARCHAR(50) NOT NULL UNIQUE,
			username VARCHAR(50) NOT NULL UNIQUE,
			password VARCHAR(50) NOT NULL,
			verify_hash VARCHAR(32) NOT NULL ,
			verify_status INT(1) NOT NULL DEFAULT '0',
			verified_user INT(1) NOT NULL DEFAULT '0'

		)";
	$conn->exec($sql);
	$sql = "CREATE TABLE IF NOT EXISTS type_of_user (
			u_id INT UNSIGNED,
			user_type VARCHAR(20),
			CONSTRAINT test FOREIGN KEY (u_id)
   			REFERENCES users(id) 
		)";
	$conn->exec($sql);
		
?>
</body>
</html>


