<?php include 'header.html';?>
<body>
	<?php
		$servername = "localhost";
		$username = "spriha";
		$password = "mindfire";
		$db = "php_project";
		$conn = new PDO("mysql:host=$servername;dbname=$db", $username, $password);
		$conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		$sql = $conn->prepare("SELECT firstname, lastname, email, username FROM users where verified_user = 1 AND id IN (SELECT u_id FROM type_of_user where user_type = 'Teacher')");
	    $sql->execute();
	    $result = $sql->setFetchMode(PDO::FETCH_ASSOC);
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
					    <a href=""><button>Accept</button></a>
					    <a href=""><button>Reject</button></a>
					    <a href=""><button>Block</button></a>
					    </form>';

	     	echo "</div></div>";
	     } 
	?>	
</body>