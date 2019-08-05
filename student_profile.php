<?php
	session_start();
	if (isset($_SESSION["username"])) {
		require_once 'header_dashboard.html';
		include_once 'student_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';
		include_once 'csrf_token.php';

		$obj = new DB_connect();
		$query = "SELECT firstname, lastname, email, username, password FROM users WHERE username = '".$_SESSION['username']."'";
		$result = $obj->select_records($conn, $query);
?>
<div class="content-wrapper">
	<br><br>
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info">
			<form class="form-horizontal" id="registration" name="registration" method="POST">
				<div id="alert" class='alert alert-danger' style="display: none;">
				</div>
				<div class="box-body">
					<?php foreach ($result as $key => $value) { ?>
					<div class="form-group">
						<label for="fname" class="col-sm-3 control-label">First Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="fname" name="fname" readonly value="<?php echo $value['firstname'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="lname" class="col-sm-3 control-label">Last Name</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="lname" name="lname" readonly value="<?php echo $value['lastname'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="username" class="col-sm-3 control-label">Username</label>
						<div class="col-sm-9">
							<input type="text" class="form-control" id="username" name="username" readonly value="<?php echo $value['username'];?>">
						</div>
					</div>
					<div class="form-group">
						<label for="email" class="col-sm-3 control-label">Email</label>
						<div class="col-sm-9">
							<input type="email" class="form-control" id="email" name="email" readonly value="<?php echo $value['email'];?>">
						</div>
					</div>
					<div class="form-group" id="pass" style="display: none">
						<label for="password" class="col-sm-3 control-label">Password</label>
						<div class="col-sm-9">
							<input type="password" class="form-control" id="password" name="password">
						</div>
					</div>
				</div>
				<input type="hidden" id="token" name="token" value="<?php echo Token::generate(); ?>">
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" id="change" class="btn btn-default">Change password</button>
					<button type="submit" id="edit" class="btn btn-info pull-right">Edit</button>
					<button type="submit" id="update" style="display:none;" class="btn btn-info pull-right">Update</button>
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

<script src="<?php autoVer('/scripts/edit.js'); ?>"></script>
</body>
</html>
<?php
}
}
else {
	header("Location:index.php");
}
?>