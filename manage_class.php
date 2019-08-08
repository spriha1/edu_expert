<?php
	session_start();
	if (isset($_SESSION["username"]) && isset($_SESSION['firstname'])) {
		require_once 'header_dashboard.html';
		require_once 'admin_sidenav.php';
		include_once 'db_credentials.php';
		include_once 'db_connection.php';
		include_once 'static_file_version.php';
		$obj = new DB_connect();
		$query = "SELECT * from subjects";
		$result = $obj->select_records($conn, $query);

		?>
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
	<!-- Content Header (Page header) -->
	<section class="content-header">
		
	<input type="hidden" id="user_id" name="user_id" value="<?php echo $_SESSION['id']; ?>">
	</section>
	<!-- Main content -->
	<section class="content">
	
		<div class="row">
			<!-- Left col -->
			<section class="col-lg-7 connectedSortable">
				
				<!-- TO DO List -->
				<div class="box box-primary">
					
					<div class="box-body">
						<ul class="todo-list append_class">
							<li class="clone" class_id="" style="display:none">
								<span class="text"></span>
								<div class="tools">
									<i class="fa fa-edit edit" data-toggle="modal" data-target="#edit_class"></i>
									<i class="fa fa-trash-o remove"></i>
								</div>
							</li>
						</ul>
						
					</div>
					<!-- /.box-body -->
					<div class="box-footer clearfix no-border">
						<button type="button" class="btn btn-default add_item pull-right"><i class="fa fa-plus"></i> Add new class</button>
					</div>
				</div>
				<!-- /.box -->
			</section>
			<!-- /.Left col -->
			<!-- right col (We are only adding the ID to make the widgets sortable)-->
			<div class="modal" id="edit_class">
				<div class="modal-dialog">
					<div class="modal-content">

					<!-- Modal Header -->
						<div class="modal-header">
							<!-- <h4 class="modal-title">Modal Heading</h4> -->
							<button type="button" class="close" data-dismiss="modal">&times;</button>
						</div>

						<!-- Modal body -->
						<div class="modal-body">
							<table class="table table-striped">
								<thead>
									<tr>
										<th>Subject</th>
										<th>Teacher</th>
										<th></th>
									</tr>
								</thead>
								<tbody id="view_subjects">
					
								</tbody>
								<tr subject_id="" class_id="" class="subjects_body" style="display:none">
									<td class="subject_name"></td>
									<td class="teacher"></td>
									<td><a><i class="fa fa-trash-o remove_subject"></i></a></td>
								</tr>
							</table>
						</div>

						<!-- Modal footer -->
						<div class="modal-footer">
							<div class="box box-info _add_class" style="display:none">
								<form class="form-horizontal" id="_add_class" name="_add_class" method="POST">
									<input type="hidden" name="class" value="">
									<div class="box-body _append_teacher">
										<div class="form-group">
											<label for="subjects" class="col-sm-3 control-label">Subject</label>
											<div class="col-sm-9">
												<select class="_subject" id="subjects" name="subjects[]" multiple="multiple" style="width:100%">
													<?php foreach ($result as $key => $value) { ?>
													<option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
													<?php } ?>
												</select>
											</div>
										</div>
										<div class="form-group _editable" style="display:none;">
											<label for="" class="col-sm-3 control-label"></label>
											<div class="col-sm-9">
												<select class="_teacher form-control" name="">
													<option value=""></option>
												</select>
											</div>
										</div>
									</div>
									<!-- /.box-body -->
									<div class="box-footer">
										<button type="submit" id="_add" class="btn btn-info pull-right">Add</button>
									</div>
									<!-- /.box-footer -->
								</form>
							</div>
							<button class="btn btn-success add_subject">Add subject</button>
							<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
						</div>

					</div>
				</div>
			</div>
			<!-- right col -->
		</div>
		<!-- /.row (main row) -->
	</section>
	<!-- /.content -->
	<div class="col-md-6">
		<!-- Horizontal Form -->
		<div class="box box-info add_class" style="display:none">
			<form class="form-horizontal" id="add_class" name="add_class" method="POST">
				<div id="alert" class='alert alert-success' style="display: none;">
				</div>
				<div class="box-body append_teacher">
					<div class="form-group">
						<label for="class" class="col-sm-3 control-label">Class</label>
						<div class="col-sm-9">
							<input type="number" class="form-control" id="class" name="class">
						</div>
					</div>
					<div class="form-group">
						<label for="subjects" class="col-sm-3 control-label">Subject</label>
						<div class="col-sm-9">
							<select class="subject" id="subjects" name="subjects[]" multiple="multiple" style="width:100%">
								<?php foreach ($result as $key => $value) { ?>
								<option value="<?php echo $value['id'] ?>"><?php echo $value['name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					<div class="form-group editable" style="display:none;">
						<label for="" class="col-sm-3 control-label"></label>
						<div class="col-sm-9">
							<select class="teacher form-control" name="">
								<option value=""></option>
							</select>
						</div>
					</div>
				</div>
				<!-- /.box-body -->
				<div class="box-footer">
					<button type="submit" id="add" class="btn btn-info pull-right">Add</button>
				</div>
				<!-- /.box-footer -->
			</form>
		</div>
	</div>
</div>
<!-- /.content-wrapper -->

</div>
<!-- ./wrapper -->
<?php 
	$file = 'dashboard_footer';
	include_once 'footer.php'; 
?>

<script src="<?php autoVer('/scripts/manage_class.js'); ?>"></script>
</body>
</html>
<?php
}
else {
header("Location:index.php");
}
?>