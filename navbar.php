<?php 
	$msg = "";
	include_once 'login.php'; 
?>
<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
    <div>
    	<form class="form-inline" action="" method="POST">
    	    <input class="form-control mr-sm-2" id="username" name="username" type="text" placeholder="Enter Username">
    	    <input class="form-control mr-sm-2" id="password" name="password" type="password" placeholder="Enter Password">
    	    <button class="btn btn-success form-control mr-sm-2" type="submit">Login</button>
    	    <a href="forgot_password.php" style="padding: 15px" >Forgot Password?</a>
    	    <a href="register.php">Signup</a>
    	</form>
    </div>
    <div>
        <p style="color:#ff0000;"><?php echo $msg; ?></p>
    </div>
</nav>