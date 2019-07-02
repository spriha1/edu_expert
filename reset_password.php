<?php 
	if (isset($_POST["password"]) AND !empty($_POST["password"])) {
		
		$password = $_POST["password"];
		include_once 'db_connection.php';
		include_once 'db_credentials.php';

	    $obj = new DB_connect();
	    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
    
	
	    $query = "SELECT username FROM users WHERE id ='".$id."' AND user_reg_status = 1";
	    $result = $obj->select_records($query);
	    if($result){
	    	$sql = $conn->prepare("UPDATE users SET password='".md5($password)."' WHERE id='".$id."'");
	    	$sql->execute();
	        echo '<div>Your password has been reset, you can now <a href="index.php"> login</a></div>';
	    }else{
	        echo '<div>Your request has not been accepted by the admin yet</div>';
	    }
	}             
	

 ?>
</body>
</html>