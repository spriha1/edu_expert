<?php
			$servername = "localhost";
			$username = "spriha";
			$password = "mindfire";
			$conn = new mysqli($servername, $username, $password);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "CREATE DATABASE IF NOT EXISTS email";

			if ($conn->query($sql) === TRUE) {
				echo "Database created successfully";
			} else {
				echo "Error creating database: " . $conn->error;
			}

			$dbname = "email";
			$conn = new mysqli($servername, $username, $password, $dbname);

			if ($conn->connect_error) {
				die("Connection failed: " . $conn->connect_error);
			}

			$sql = "CREATE TABLE IF NOT EXISTS users (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				firstname VARCHAR(30) NOT NULL,
				lastname VARCHAR(30) NOT NULL,
				email VARCHAR(50) NOT NULL UNIQUE,
				password VARCHAR(10) NOT NULL
				);";
			
			$sql .= "CREATE TABLE IF NOT EXISTS mails (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				subject VARCHAR(30) NOT NULL,
				body VARCHAR(30) NOT NULL
			);";

			$sql .= "CREATE TABLE IF NOT EXISTS sender_receiver (
				id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
				from_id INT(6) UNSIGNED,
				to_id INT(6) UNSIGNED,
				message_id INT(6) UNSIGNED,
				time_of_mail TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
				CONSTRAINT testkey1 FOREIGN KEY (message_id)
   				REFERENCES mails(id),
   				CONSTRAINT testkey2 FOREIGN KEY (from_id)
   				REFERENCES users(id),
   				CONSTRAINT testkey3 FOREIGN KEY (to_id)
   				REFERENCES users(id)
			);";

			if ($conn->multi_query($sql) === TRUE) {
			echo "New tables created successfully";
			} else {
			echo "Error: " . $sql . "<br>" . $conn->error;
			}

			$conn->close();
		?>