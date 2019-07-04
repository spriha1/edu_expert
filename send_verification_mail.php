<?php
	$username_msg = "";
	$firstname_msg = "";
	$lastname_msg = "";
	$email_msg = "";
	$password_msg = "";
	$user_type_msg = "";

	if(isset($_POST['username']) && isset($_POST['email']) && isset($_POST['fname']) && isset($_POST['lname']) && isset($_POST['password']) && isset($_POST['user_type'])){

		if(!empty($_POST['username']) AND !empty($_POST['email']) AND !empty($_POST['fname']) AND !empty($_POST['lname']) AND !empty($_POST['password']) AND !empty($_POST['user_type']))
		{
			$user_name = $_POST['username'];
			$email = $_POST['email'];
			$firstname = $_POST['fname'];
			$lastname = $_POST['lname'];
			$pass = MD5($_POST['password']);
			$user_type = $_POST['user_type'];
			$msg = "Please verify it by clicking the activation link that has been send to your email.";
			$hash = md5(uniqid());

			include_once 'db_connection.php';
			include_once 'db_credentials.php';

		    $obj = new DB_connect();
		    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
		    $query = "SELECT id FROM users WHERE email = '".$email."'";
		    $result = $obj->select_records($query);
		    if(!$result)
		    {
		    	$query = "SELECT id FROM users WHERE username = '".$user_name."'";
		    	$result = $obj->select_records($query);
		    	if(!$result)
		    	{
		    		$query = "SELECT id FROM user_types where user_type = '".$user_type."'";
				    $result = $obj->select_records($query);
				    foreach ($result as $key => $value) {
						$sql = "INSERT INTO users (firstname, lastname, email, username, password, email_verification_code,user_type_id)
					    VALUES ('".$firstname."','".$lastname."','".$email."','".$user_name."','".$pass."','".$hash."','".$value['id']."')";

					    $conn->exec($sql);
				    }

				    require_once '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
					require_once '/usr/share/php/libphp-phpmailer/class.smtp.php';
					//require_once '/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php';

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

					include_once 'mail_credentials.php';
					$mail->Username = $mail_username;

					$mail->Password = $mail_password;
					if(!$mail->send()) {
					  $msg = 'Email is not sent.'. 'Email error: ' . $mail->ErrorInfo;
					}
		    	}
		    	else
		    	{
		    		$msg = "Username already exists";
		    	}
		    }

			else
			{
				$msg = "Email already exists";
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