<?php
	session_start();
	if (isset($_SESSION["username"])) {
		require_once 'header_dashboard.html';
		include_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';
?>
<div class="content-wrapper">
	<br><br>
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<form class="form-horizontal" method="POST">
				<div id="alert" class='alert alert-danger' style="display: none;">
				</div>
				<div class="box-header with-border">
	            	<h3 class="box-title">Add criteria for feedback</h3>
	            </div>
				<div class="box-body">
					<div class="form-group">
						<div class="col-sm-12">
							<textarea style="width: 100%"></textarea>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" class="btn btn-success pull-right">Add</button>
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

<script src="<?php autoVer('/scripts/.js'); ?>"></script>

</body>
</html>
<?php
}

else {
	header("Location:index.php");
}
?>