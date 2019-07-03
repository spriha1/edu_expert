<?php include_once 'header.html';?>
<body>
<?php 
	include_once 'db_connection.php';
	include_once 'db_credentials.php';

    $obj = new DB_connect();
    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
    
	if(isset($_GET['hash']) && !empty($_GET['hash'])){
	    $hash = base64_decode($_GET['hash']);
	    $query = "SELECT email, email_verification_code, email_verification_status FROM users WHERE email_verification_code='".$hash."' AND email_verification_status='0'";
	    $result = $obj->select_records($query);
	    if($result){
	    	$sql = $conn->prepare("UPDATE users SET email_verification_status='1' WHERE email_verification_code='".$hash."' AND email_verification_status=0");
	    	$sql->execute();
	        echo '<div>Your account has been activated, you can now <a href="index.php"> login</a></div>';
	    }else{
	        echo '<div>The url is either invalid or you already have activated your account.</div>';
	    }
	                 
	}else{
	    echo '<div>Invalid approach, please use the link that has been send to your email.</div>';
	}
 ?>
</body>
</html>