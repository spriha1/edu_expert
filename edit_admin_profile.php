<?php 
	session_start();

	if(isset($_SESSION["username"]))
	{
		$msg = "";
		include_once 'header.html';
		include_once 'csrf_token.php';
		echo '<body class="body1">';
		include_once 'admin_sidenav.php';
		include_once 'update_profile.php';
		$tooltip_msg = "The password : 
		Must be a minimum of 8 characters
		Must contain at least 1 number
		Must contain at least one uppercase character
		Must contain at least one lowercase character"; 
		?>
		
		<div class="container" style="text-align: center">
			
			<p style="color: #ff0000;"><?php echo $msg;?></p>
			<div class="card responsive bg-light mx-auto">
				<div class="card-header">
					<h3>Edit Your Personal Information</h3>
				</div>
    			<div class="card-body">
					<form method="POST" action="">
					    <div class="form-group">
					      <input type="text" class="form-control" id="fname" placeholder="Enter First Name" name="fname">
					    </div>
					    <div style="text-align: center;">
							<p style="color: #ff0000;"><?php echo $firstname_msg;?></p>	
						</div>
					    <div class="form-group">
					      <input type="text" class="form-control" id="lname" placeholder="Enter Last Name" name="lname">
					    </div>
					     <div style="text-align: center;">
							<p style="color: #ff0000;"><?php echo $lastname_msg;?></p>	
						</div>
					    <div class="form-group">
					      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email">
					    </div>
					     <div style="text-align: center;">
							<p style="color: #ff0000;"><?php echo $email_msg;?></p>	
						</div>
					    <div class="form-group">
					      <input type="text" class="form-control" id="username" data-toggle="tooltip" title="The username can contain letters, digits, @ and _" placeholder="Enter Username" name="username">
					    </div>
					     <div style="text-align: center;">
							<p style="color: #ff0000;"><?php echo $username_msg;?></p>	
						</div>
					    <div class="form-group">
					      <input type="password" class="form-control" id="password" data-toggle="tooltip" title="'.$tooltip_msg.'" placeholder="Enter Password" name="password">
					    </div>
					     <div style="text-align: center;">
							<p style="color: #ff0000;"><?php echo $password_msg;?></p>	
						</div>
					    <div class="form-group">
					    	<input type="hidden" name="token" value="<?php Token::generate(); ?>">
					    	<button type="submit" class="btn btn-success">Update</button>
					    </div>
					</form>
				</div>
			</div>
		</div>
		
	</body>
</html>
<?php
}
else
{
	header("Location:index.php");
}
?>