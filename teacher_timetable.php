<?php
	session_start();
	if (isset($_SESSION["username"])) {
		require_once 'header_dashboard.html';
		include_once 'teacher_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';
		$obj = new DB_connect();
		$query = "SELECT date_format FROM users WHERE username = '".$_SESSION['username']."'";
		$result = $obj->select_records($conn, $query);
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-header">
						<!-- <input class="date" id="date" type="date"> -->
						<input id="date" class="datepicker">
						<button type="button" id="share" class="btn btn-success pull-right">Share</button>
					</div>

					<?php foreach ($result as $key => $value) { ?>
						<input type="hidden" name="date_format" id="date_format" value="<?php echo $value['date_format'] ?>">
					<?php } ?>
					<div class="box-body">
						<input type="hidden" id="user_id" value="<?php echo $_SESSION['id']; ?>">
						<input type="hidden" id="user_type" value="teacher">

						<table id="timetable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th width="16%">Task</th>
									<th width="12%">Sunday</th>
									<th width="12%">Monday</th>
									<th width="12%">Tuesday</th>
									<th width="12%">Wednesday</th>
									<th width="12%">Thursday</th>
									<th width="12%">Friday</th>
									<th width="12%">Saturday</th>
								</tr>
							</thead>
							<tbody class="timetable">
							</tbody>
							
						</table>
						<table style="display:none">
						<tr class="editable" width="25%" task_id="" style="display:none;">

							<td width="16%" class="task"></td>
							<td width="12%" dow="0"></td>
							<td width="12%" dow="1"></td>
							<td width="12%" dow="2"></td>
							<td width="12%" dow="3"></td>
							<td width="12%" dow="4"></td>
							<td width="12%" dow="5"></td>
							<td width="12%" dow="6"></td>

							<td class="name" width="25%"></td>
							<td class="class" width="25%"></td>
							<td width="25%"><input class="timer" type="text" value=""></td>
							<td>
								<button class="btn btn-info start">Start</button>
								<button class="btn btn-info stop" style="display:none" task_id="">Stop</button>
								<button class="btn btn-info pause" style="display:none">Pause</button>
								<button class="btn btn-info resume" style="display:none">Resume</button>
							</td>
						</tr>
					</table>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
<?php 
	$file = 'profile_footer';
	include_once 'footer.php'; 
?>
<script src="<?php autoVer('/scripts/timetable.js'); ?>"></script>

</body>
</html>
<?php
}

else {
	header("Location:index.php");
}
?>