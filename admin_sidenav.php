<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="style.css">
</head>
<body>

<div id="mySidenav" class="sidenav">
  <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
  <p style="font-size: 20px; color:#f1f1f1;">Welcome <?php echo $_SESSION['firstname'] ?></p>
  <a href="profile.php">My Profile</a>
  <a href="admin_regd_students.php">Registered Students</a>
  <a href="admin_regd_teachers.php">Registered Teachers</a>
  <a href="student_pending_requests.php">Pending Requests of Students</a>
  <a href="teacher_pending_requests.php">Pending Requests of Teachers</a>
  <a href="logout.php">Logout</a>
</div>
<span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776; </span>

<script src="sidenav.js">
</script>
   
</body>
</html> 
