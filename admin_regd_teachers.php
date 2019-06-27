<?php include 'header.html';?>
<body>
	<?php
		include 'db_connection.php';
		include 'db_credentials.php';

	    $obj = new DB_connect();
	    $conn = $obj->connect('localhost','php_project',$username,$password);
		$sql = $conn->prepare("SELECT firstname, lastname, email, username FROM users where user_reg_status = 1 AND user_type_id = (SELECT u_id FROM type_of_user where user_type = 'Teacher')");
	    $sql->execute();
	    $result = $sql->setFetchMode(PDO::FETCH_ASSOC);user_type_id
	    $result = $sql->fetchAll();
	    echo "<br><br>";
	    echo "<div class='container'>";
	    echo "<div class='card-columns'>";
	    foreach ($result as $key => $value) {
	     	echo "<div class='card bg-secondary'>";
	     	echo "<div class='card-body text-center'>";
	     	echo '<form>
					    <div class="form-group">
					      First Name :<input type="text" class="form-control" value="'.$value["firstname"].'">
					    </div>
					    <div class="form-group">
					      Last Name :<input type="text" class="form-control" value="'.$value["lastname"].'">
					    </div>
					    <div class="form-group">
					      Username :<input type="text" class="form-control" value="'.$value["username"].'">
					    </div>
					    <div class="form-group">
					      Email:<input type="text" class="form-control" value="'.$value["email"].'">
					    </div>
					    <a href=""><button>Update</button></a>
					    <a href=""><button>Remove</button></a>
					    <a href=""><button>Block</button></a>
					    </form>';

	     	echo "</div></div>";
	     } 
	?>	
</body>