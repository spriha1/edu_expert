<?php
	session_start();
	if (isset($_SESSION["username"]) && isset($_SESSION['firstname'])) {
		require_once 'header_dashboard.html';
		require_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';

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
	
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-7 connectedSortable">
				
				<!-- TO DO List -->
				<div class="box box-primary">
					
					<!-- /.box-header -->
					<div class="box-body">
						<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
						<ul class="todo-list todo">
							<li class="editable" subject_id="" style="display:none">
								<span class="text"></span>
								<div class="tools">
									<!-- <i class="fa fa-edit edit"></i> -->
									<i class="fa fa-trash-o remove"></i>
								</div>
							</li>
						</ul>
						

						<ul class="todo-list">
							<li name="subject" id="subject" style="display:none;">
								<textarea style="width: 100%"></textarea>
							</li>
						</ul>
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix no-border">
						<button type="button" style="display: none" class="btn btn-success pull-right add" user_id="<?php echo $_SESSION['id'];?>">Add</button>
						<button type="button" class="btn btn-default add_item pull-right"><i class="fa fa-plus"></i> Add new subject</button>
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

<script src="<?php autoVer('/scripts/manage_subjects.js'); ?>"></script>
</body>
</html>
<?php
}
else {
header("Location:index.php");
}
?>