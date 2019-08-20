<?php
	session_start();
	if (isset($_SESSION["username"])) {
		require_once 'header_dashboard.html';
		include_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';
		$obj = new DB_connect();
		$query = "SELECT date_format FROM users WHERE username = '".$_SESSION['username']."'";
		$result = $obj->select_records($conn, $query);

?>
<div class="content-wrapper">
	<br><br>
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			
			<form class="form-horizontal" id="holiday" name="holiday" method="POST">
				<div id="alert" class='alert alert-success' style="display: none;">
				</div>
				<img src="load.gif" id="spinner" style="display:none; width:20%; height:20%">
				<?php foreach ($result as $key => $value) { ?>
					<input type="hidden" name="date_format" id="date_format" value="<?php echo $value['date_format'] ?>">
				<?php } ?>
				<div class="box-header with-border">
	            	<h3 class="box-title">Add holiday</h3>
	            </div>
				<div class="box-body">
					
					<div class="form-group">
						<label for="day" class="col-sm-3 control-label">Select Day</label>
						<div class="col-sm-9">
							<select multiple="multiple" class="form-control day" id="day" name="day[]">
	            					<option value="0">Sunday</option>
	            					<option value="1">Monday</option>
	            					<option value="2">Tuesday</option>
	            					<option value="3">wednesday</option>
	            					<option value="4">Thursday</option>
	            					<option value="5">Friday</option>
	            					<option value="6">Saturday</option>
					      	</select>
					      	
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-3 control-label">Or</label>
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

<script src="<?php autoVer('/scripts/holiday.js'); ?>"></script>

</body>
</html>
<?php
}

else {
	header("Location:index.php");
}
?>