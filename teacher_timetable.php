<?php
	session_start();
	if (isset($_SESSION["username"])) {
		require_once 'header_dashboard.html';
		include_once 'teacher_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';
        
        $date = strval(date("Y-m-d"));

		$obj = new DB_connect();

		$query = "SELECT task_id FROM teacher_tasks WHERE teacher_id = ".$_SESSION['id'];
		$result = $obj->select_records($conn, $query);
?>
<div class="content-wrapper">
	<section class="content">
		<div class="row">
			<div class="col-xs-12">
				<div class="box">
					<div class="box-body">
						<table id="timetable" class="table table-bordered table-striped">
							<thead>
								<tr>
									<th></th>
									<th>Subject</th>
									<th>Class</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($result as $key => $value) {
									$query2 = "SELECT class, name FROM subjects INNER JOIN tasks ON (tasks.subject_id = subjects.id) WHERE tasks.id = ".$value['task_id'];
									$result2 = $obj->select_records($conn, $query2);
									foreach ($result2 as $key => $value2) { 
									$count = 1; ?>
									<tr>
										<td><?php echo $count; ?></td>
										<td><?php echo $value2['name']; ?></td>
										<td><?php echo $value2['class']; ?></td>
									</tr>
								<?php $count++; } } ?>
							</tbody>
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

<script>
	$('#timetable').DataTable();
</script>

</body>
</html>
<?php
}

else {
	header("Location:index.php");
}
?>