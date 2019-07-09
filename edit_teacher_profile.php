<?php 
	session_start();
	if(isset($_SESSION["username"]))
	{
		$msg = "";
		include_once 'header.html';
		echo '<body class="body1">';
		include_once 'teacher_sidenav.php';
		include_once 'update_profile.php'; 
		$tooltip_msg = "The password : 
		Must be a minimum of 8 characters
		Must contain at least 1 number
		Must contain at least one uppercase character
		Must contain at least one lowercase character";
		
		echo '<div class="container" style="text-align: center">
			
			<p> '.$msg.'</p>
			<div class="card bg-light responsive mx-auto">
				<div class="card-header">
					<h3>Edit Your Personal Information</h3>
				</div>
    			<div class="card-body">
					<form method="POST" action="">
					    <div class="form-group">
					      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
					    </div>
					    <div class="form-group">
					      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
					    </div>
					    <div class="form-group">
					      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
					    </div>
					    <div class="form-group">
					      <input type="text" class="form-control" id="username" data-toggle="tooltip" title="The username can contain letters, digits, @ and _" placeholder="Enter Username" name="username">
					    </div>
					    <div class="form-group">
					      <input type="password" class="form-control" id="password" data-toggle="tooltip" title="'.$tooltip_msg.'" placeholder="Enter Password" name="password">
					    </div>
					    <div class="form-group">
					    	<button type="submit" class="btn btn-success">Update</button>
					    </div>
					</form>
				</div>
			</div>
		</div>
		
	</body>
</html>';
}
else
{
	header("Location:index.php");
}
?>