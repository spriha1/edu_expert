<?php
	include_once 'db_credentials.php';
	try {
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
				class TINYINT(1) NOT NULL DEFAULT '1',
				date_format VARCHAR(20) DEFAULT 'yyyy-mm-dd',
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

		$sql = "CREATE TABLE IF NOT EXISTS shared_timesheets (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				from_id INT,
				to_id INT,
				of_date INT,
				timesheet_check INT DEFAULT '0' 
			)"; 
		// timesheet_check = 1 for timesheets and 0 for goal_plans
		$conn->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS tasks (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				subject_id INT,
				class INT,
				start_date INT,
				end_date INT
			)";
		$conn->exec($sql);

		// $sql = "CREATE TABLE IF NOT EXISTS class (
		// 		id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
		// 		subject_id INT
		// 	)";
		// $conn->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS teacher_tasks (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				task_id INT UNSIGNED,
				teacher_id INT,
				on_date INT DEFAULT '0',
				total_time INT DEFAULT '0',
				CONSTRAINT test1 FOREIGN KEY (task_id)
	   			REFERENCES tasks(id)
			)";
		$conn->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS student_tasks (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				task_id INT UNSIGNED,
				student_id INT,
				total_time INT DEFAULT '0',
				CONSTRAINT test2 FOREIGN KEY (task_id)
	   			REFERENCES tasks(id)
			)";
		$conn->exec($sql);


		$sql = "CREATE TABLE IF NOT EXISTS subjects (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				name VARCHAR(30)
			)";
		$conn->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS teacher_subject (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				teacher_id INT UNSIGNED,
				subject_id INT UNSIGNED,
				CONSTRAINT test3 FOREIGN KEY (teacher_id)
				REFERENCES users(id),
				CONSTRAINT test4 FOREIGN KEY (subject_id)
				REFERENCES subjects(id)
			)";
		$conn->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS class (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				class INT UNSIGNED,
				subject_id INT UNSIGNED,
				teacher_id INT UNSIGNED,
				CONSTRAINT test5 FOREIGN KEY (teacher_id)
				REFERENCES users(id),
				CONSTRAINT test6 FOREIGN KEY (subject_id)
				REFERENCES subjects(id)
			)";
		$conn->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS feedback_parameters (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				parameter TEXT
			)";
		$conn->exec($sql);	

		$sql = "CREATE TABLE IF NOT EXISTS feedback_ratings (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				rating VARCHAR(20)
			)";
		$conn->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS feedback (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				from_id INT,
				for_id INT,
				parameter_id INT,
				rating_id INT
			)";
		$conn->exec($sql);

		$sql = "CREATE TABLE IF NOT EXISTS holiday (
				id INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				dow INT,
				start_date INT,
				end_date INT
			)";
		$conn->exec($sql);	

		$sql = "DROP TRIGGER IF EXISTS before_goal_plan_update;";
		$conn->exec($sql);

		$sql = "CREATE TRIGGER before_goal_plan_update BEFORE UPDATE ON goal_plan FOR EACH ROW BEGIN SET new.total_time = new.to_time - new.from_time; END;";
		$conn->exec($sql);
	}
	catch(PDOException $e) {
    	echo "Connection failed: " . $e->getMessage();
    }
    

?>