<?php 
	session_start();
	if (isset($_SESSION['username'])) {
		include_once 'db_credentials.php';
		include_once 'db_connection.php';

	    $obj = new DB_connect();
	    
		if(isset($_GET['q']) && !empty($_GET['q']) && isset($_GET['q1']) && !empty($_GET['q1'])){
		    $hash = base64_decode($_GET['q']);
		    $email = base64_decode($_GET['q1']);

		    $query = "SELECT id FROM users WHERE email_verification_code='".$hash."' AND email_verification_status=0";
		    $result = $obj->select_records($conn, $query);
		    if ($result){
		    	foreach ($result as $key => $value) {
		    		$table = "users";
				    $columns = array("email_verification_status" => 1, "email" => $email);
				    $conditions = array("id" => $value['id'], "email_verification_status" => 0);
				    $obj->update($conn, $table, $columns, $conditions);
		    		//$query2 = "UPDATE users SET email_verification_status=1 ,email = '".$email ."' WHERE id=".$value['id']." AND email_verification_status=0";
			        echo '<div>Your email has been updated, you can continue <a href="edit_profile.php"> here</a></div>';
		    	}
		    }
		    else {
		        echo '<div>The url is either invalid or you already have activated your account.</div>';
		    }
		                 
		}
		else {
		    echo '<div>Invalid approach, please use the link that has been send to your email.</div>';
		}
	}
	else {
		header("Location:index.php");
	}
 ?>
