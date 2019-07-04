<?php 
	session_start();

	if(isset($_SESSION["username"]) && isset($_SESSION['firstname']))
	{
		include_once 'admin_sidenav.php';
		echo '<h1 style="text-align: center">Admin Dashboard</h1>';
	}
	else
	{
		header("Location:index.php");
	}
?>