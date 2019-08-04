<?php 
	session_start();
	if (isset($_SESSION["username"])) {
		include_once 'header_dashboard.html';
		include_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';

		$obj = new DB_connect();
		$query = "SELECT from_id,of_date FROM shared_timesheets WHERE to_id =".$_SESSION['id'];
		$result = $obj->select_records($conn, $query);
		foreach ($result as $key => $value) {
			$query2 = "SELECT firstname, username FROM users WHERE id =".$value['from_id'];
			$result2 = $obj->select_records($conn, $query2);
		?>
		
		<br><br>

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
						    foreach ($result2 as $key2 => $value2) { ?>
						     	<tr>
									<td><?php echo $value2['firstname']; ?></td>
									<td><?php echo $value2['username']; ?></td>
									<td><?php echo $value['of_date']; ?></td>
									
									<td>
										<button type="button" class="btn btn-success view" from_id="<?php echo $value['from_id']; ?>" of_date="<?php echo $value['of_date']; ?>" data-toggle="modal" data-target="#view_timesheets">View</button>
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
							<table id="view_timesheet" class="table table-bordered table-striped">
								
								<thead>
									<tr>
										<th></th>
										<th>Goal</th>
										<th>From time</th>
										<th>To time</th>
										<th>Total time taken</th>
									</tr>
								</thead>
								<tbody class="timesheet_body">
									<tr id="">
										<td class="number"></td>
										<td class="goal"></td>
										<td class="from_time"></td>
										<td class="to_time"></td>
										<td class="total_time"></td>
									</tr>
								</tbody>
							</table>
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>
<script src="bower_components/jquery/dist/jquery.min.js"></script>
<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
<script>
$.widget.bridge('uibutton', $.ui.button);
</script>
<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<script src="dist/js/adminlte.min.js"></script>
<script src="dist/js/pages/dashboard.js"></script>
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
  $(function () {
    $('#timesheet').DataTable({
      'paging'      : true,
      'lengthChange': true,
      'searching'   : true,
      'ordering'    : true,
      'info'        : true,
      'autoWidth'   : false
    })
  })
</script>
<script>
	$(document).ready(function() {
		$('.view').click(function() {
			var from_id = $(this).attr('from_id');
			var of_date = $(this).attr('of_date');
			$.post('fetch_timesheet.php', {from_id: from_id, of_date: of_date}, function(result) {
				var response = JSON.parse(result);
				var length = response.length;
				for (var i = 0; i < length; i++) 
				{
					var element = $('.timesheet_body').clone(true).removeClass('timesheet_body');
					element.find('.number').text(i+1);
					element.find('.goal').text(response[0].goal);
					element.find('.from_time').text(response[0].from_time);
					element.find('.to_time').text(response[0].to_time);
					element.find('.total_time').text(response[0].total_time);
					element.appendTo('#view_timesheet');
				}
				
			});
		})
	})
</script>
</body>
</html>
<?php
	}
	else {
		header("Location:index.php");
	}
?>