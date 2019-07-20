<?php 
	session_start();

	if(isset($_SESSION["username"]))
	{
		$msg = "";
		include_once 'header.html';
		include_once 'csrf_token.php';
		include_once 'teacher_sidenav.php';
		include_once 'update_profile.php';
		?>
		<body class="body1">
		<div class="container" style="text-align: center">
			
			<p style="color: #ff0000;"><?php echo $msg;?></p>
			<div class="card responsive bg-light mx-auto">
				<div class="card-header">
					<h3>Edit Your Personal Information</h3>
				</div>
    			<div class="card-body">
    				<div id="alert"></div>
					<form method="POST" action="" name="registration" id="registration">
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
					      <input type="text" class="form-control" id="username" placeholder="Enter Username" name="username">
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
	<script src="validate.js?v=1"></script>
	</body>
</html>
<?php
}
else
{
	header("Location:index.php");
}
?>