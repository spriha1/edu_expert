<?php
	session_start();
	if (isset($_SESSION["username"]) && isset($_SESSION['firstname'])) {
		require_once 'header_dashboard.html';
		require_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';

		// $obj = new DB_connect();
		// $query1 = "SELECT count(*) as total FROM users WHERE user_reg_status = 1";
		// $result1 = $obj->select_records($conn, $query1);
		// $query2 = "SELECT count(*) as total FROM users WHERE user_reg_status = 0";
		// $result2 = $obj->select_records($conn, $query2);
		// $query3 = "SELECT count(*) as total FROM shared_timesheets WHERE to_id =".$_SESSION['id'];
		// $result3 = $obj->select_records($conn, $query3);
		?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		
	<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>">
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-4 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<!-- <h3>0</h3> -->
						<p>Manage Subjects</p>
					</div>
					<!-- <div class="icon">
						<i class="ion ion-person-add"></i>
					</div> -->
					<a href="manage_subjects.php" class="small-box-footer">More info<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<!-- <h3>0</h3> -->
						<p>Manage class</p>
					</div>
					<!-- <div class="icon">
						<i class="ion ion-person"></i>
					</div> -->
					<a href="manage_class.php" class="small-box-footer">More info<i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-4 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<!-- <h3>0</h3> -->
						<p>Add tasks</p>
					</div>
					<!-- <div class="icon">
						<i class="ion ion-person"></i>
					</div> -->
					<a href="task_management.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			
			<!-- ./col -->
		</div>
		<!-- /.row -->
		<!-- Main row -->
		
		<!-- /.row (main row) -->
	</section>
	<!-- /.content -->
</div>
<!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
<?php 
	$file = 'dashboard_footer';
	include_once 'footer.php'; 
?>

</body>
</html>
<?php
}
else {
header("Location:index.php");
}
?>