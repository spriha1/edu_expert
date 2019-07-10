<?php
	$servername = "localhost";
	include_once 'db_credentials.php';
    $conn = new PDO("mysql:host=$servername", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS php_project";
    $conn->exec($sql);
	include_once 'db_connection.php';
    $obj = new DB_connect();
    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);

	$sql = "CREATE TABLE IF NOT EXISTS user_types (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_type VARCHAR(20)
			
		)";
	$conn->exec($sql);
	
	$sql = "CREATE TABLE IF NOT EXISTS users (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			firstname VARCHAR(50),
			lastname VARCHAR(50),
			email VARCHAR(50) NOT NULL UNIQUE,
			username VARCHAR(50) NOT NULL UNIQUE,
			password VARCHAR(50) NOT NULL,
			token VARCHAR(50),
			email_verification_code VARCHAR(32) ,
			email_verification_status TINYINT(1) NOT NULL DEFAULT '0',
			user_reg_status TINYINT(1) NOT NULL DEFAULT '0',
			block_status TINYINT(1) NOT NULL DEFAULT '0',
			user_type_id INT UNSIGNED,
			CONSTRAINT test FOREIGN KEY (user_type_id)
   			REFERENCES user_types(id) ,
   			INDEX (email_verification_code,firstname,lastname,username)
		)";
	$conn->exec($sql);
?>