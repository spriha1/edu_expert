<?php 
	session_start();
	if(isset($_SESSION["username"])):
		echo '<body class="body1">';
		include_once 'header.html';
		include_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';

	    $obj = new DB_connect();
	    $query = "SELECT firstname, lastname, email, username, password FROM users WHERE username = '".$_SESSION['username']."'";
	    $result = $obj->select_records($conn, $query);
	    ?>
	    
	    <br><br>
	    <div class='container'>
	    <div class='card responsive mx-auto'>
	    <?php foreach ($result as $key => $value):?>

	     	<div class='card bg-light'>
		     	<div class='card-body text-center'>
			     	<form>
					    <div class="form-group">
					      First Name :<input type="text" readonly class="form-control" value="<?php echo $value['firstname'];?>">
					    </div>
					    <div class="form-group">
					      Last Name :<input type="text" readonly class="form-control" value="<?php echo $value['lastname'];?>">
					    </div>
					    <div class="form-group">
					      Username :<input type="text" readonly class="form-control" value="<?php echo $value['username'];?>">
					    </div>
					    <div class="form-group">
					      Email:<input type="text" readonly class="form-control" value="<?php echo $value['email'];?>">
					    </div>
					</form>
					<a href="edit_admin_profile.php?username='<?php echo $value['username'];?>'"><button class="btn btn-success">Edit</button></a>
		     	</div>
	     	</div>
	     	<?php
	    endforeach; 
	else:
		header("Location:index.php");
	endif;
?>	
</body>
</html>