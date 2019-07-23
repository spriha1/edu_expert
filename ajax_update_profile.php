<?php 
	session_start();
	include_once 'csrf_token.php';
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
	require_once '/usr/share/php/libphp-phpmailer/class.phpmailer.php';
	require_once '/usr/share/php/libphp-phpmailer/class.smtp.php';
	include_once 'mail_credentials.php';

    $obj = new DB_connect();
    $msg = (object) null;
    // $msg->success = "";
    // $msg->email = "";
    // $msg->username = "";
	$table = "users";

    if (Token::check($_POST['token'])) {
		if (isset($_POST['fname']) && !empty($_POST['fname'])) {
			$columns = array("firstname" => $_POST['fname']);
		    $conditions = array("username" => $_SESSION['username']);
		    $obj->update($conn, $table, $columns, $conditions);
			//$query = "UPDATE users SET firstname = '".$_POST['fname']."' WHERE username = '".$_SESSION['username']."'";
			$msg->success = 1;
		}

		if (isset($_POST['lname']) && !empty($_POST['lname'])) {
			$columns = array("lastname" => $_POST['lname']);
		    $conditions = array("username" => $_SESSION['username']);
		    $obj->update($conn, $table, $columns, $conditions);
			//$query = "UPDATE users SET lastname = '".$_POST['lname']."' WHERE username = '".$_SESSION['username']."'";
			$msg->success = 1;
		}

		if (isset($_POST['password']) && !empty($_POST['password'])) {
			$pass = md5($_POST['password']);
			$columns = array("password" => $pass);
		    $conditions = array("username" => $_SESSION['username']);
		    $obj->update($conn, $table, $columns, $conditions);
			//$query = "UPDATE users SET password = '".md5($_POST['password'])."' WHERE username = '".$_SESSION['username']."'";
			$msg->success = 1;
		
		}

		if (isset($_POST['email']) && !empty($_POST['email'])) {
			$query = "SELECT id FROM users WHERE email = '".$_POST['email']."'";
			$result = $obj->select_records($conn, $query);
			if ($result) {
				$msg->email = 0;
			}

			else {
				$query = "SELECT email_verification_code FROM users WHERE username = '".$_SESSION['username']."'";
				$result = $obj->select_records($conn, $query);
				foreach ($result as $key => $value) {
					$hash = $value['email_verification_code'];
				}
				$columns = array("email_verification_status" => 0);
			    $conditions = array("username" => $_SESSION['username']);
			    $obj->update($conn, $table, $columns, $conditions);
				//$query = "UPDATE users SET email_verification_status = 0 WHERE username = '".$_SESSION['username']."'";
				
				$mail = new PHPMailer;
				$mail->setFrom('spriha.mindfire@gmail.com');
				$mail->addAddress(''.$_POST['email'].'');
				$mail->Subject = 'Email Updation | Verification';
				$mail->Body = '
				 
				Please click this link to update your email:
				
				http://php.project.com/update_mail.php?q='.base64_encode($hash).'&q1='.base64_encode($_POST['email']).'
				 
				 ';
				$mail->IsSMTP();
				$mail->SMTPSecure = 'ssl';
				$mail->Host = 'ssl://smtp.gmail.com';
				$mail->SMTPAuth = true;
				$mail->Port = 465;

				$mail->Username = $mail_username;
				$mail->Password = $mail_password;
				if (!$mail->send()) {
				  //$email_msg = 'Email is not sent.'. 'Email error: ' . $mail->ErrorInfo;
					$msg->email = 0;
				}
				else {
					//$email_msg = "Please verify it by clicking the activation link that has been send to your email.";
					$msg->email = 1;
				}
			}
		}

		if (isset($_POST['username']) && !empty($_POST['username'])) {
	
			$query = "SELECT id FROM users WHERE username = '".$_POST['username']."'";
			$result = $obj->select_records($conn, $query);
			if ($result) {
				$msg->username = 0;
			}
			else {
				$columns = array("username" => $_POST['username']);
			    $conditions = array("username" => $_SESSION['username']);
			    $obj->update($conn, $table, $columns, $conditions);
			    $msg->success = 1;
				//$query = "UPDATE users SET username = '".$_POST['username']."' WHERE username = '".$_SESSION['username']."'";
			}
			//header("Location:logout.php");
		}
	}
	$res = json_encode($msg);
	print_r($res);
 ?>