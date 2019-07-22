<?php
	include_once 'validate_input.php';
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	require_once '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
	require_once '/usr/share/php/libphp-phpmailer/class.smtp.php';
	include_once 'mail_credentials.php';
	require_once 'csrf_token.php'; 
	$msg = "";
	$username_msg = "";
	$firstname_msg = "";
	$lastname_msg = "";
	$email_msg = "";
	$password_msg = "";
	$user_type_msg = "";

	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['password']) && isset($_POST['user_type']))
	{
		if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['fname']) AND !empty($_POST['lname']) AND !empty($_POST['password']) AND !empty($_POST['user_type']) AND Token::check($_POST['token']))
		{
			$user_name = Validation::test_input($_POST['username']);
			$email = Validation::test_input($_POST['email']);
			$firstname = Validation::test_input($_POST['fname']);
			$lastname = Validation::test_input($_POST['lname']);
			$password = Validation::test_input($_POST['password']);
			$pass = MD5($password);
			$user_type = $_POST['user_type'];
			$hash = md5(uniqid());

			$fname_test = Validation::validate_name($firstname);
			$lname_test = Validation::validate_name($lastname);
			$username_test = Validation::validate_username($user_name);
			$email_test = Validation::validate_email($email);
			$password_test = Validation::validate_password($password);

			if($fname_test && $lname_test && $username_test && $email_test && $password_test)
			{
			    $obj = new DB_connect();
			    $query = "SELECT id,block_status FROM users WHERE email = '".$email."'";
			    $result = $obj->select_records($conn, $query);
			    if(!$result)
			    {
			    	$query = "SELECT id FROM users WHERE username = '".$user_name."'";
			    	$result = $obj->select_records($conn, $query);
			    	if(!$result)
			    	{
			    		$query = "SELECT id FROM user_types where user_type = '".$user_type."'";
					    $result = $obj->select_records($conn, $query);
					    foreach ($result as $key => $value) 
					    {
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
						if(!$mail->send()) {
						  $msg = 'Email is not sent.'. 'Email error: ' . $mail->ErrorInfo;
						}
						else
						{
							$msg = "Please verify it by clicking the activation link that has been send to your email.";
						}
			    	}
			    	else
			    	{
			    		$msg = "Username already exists";
			    	}
			    }

				else
				{
					foreach ($result as $key => $value) 
					{
						if($value['block_status']==1)
						{
							$msg = "This user has been blocked by the admin";
						}
						else
						{
							$msg = "Email already exists";
						}
					}
				}
			}
			else
			{
				if(!$fname_test)
				{
					$firstname_msg = "Invalid name format";
				}
				if(!$lname_test)
				{
					$lastname_msg = "Invalid name format";
				}
				if(!$username_test)
				{
					$username_msg = "Invalid username format";
				}
				if(!$email_test)
				{
					$email_msg = "Invalid email format";
				}
				if(!$password_test)
				{
					$password_msg = "Invalid password format";
				}
			} 
		}
		else
		{
			if (empty($_POST['username'])) {
				$username_msg = "Please enter the username";
			}
			if (empty($_POST['fname'])) {
				$firstname_msg = "Please enter your first name";
			}
			if (empty($_POST['lname'])) {
				$lastname_msg = "Please enter your last name";
			}
			if (empty($_POST['password'])) {
				$password_msg = "Please enter the password";
			}
			if (empty($_POST['email'])) {
				$email_msg = "Please enter an email";
			}
			if (empty($_POST['user_type'])) {
				$user_type_msg = "Please select a user type";
			}
		}						
	}
?>