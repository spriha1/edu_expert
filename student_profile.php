<?php
	session_start();
	if (isset($_SESSION["username"])) {
		require_once 'header_dashboard.html';
		include_once 'student_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		$obj = new DB_connect();
		$query = "SELECT firstname, lastname, email, username, password FROM users WHERE username = '".$_SESSION['username']."'";
		$result = $obj->select_records($conn, $query);
?>
<div class="content-wrapper">
	<br><br>
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<form class="form-horizontal">
				<div class="box-body">
					<?php foreach ($result as $key => $value) { ?>
					<div class="form-group">
						<label for="fname" class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="fname" readonly value="<?php echo $value['firstname'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="lname" class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="lname" readonly value="<?php echo $value['lastname'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-3 control-label">Username</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="username" readonly value="<?php echo $value['username'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="email" readonly value="<?php echo $value['email'];?>">
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-default">Change password</button>
					<button type="submit" id="edit" class="btn btn-info pull-right">Edit</button>
					<button type="submit" id="update" style="display:none;" class="btn btn-info pull-right">Update</button>
				</div>
				<!-- /.box-footer -->
			</form>
		</div>
	</div>
</div>
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
<script>
	$(document).ready(function(){
		$('#edit').click(function(){
			$(":input").attr("readonly", false);
			$("#edit").css('display', 'none');;
			$("#update").css('display', 'block');;
		});
	});
</script>
</body>
</html>
<?php
}
}
else {
	header("Location:index.php");
}
?>