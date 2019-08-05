<?php
	session_start();
	if (isset($_SESSION["username"])) {
		require_once 'header_dashboard.html';
		include_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';

		$obj = new DB_connect();
		$query = "SELECT * FROM subjects";
		$result = $obj->select_records($conn, $query);

		$query1 = "SELECT users.id, firstname FROM users INNER JOIN user_types ON (users.user_type_id = user_types.id) WHERE  user_type = 'Teacher'";
		$result1 = $obj->select_records($conn, $query1);
?>
<div class="content-wrapper">
	<br><br>
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<form class="form-horizontal" id="task" name="task" method="POST">
				<div id="alert" class='alert alert-success' style="display: none;">
				</div>
				<div class="box-header with-border">
	            	<h3 class="box-title">Add tasks</h3>
	            </div>
				<div class="box-body">
					<div class="form-group">
						<label for="subject" class="col-sm-3 control-label">Subject</label>
						<div class="col-sm-9">
							<select class="form-control" id="subject" name="subject">
							<?php
	            				foreach ($result as $key => $value) { ?>
	            					<option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
	            			<?php }?>
					      	</select>
						</div>
					</div>
					<div class="form-group">
						<label for="class" class="col-sm-3 control-label">Class</label>
						<div class="col-sm-9">
							<select class="form-control" id="class" name="class">
						        <option value="1">1</option>
						        <option value="2">2</option>
						        <option value="3">3</option>
						        <option value="4">4</option>
						        <option value="5">5</option>
					      	</select>
						</div>
					</div>
					<div class="form-group">
						<label for="teacher" class="col-sm-3 control-label">Teacher</label>
						<div class="col-sm-9">
							<select class="form-control" id="teacher" name="teacher">
							<?php
	            				foreach ($result1 as $key => $value) { ?>
	            					<option value="<?php echo $value['id'] ?>"><?php echo $value['firstname']; ?></option>
	            			<?php }?>
					      	</select>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-info pull-right">Add</button>
				</div>
				<!-- /.box-footer -->
			</form>
		</div>
	</div>
</div>
<?php 
	$file = 'profile_footer';
	include_once 'footer.php'; 
?>

<script src="<?php autoVer('/scripts/task.js'); ?>"></script>

</body>
</html>
<?php
}

else {
	header("Location:index.php");
}
?>