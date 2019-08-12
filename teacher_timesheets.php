<?php 
	session_start();
	if (isset($_SESSION["username"])) {
		include_once 'header_dashboard.html';
		include_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';

		$obj = new DB_connect();
		$query = "SELECT from_id, of_date FROM shared_timesheets WHERE timesheet_check = 1 AND to_id =".$_SESSION['id'];

		$result = $obj->select_records($conn, $query);
		?>
		
		
		<div class="content-wrapper">
		<section class="content">
			<div class="row">
				<div class="col-xs-12">
					<div class="box">
						<div class="box-body">
							
							<table id="timesheet" class="table table-bordered table-striped">
								
							<thead>
								<tr>
									<th>First Name</th>
									<th>Username</th>
									<th>Date</th>
									<th></th>
								</tr>
							</thead>
							<?php
							foreach ($result as $key => $value) {
								$query2 = "SELECT firstname, username FROM users WHERE id =".$value['from_id'];
								$result2 = $obj->select_records($conn, $query2);
							    foreach ($result2 as $key2 => $value2) { ?>
							     	<tr>
										<td><?php echo $value2['firstname']; ?></td>
										<td><?php echo $value2['username']; ?></td>
										<td><?php echo date('d/m/Y', $value['of_date']); ?></td>
										
										<td>
											<button type="button" user_type="teacher" class="btn btn-success view" from_id="<?php echo $value['from_id']; ?>" of_date="<?php echo $value['of_date']; ?>" data-toggle="modal" data-target="#view_timesheets">View</button>
										</td>
									</tr>
									<?php
									}
							    }
							?>
						    </table></div>
						</div>
					</div>
				</div>
			</section>
		</div>
		<div class="modal" id="view_timesheets">
			<div class="modal-dialog">
				<div class="modal-content">

				<!-- Modal Header -->
					<div class="modal-header">
						<h4 class="modal-title">Timesheet</h4>
						<button type="button" class="close" data-dismiss="modal">&times;</button>
					</div>

					<!-- Modal body -->
					<div class="modal-body">
						<table class="table table-bordered table-striped">
							
							<thead>
								<tr>
									<th></th>
									<th>Subject</th>
									<th>Class</th>
									<th>Total time taken</th>
								</tr>
							</thead>
							<tbody id="view_timesheet">
								
							</tbody>
							<tr id="" class="timesheet_body">
								<td class="number"></td>
								<td class="subject"></td>
								<td class="class"></td>
								<td class="total_time"></td>
							</tr>
						</table>
					</div>

					<!-- Modal footer -->
					<div class="modal-footer">
						<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					</div>

				</div>
			</div>
		</div>
<?php 
	$file = 'timesheet_footer';
	include_once 'footer.php'; 
?>

<script src="<?php autoVer('/scripts/timesheet.js'); ?>"></script>

</body>
</html>
<?php
	}
	else {
		header("Location:index.php");
	}
?>