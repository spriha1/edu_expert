<?php
	session_start();
	if (isset($_SESSION["username"]) && isset($_SESSION['firstname'])) {
		require_once 'header_dashboard.html';
		require_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';

		$obj = new DB_connect();
		$query1 = "SELECT count(*) as total FROM users WHERE user_reg_status = 1";
		$result1 = $obj->select_records($conn, $query1);
		$query2 = "SELECT count(*) as total FROM users WHERE user_reg_status = 0";
		$result2 = $obj->select_records($conn, $query2);
		$query3 = "SELECT count(*) as total FROM shared_timesheets WHERE to_id =".$_SESSION['id'];
		$result3 = $obj->select_records($conn, $query3);
		$query4 = "SELECT date_format FROM users WHERE username = '".$_SESSION['username']."'";
		$result4 = $obj->select_records($conn, $query4);
		?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Dashboard
		</h1>
	<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>">
	<?php foreach ($result4 as $key => $value) { ?>
		<input type="hidden" name="date_format" id="date_format" value="<?php echo $value['date_format'] ?>">
	<?php } ?>
	</section>
	<!-- Main content -->
	<section class="content">
		<!-- Small boxes (Stat box) -->
		<div class="row">
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-aqua">
					<div class="inner">
						<?php foreach ($result2 as $key => $value) { ?>
						<h3><?php echo $value['total']; ?></h3>
						<?php }?>
						<p>New Requests</p>
					</div>
					<div class="icon">
						<i class="ion ion-person-add"></i>
					</div>
					<a href="pending_requests.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-green">
					<div class="inner">
						<?php foreach ($result1 as $key => $value) { ?>
						<h3><?php echo $value['total']; ?></h3>
						<?php }?>
						<p>Registered Users</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
					</div>
					<a href="regd_users.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-yellow">
					<div class="inner">
						<?php foreach ($result3 as $key => $value) { ?>
						<h3><?php echo $value['total']; ?></h3>
						<?php }?>
						<p>Teacher Timesheets</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
					</div>
					<a href="teacher_timesheets.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
			<div class="col-lg-3 col-xs-6">
				<!-- small box -->
				<div class="small-box bg-red">
					<div class="inner">
						<h3>0</h3>
						<p>Student Feedbacks</p>
					</div>
					<div class="icon">
						<i class="ion ion-pie-graph"></i>
					</div>
					<a href="view_feedback.php" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
				</div>
			</div>
			<!-- ./col -->
		</div>
		<!-- /.row -->
		<!-- Main row -->
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-7 connectedSortable">
				
				<!-- TO DO List -->
				<div class="box box-primary">
					<div class="box-header">
						<i class="ion ion-clipboard"></i>
						<h3 class="box-title">Plan for the day</h3>
						<!-- <input class="pull-right date" id="date" type="date"> -->
						<input class="datepicker">
						<!-- <div class="box-tools pull-right">
							<ul class="pagination pagination-sm inline">
								<li><a href="#">&laquo;</a></li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">&raquo;</a></li>
							</ul>
						</div> -->
					</div>
					<!-- /.box-header -->
					<div class="box-body" id="plan">
						<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
						<ul class="todo-list todo">
							
						</ul>
						<li class="editable" goal_id="" style="display:none">
							<input type="checkbox" class="check_goal">			
							<span class="text"></span>
							<small class="label label-danger time" id="" style="visibility: hidden"><i class="fa fa-clock-o total_time"></i></small>
							<div class="tools">
								<!-- <i class="fa fa-edit"></i> -->
								<i class="fa fa-trash-o remove" goal_id=""></i>
							</div>
						</li>

						<ul class="todo-list">
							<li name="goal" id="goal" style="display:none;">
								<textarea style="width: 100%"></textarea>
							</li>
						</ul>
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix no-border">
						<button type="button" style="display: none" class="btn btn-success pull-right add" user_id="<?php echo $_SESSION['id'];?>">Add</button>
						<button type="button" class="btn btn-default add_item pull-right"><i class="fa fa-plus"></i> Add item</button>
					</div>
				</div>
				<!-- /.box -->
			</section>
			<!-- /.Left col -->
			<!-- right col (We are only adding the ID to make the widgets sortable)-->
			<section class="col-lg-5 connectedSortable">
				
				
			</section>
			<!-- right col -->
		</div>
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

<script src="<?php autoVer('/scripts/goals.js'); ?>"></script>
</body>
</html>
<?php
}
else {
header("Location:index.php");
}
?>