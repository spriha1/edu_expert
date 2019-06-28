<?php
	$msg = "";
	if(isset($_POST['username']) && !empty($_POST['username']) AND isset($_POST['email']) && !empty($_POST['email']) AND isset($_POST['fname']) && !empty($_POST['fname']) AND isset($_POST['lname']) && !empty($_POST['lname']) AND isset($_POST['password']) && !empty($_POST['password'])){
		$user_name = $_POST['username'];
		$email = $_POST['email'];
		$firstname = $_POST['fname'];
		$lastname = $_POST['lname'];
		$pass = MD5($_POST['password']);
		$user_type = $_POST['user_type'];
		$msg = "Please verify it by clicking the activation link that has been send to your email.";
		$hash = md5(uniqid());

		include 'db_connection.php';
		include 'db_credentials.php';

	    $obj = new DB_connect();
	    $conn = $obj->connect('localhost','php_project',$username,$password);
	    $query = "SELECT u_id FROM type_of_user where user_type = '".$user_type."'";
	    $result = $obj->select_records($query);
	    //echo $result['u_id'];
		$sql = "INSERT INTO users (firstname, lastname, email, username, password, email_verification_code,user_type_id)
	    VALUES ('".$firstname."','".$lastname."','".$email."','".$user_name."','".$pass."','".$hash."','".$result['u_id']."')";

	    $conn->exec($sql);

	    require '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
		require '/usr/share/php/libphp-phpmailer/class.smtp.php';
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
		
		http://php.project.com/verify_mail.php?email='.$email.'&hash='.$hash.'
		 ';
		$mail->IsSMTP();
		$mail->SMTPSecure = 'ssl';
		$mail->Host = 'ssl://smtp.gmail.com';
		$mail->SMTPAuth = true;
		$mail->Port = 465;

		include 'mail_credentials.php';
		$mail->Username = $mail_username;

		$mail->Password = $mail_password;
		if(!$mail->send()) {
		  echo 'Email is not sent.';
		  echo 'Email error: ' . $mail->ErrorInfo;
		}
								
	}
			
?>