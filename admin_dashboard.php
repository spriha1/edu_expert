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

		$query = "SELECT id,goal,check_status FROM goal_plan WHERE user_id = '".$_SESSION['id']."' AND from_time LIKE '%".date("Y-m-d")."%'";
		$result = $obj->select_records($conn, $query);
		?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		<h1>
		Dashboard
		</h1>
		
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
						<h3>0</h3>
						<p>Teacher Timesheets</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
					</div>
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
					<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
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
					<div class="box-body">
						<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
						<ul class="todo-list todo">
							<?php foreach ($result as $key => $value) { ?>
							<li>
								<!-- <span class="handle">
									<i class="fa fa-ellipsis-v"></i>
									<i class="fa fa-ellipsis-v"></i>
								</span> -->
								<?php if($value['check_status'] == 1) { ?>
								<input type="checkbox" checked class="check_goal" value="<?php echo $value['id']; ?>">
								<?php } else { ?>
									<input type="checkbox" class="check_goal" value="<?php echo $value['id']; ?>">
								<?php } ?>
								<span class="text"><?php echo $value['goal']; ?></span>
								<!-- <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small> -->
								<div class="tools">
									<!-- <i class="fa fa-edit"></i> -->
									<i class="fa fa-trash-o remove" goal_id="<?php echo $value['id']; ?>"></i>
								</div>
							</li>
							<?php } ?>
							
						</ul>

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
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>

<script src="<?php autoVer('/scripts/goals.js'); ?>"></script>
</body>
</html>
<?php
}
else {
header("Location:index.php");
}
?>