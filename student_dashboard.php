<?php
	session_start();
	if (isset($_SESSION["username"]) && isset($_SESSION['firstname'])) {
		require_once 'header_dashboard.html';
		require_once 'student_sidenav.php'; ?>
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
						<h3>0</h3>
						<p>Time Table</p>
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
				<div class="small-box bg-green">
					<div class="inner">
						<h3>0</h3>
						<p>Attendance</p>
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
				<div class="small-box bg-yellow">
					<div class="inner">
						<h3>0</h3>
						<p>Dues</p>
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
						<p>Feedbacks</p>
					</div>
					<div class="icon">
						<i class="ion ion-person"></i>
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
						<div class="box-tools pull-right">
							<ul class="pagination pagination-sm inline">
								<li><a href="#">&laquo;</a></li>
								<li><a href="#">1</a></li>
								<li><a href="#">2</a></li>
								<li><a href="#">3</a></li>
								<li><a href="#">&raquo;</a></li>
							</ul>
						</div>
					</div>
					<!-- /.box-header -->
					<div class="box-body">
						<!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
						<ul class="todo-list">
							<li>
								<!-- drag handle -->
								<span class="handle">
									<i class="fa fa-ellipsis-v"></i>
									<i class="fa fa-ellipsis-v"></i>
								</span>
								<!-- checkbox -->
								<input type="checkbox" value="">
								<!-- todo text -->
								<span class="text">Design a nice theme</span>
								<!-- Emphasis label -->
								<small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
								<!-- General tools such as edit or delete-->
								<div class="tools">
									<i class="fa fa-edit"></i>
									<i class="fa fa-trash-o"></i>
								</div>
							</li>
						</ul>
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix no-border">
						<button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
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
<script src="bower_components/raphael/raphael.min.js"></script>
<script src="bower_components/morris.js/morris.min.js"></script>
<script src="bower_components/jquery-sparkline/dist/jquery.sparkline.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-1.2.2.min.js"></script>
<script src="plugins/jvectormap/jquery-jvectormap-world-mill-en.js"></script>
<script src="bower_components/jquery-knob/dist/jquery.knob.min.js"></script>
<script src="bower_components/moment/min/moment.min.js"></script>
<script src="bower_components/bootstrap-daterangepicker/daterangepicker.js"></script>
<script src="bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js"></script>
<script src="plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js"></script>
<script src="bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<script src="bower_components/fastclick/lib/fastclick.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="dist/js/demo.js"></script>
</body>
</html>
<?php
}
else {
header("Location:index.php");
}
?>