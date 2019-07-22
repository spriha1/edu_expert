<?php
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	require_once '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
	require_once '/usr/share/php/libphp-phpmailer/class.smtp.php';
	include_once 'mail_credentials.php';
	$msg = "";

	if (isset($_POST['username']) && isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['password']) && isset($_POST['usertype'])) {

		if (!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['fname']) AND !empty($_POST['lname']) AND !empty($_POST['password']) AND !empty($_POST['usertype'])) {

			$firstname = $_POST['fname'];
			$lastname = $_POST['lname'];
			$email = $_POST['email'];
			$user_name = $_POST['username'];
			$password = $_POST['password'];
			$pass = MD5($password);
			$user_type = $_POST['usertype'];
			$hash = md5(uniqid());

		    $obj = new DB_connect();
		    $query = "SELECT id,block_status FROM users WHERE email = '".$email."'";
		    $result = $obj->select_records($conn, $query);
		    if (!$result) {
		    	$query = "SELECT id FROM users WHERE username = '".$user_name."'";
		    	$result = $obj->select_records($conn, $query);

		    	if (!$result) {
		    		$query = "SELECT id FROM user_types where user_type = '".$user_type."'";
				    $result = $obj->select_records($conn, $query);
				    foreach ($result as $key => $value) {
				    	$table = "users";
				    	$columns = array("firstname", "lastname", "email", "username", "password", "email_verification_code", "user_type_id");
				    	$values = array($firstname, $lastname, $email, $user_name, $pass, $hash, intval($value['id']));
				    	$obj->insert($conn, $table, $columns, $values);
						//$sql = "INSERT INTO users (firstname, lastname, email, username, password, email_verification_code,user_type_id) VALUES ('".$firstname."','".$lastname."','".$email."','".$user_name."','".$pass."','".$hash."','".$value['id']."')";
					    //$conn->exec($sql);
				    }

					$mail = new PHPMailer;
					$mail->setFrom('spriha.mindfire@gmail.com');
					$mail->addAddress(''.$email.'');
					$mail->Subject = 'Signup | Verification';
					$mail->Body = '
					 
					Thanks for signing up!
					Your account has been created, you can login with the following credentials after you have activated your account by pressing the url below.
					 
					------------------------
					Username: '.$user_name.'
					Password: '.$pass.'
					------------------------
					 
					Please click this link to activate your account:
					
					http://php.project.com/verify_mail.php?q='.base64_encode($hash).'
					 ';
					$mail->IsSMTP();
					$mail->SMTPSecure = 'ssl';
					$mail->Host = 'ssl://smtp.gmail.com';
					$mail->SMTPAuth = true;
					$mail->Port = 465;

					$mail->Username = $mail_username;
					$mail->Password = $mail_password;
					if (!$mail->send()) {
					  $msg = 'Email is not sent.'. 'Email error: ' . $mail->ErrorInfo;
					}
					else {
						$msg = "Please verify it by clicking the activation link that has been send to your email.";
					}
		    	}
		    	else {
		    		$msg = "Username already exists";
		    	}
		    }

			else {
				foreach ($result as $key => $value) {
					if ($value['block_status']==1) {
						$msg = "This user has been blocked by the admin";
					}
					else {
						$msg = "Email already exists";
					}
				}
			}
		}			
	}
	print_r($msg);
?>