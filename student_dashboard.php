<?php 
	session_start();

	if (isset($_SESSION["username"]) && isset($_SESSION['firstname'])) {
		include_once 'student_sidenav.php';
		echo '<body class="body1"><h1 style="text-align: center">Student Dashboard</h1></body>';
	}
	else {
		header("Location:index.php");
	}
?>