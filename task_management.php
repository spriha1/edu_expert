<?php
	session_start();
	if (isset($_SESSION["username"])) {
		require_once 'header_dashboard.html';
		include_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';

		$obj = new DB_connect();
		$query = "SELECT DISTINCT class FROM class";
		$result = $obj->select_records($conn, $query);

		$query2 = "SELECT date_format FROM users WHERE username = '".$_SESSION['username']."'";
		$result2 = $obj->select_records($conn, $query2);

?>
<div class="content-wrapper">
	<br><br>
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<form class="form-horizontal" id="task" name="task" method="POST">
				<div id="alert" class='alert alert-success' style="display: none;">
				</div>
				<img src="load.gif" id="spinner" style="display:none; width:20%; height:20%">
				<?php foreach ($result2 as $key => $value) { ?>
					<input type="hidden" name="date_format" id="date_format" value="<?php echo $value['date_format'] ?>">
				<?php } ?>
				
				<div class="box-header with-border">
	            	<h3 class="box-title">Add tasks</h3>
	            </div>
				<div class="box-body">
					<div class="form-group">
						<label for="class" class="col-sm-3 control-label">Class</label>
						<div class="col-sm-9">
							<select class="form-control mb-2 mr-sm-2 class" name="class" id="class">
						    	<?php
						    		foreach ($result as $key => $value) {
						    	?>
						        <option value=<?php echo $value['class']; ?>><?php echo $value['class']; ?></option>
						        <?php } ?>
					      	</select>
						</div>
					</div>
					<div class="form-group">
						<label for="subject" class="col-sm-3 control-label">Subject</label>
						<div class="col-sm-9">
							<select multiple="multiple" class="form-control subject" id="subject" name="subject[]">
	            					
					      	</select>
					      	<option class="clone" value=""></option>
						</div>
					</div>

					<div class="form-group">
						<label for="start_date" class="col-sm-3 control-label">Start Date</label>
						<div class="col-sm-9">
							<input id="start_date" name="start_date" class="datepicker">
						</div>
					</div>

					<div class="form-group">
						<label for="end_date" class="col-sm-3 control-label">End Date</label>
						<div class="col-sm-9">
							<input id="end_date" name="end_date" class="datepicker">
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