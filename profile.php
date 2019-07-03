<?php 
	session_start();
	if(isset($_SESSION["username"]))
	{
		echo '<body>';
		include_once 'header.html';
		include_once 'admin_sidenav.php';
		include_once 'db_connection.php';
		include_once 'db_credentials.php';

	    $obj = new DB_connect();
	    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
	    $query = "SELECT firstname, lastname, email, username FROM users WHERE username = '".$_SESSION['username']."'";

	    $result = $obj->select_records($query);
	    echo "<br><br>";
	    echo "<div class='container'>";
	    echo "<div class='card-columns'>";
	    foreach ($result as $key => $value) {
	     	echo "<div class='card bg-secondary'>";
	     	echo "<div class='card-body text-center'>";
	     	echo '<form>
					    <div class="form-group">
					      First Name :<input type="text" readonly class="form-control" value="'.$value["firstname"].'">
					    </div>
					    <div class="form-group">
					      Last Name :<input type="text" readonly class="form-control" value="'.$value["lastname"].'">
					    </div>
					    <div class="form-group">
					      Username :<input type="text" readonly class="form-control" value="'.$value["username"].'">
					    </div>
					    <div class="form-group">
					      Email:<input type="text" readonly class="form-control" value="'.$value["email"].'">
					    </div>
				</form>';
			
			echo '<a href="edit_profile.php?username='.$value["username"].'"><button>Edit</button></a>';

	     	echo "</div></div>";
	     } 
	 }
	 else
	 {
	 	header("Location:index.php");
	 }
	?>	
</body>
</html>