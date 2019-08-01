<?php
	include_once 'db_credentials.php';
    $conn = new PDO("mysql:host=$server_name", $db_username, $db_password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $sql = "CREATE DATABASE IF NOT EXISTS php_project";
    $conn->exec($sql);

    $conn = new PDO("mysql:host=$server_name;dbname=$db_name", $db_username, $db_password);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

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
			login_status TINYINT(1) NOT NULL DEFAULT '0',
			user_type_id INT UNSIGNED,
			CONSTRAINT test FOREIGN KEY (user_type_id)
   			REFERENCES user_types(id) ,
   			INDEX (email_verification_code,firstname,lastname,username)
		)";
	$conn->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS chat_message (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			to_user_id INT,
			from_user_id INT,
			chat_message TEXT,
			chat_time timestamp DEFAULT CURRENT_TIMESTAMP
		)";
	$conn->exec($sql);

	$sql = "CREATE TABLE IF NOT EXISTS goal_plan (
			id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
			user_id INT,
			goal TEXT,
			from_time timestamp DEFAULT CURRENT_TIMESTAMP,
			to_time timestamp DEFAULT CURRENT_TIMESTAMP,
			total_time INT DEFAULT '0',
			check_status TINYINT(1) NOT NULL DEFAULT '0'
		)";
	$conn->exec($sql);

	$sql = "CREATE TRIGGER before_goal_plan_update BEFORE UPDATE ON goal_plan FOR EACH ROW BEGIN SET new.total_time = new.to_time - new.from_time; END;";
	$conn->exec($sql);

?>