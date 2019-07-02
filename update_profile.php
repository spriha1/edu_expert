<?php 
	 
	
		$msg = "";
		include_once 'db_connection.php';
		include_once 'db_credentials.php';

	    $obj = new DB_connect();
	    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
		if(isset($_POST['fname']) && !empty($_POST['fname']))
		{
			$query = "UPDATE users SET firstname = '".$_POST['fname']."' WHERE username = '".$_SESSION['username']."'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
		}
		if(isset($_POST['lname']) && !empty($_POST['lname']))
		{
			$query = "UPDATE users SET lastname = '".$_POST['lname']."' WHERE username = '".$_SESSION['username']."'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
		}
		if(isset($_POST['password']) && !empty($_POST['password']))
		{
			$query = "UPDATE users SET password = '".md5($_POST['password'])."' WHERE username = '".$_SESSION['username']."'";
			$stmt = $conn->prepare($query);
			$stmt->execute();
		}
		if(isset($_POST['email']) && !empty($_POST['email']))
		{
			$query = "SELECT id FROM users WHERE email = '".$_POST['email']."'";
			$result = $obj->select_records($query);
			if ($result) {
				$msg = "Email Id already exists";
			}
			else
			{
				$query = "UPDATE users SET email_verification_status = 0 WHERE username = '".$_SESSION['username']."'";
				$stmt = $conn->prepare($query);
				$stmt->execute();

				require_once '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
				require_once '/usr/share/php/libphp-phpmailer/class.smtp.php';
				//require_once '/usr/share/php/libphp-phpmailer/PHPMailerAutoload.php';

				$mail = new PHPMailer;
				$mail->setFrom('spriha.mindfire@gmail.com');
				$mail->addAddress(''.$_POST['email'].'');
				$mail->Subject = 'Email Updation | Verification';
				$mail->Body = '
				 
				Please click this link to update your email:
				
				http://php.project.com/update_mail.php?email='.$_POST['email'].'&username='.$_SESSION['username'].'
				 
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
			
		}
		if(isset($_POST['username']) && !empty($_POST['username']))
		{
			$query = "SELECT id FROM users WHERE username = '".$_POST['username']."'";
			$result = $obj->select_records($query);
			if ($result) {
				$msg = "Username already exists";
			}
			else
			{
				$query = "UPDATE users SET username = '".$_POST['username']."' WHERE username = '".$_SESSION['username']."'";
				$stmt = $conn->prepare($query);
				$stmt->execute();
			}
			header("Location:logout.php");
			
		}
	
 ?>