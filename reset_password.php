<?php include_once 'header.html';?>
<body>
<?php 
	include_once 'db_connection.php';
	include_once 'db_credentials.php';

    $obj = new DB_connect();
    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
    
	if(isset($_GET['username']) && !empty($_GET['username']) AND isset($_GET['password']) && !empty($_GET['password'])){
	    $username = $_GET['username'];
	    $password = $_GET['password'];
	    $query = "SELECT id FROM users WHERE username='".$username."' AND user_reg_status = 1";
	    $result = $obj->select_records($query);
	    if($result){
	    	$sql = $conn->prepare("UPDATE users SET password='".md5($password)."' WHERE username='".$username."'");
	    	$sql->execute();
	        echo '<div>Your password has been reset, you can now <a href="index.php"> login</a></div>';
	    }else{
	        echo '<div>Your request has not been accepted by the admin yet</div>';
	    }
	                 
	}else{
	    echo '<div>Invalid approach, please use the link that has been send to your email.</div>';
	}
 ?>
</body>
</html>