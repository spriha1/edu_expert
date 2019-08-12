<?php if ($file === 'footer') { ?>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="plugins/iCheck/icheck.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' /* optional */
			});
			$('.subject').select2({
				width: 'resolve'
			});
		});
	</script>
<?php } 

else if ($file === 'dashboard_footer') {
?>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script>
	$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

	<script src="dist/js/adminlte.min.js"></script>
	<script src="dist/js/pages/dashboard.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
	
	<script>
		$(document).ready(function() {
			$('.datepicker').datepicker({
				format: 'yyyy-mm-dd'
			});
			$('.subject').select2({
				width: 'resolve'
			});
			$('._subject').select2({
				width: 'resolve'
			});
		})
	</script>
<?php } 

else if ($file === 'profile_footer') {
?>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/jquery-ui/jquery-ui.min.js"></script>
	<script>
	$.widget.bridge('uibutton', $.ui.button);
	</script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="dist/js/adminlte.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.8/js/select2.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.18.1/moment.min.js"></script>


	<script>
		$(document).ready(function(){
			$('#edit').click(function(){
				event.preventDefault();
				$(":input").attr("readonly", false);
				$("#date_format").attr("disabled", false);
				$("#edit").css('display', 'none');
				$("#update").css('display', 'block');
			});
			$('#change').click(function(){
				event.preventDefault();
				$("#pass").css('display', 'block');
				$("#edit").css('display', 'none');
				$("#update").css('display', 'block');
			});
			$('.start').click(function() {
				$(this).closest('tr').find('.timer').timer({
					seconds: 0,
					hidden: false
				});
			})
			$('.stop').click(function() {
				var time = $(this).closest('tr').find('.timer').data('seconds');
				$('.timer').timer('remove');
				var task_id = $(this).attr('task_id');
				var user_id = $('#user_id').val();
				var user_type = $('#user_type').val();

				$.post('add_completion_time.php', {task_id: task_id, user_id: user_id, time: time, user_type: user_type})
			})
			$('.resume').click(function() {
				$(this).closest('tr').find('.timer').timer('resume');
			})
			$('.pause').click(function() {
				$(this).closest('tr').find('.timer').timer('pause');
			})

			$('.datepicker').datepicker({
				format: $('#date_format').val()
			});

			$('.subject').select2({
				width: 'resolve'
			});
		});
	</script>
<?php } 

else if ($file === 'timesheet_footer') {
?>
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
<?php } ?>