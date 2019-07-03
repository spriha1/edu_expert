<?php 
	session_start();
	if (isset($_SESSION['username'])) {
		session_unset();
	}
	include_once 'header.html';?>
<body>
	<?php 
		include_once 'navbar.php';
	?>
    <br>
	<div class="container">
		<h1 class="justify-content-center">WELCOME</h1>
	</div>
	<?php include_once 'db_tables_creation.php'; ?>
</body>
</html>