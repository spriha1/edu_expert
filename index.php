<?php include_once 'header.html';?>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
	  <form class="form-inline" action="" method="POST">
	    <input class="form-control mr-sm-2" id="username" name="username" type="text" placeholder="Enter Username">
	    <input class="form-control mr-sm-2" id="password" name="password" type="password" placeholder="Enter Password">
	    <button class="btn btn-success form-control mr-sm-2" type="submit">Login</button>
	    <a href="forgot_password.php" style="padding: 15px" >Forgot Password?</a>
	    <a href="register.php">Signup</a>
	  </form>
	</nav>
	 
	<?php include_once 'login.php'; ?>

    <br>
	<div class="container">
		<h1 class="justify-content-center">WELCOME</h1>
	</div>
	<?php include_once 'db_tables_creation.php'; ?>
</body>
</html>


