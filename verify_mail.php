<?php 
	include_once 'header.html';
	include_once 'db_credentials.php';
	include_once 'db_connection.php';
?>
<body>
<?php 
    $obj = new DB_connect();
    
	if (isset($_GET['q']) && !empty($_GET['q'])) {
	    $hash = base64_decode($_GET['q']);
	    $query = "SELECT email, email_verification_code, email_verification_status FROM users WHERE email_verification_code='".$hash."' AND email_verification_status='0'";
	    $result = $obj->select_records($conn, $query);
	    if ($result) {
	    	$table = "users";
		    $columns = array("email_verification_status" => 1);
		    $conditions = array("email_verification_code" => $hash, "email_verification_status" => 0);
		    $obj->update($conn, $table, $columns, $conditions);
	    	//$query2 = "UPDATE users SET email_verification_status=1 WHERE email_verification_code='".$hash."' AND email_verification_status=0";
	        echo '<div>Your account has been activated, you can now <a href="index.php"> login</a></div>';
	    }
	    else {
	        echo '<div>The url is either invalid or you already have activated your account.</div>';
	    }
	}
	else {
	    echo '<div>Invalid approach, please use the link that has been send to your email.</div>';
	}
 ?>
</body>
</html>