<?php include 'header.html';?>
<body>
<?php 
	$server = "localhost";
	$db = "php_project";
	$uname = "spriha";
	$pass = "pass";
	$conn = new PDO("mysql:host=$server;dbname=$db", $uname, $pass);
	$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	if(isset($_GET['email']) && !empty($_GET['email']) AND isset($_GET['hash']) && !empty($_GET['hash'])){
	    $email = $_GET['email'];
	    $hash = $_GET['hash'];
	    $search = $conn->prepare("SELECT email, verify_hash, verify_status FROM users WHERE email='".$email."' AND hash='".$hash."' AND verify_status='0'"); 
	    $search->execute();
    	$result = $search->setFetchMode(PDO::FETCH_ASSOC);
    	$result = $search->fetchAll();
	    if($result){
	    	$sql = $conn->prepare("UPDATE users SET verify_status='1' WHERE email='".$email."' AND hash='".$hash."' AND verify_status='0'");
	    	$sql->execute();
	        echo '<div>Your account has been activated, you can now <a href="login.php"> login</a></div>';
	    }else{
	        echo '<div>The url is either invalid or you already have activated your account.</div>';
	    }
	                 
	}else{
	    echo '<div>Invalid approach, please use the link that has been send to your email.</div>';
	}
 ?>
</body>
</html>