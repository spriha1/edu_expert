<?php include 'header.html';?>
<body>
	<nav class="navbar navbar-expand-sm bg-dark navbar-dark justify-content-end">
	  <form class="form-inline" action="login.php">
	    <input class="form-control mr-sm-2" type="text" placeholder="Enter Username">
	    <input class="form-control mr-sm-2" type="text" placeholder="Enter Password">
	    <button class="btn btn-success form-control mr-sm-2" type="submit">Login</button>
	    <a href="register.php">Signup</a>
	  </form>
	</nav>
    <br>
	<div class="container">
		<h1 class="justify-content-center">WELCOME</h1>
	</div>
	<?php include 'db_tables_creation.php'; ?>
</body>
</html>


