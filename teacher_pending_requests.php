<?php 
session_start();
if(isset($_SESSION["username"]))
{
include_once 'header.html';
echo '<body class="body1">';
		include_once 'admin_sidenav.php';
		include_once 'db_connection.php';
		include_once 'db_credentials.php';

	    $obj = new DB_connect();
	    $conn = $obj->connect('localhost','php_project',$db_username,$db_password);
	    $query = "SELECT firstname, lastname, email, username FROM users where user_reg_status = 0 AND user_type_id = (SELECT id FROM user_types where user_type = 'Teacher')";
	    $result = $obj->select_records($query);
	    echo "<br><br>";
	    echo "<div class='container'>";
	    echo "<div class='card-columns'>";
	    foreach ($result as $key => $value) {
	     	echo "<div class='card bg-light'>";
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
					    <div class="form-group">
					      <a href="add_users.php?username='.$value["username"].'"><button class="btn btn-success">Accept</button></a>
					      <a href="remove_users.php?username='.$value["username"].'"><button class="btn btn-success">Reject</button></a>
					      <a href="block_users.php?username='.$value["username"].'"><button class="btn btn-success">Block</button></a>
					    </div>
					    </form>';
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