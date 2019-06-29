<?php 
	session_start();

	if(isset($_SESSION["username"]))
	{
		
	include_once 'header.html';
	echo '
	<body>
		<br>
		<br>
		<h1 style="text-align: center">Admin Dashboard</h1>
		<div class="container">
			<div class="card-columns">
			    <div class="card bg-secondary">
			      <div class="card-body text-center">
			        <p class="card-text"><a href="admin_regd_students.php" style="color: #000000">Registered Students</p></a>
			      </div>
			    </div>
			    <div class="card bg-secondary">
			      <div class="card-body text-center">
			        <p class="card-text"><a href="admin_regd_teachers.php" style="color: #000000">Registered Teachers</p></a>
			      </div>
			    </div>
			    <div class="card bg-secondary">
			      <div class="card-body text-center">
			        <p class="card-text"><a href="student_pending_requests.php" style="color: #000000">Pending Requests of Students</p></a>
			      </div>
			    </div>
			    <div class="card bg-secondary">
			      <div class="card-body text-center">
			        <p class="card-text"><a href="teacher_pending_requests.php" style="color: #000000">Pending Requests of Teachers</p></a>
			      </div>
			    </div>
			</div>
		</div>	
		<a href="logout.php"><button>LOGOUT</button></a>
	</body>';
	}
	else
	{
		header("Location:index.php");
	}
?>