<?php if ($file === 'footer') { ?>
	<script src="bower_components/jquery/dist/jquery.min.js"></script>
	<script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="plugins/iCheck/icheck.min.js"></script>
	<script>
		$(function () {
			$('input').iCheck({
				checkboxClass: 'icheckbox_square-blue',
				radioClass: 'iradio_square-blue',
				increaseArea: '20%' /* optional */
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
	<script>
		$(document).ready(function(){
			$('#edit').click(function(){
				event.preventDefault();
				$(":input").attr("readonly", false);
				$("#edit").css('display', 'none');
				$("#update").css('display', 'block');
			});
			$('#change').click(function(){
				event.preventDefault();
				$("#pass").css('display', 'block');
				$("#edit").css('display', 'none');
				$("#update").css('display', 'block');
			});
		});
	</script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/timer.jquery/0.7.0/timer.jquery.js"></script>
	<script>
		$(document).ready(function() {
			$('.start').click(function() {
				$('.timer').timer({
					seconds: 0,
					hidden: false
				});
			})
			$('.stop').click(function() {
				var time = $('.timer').data('seconds');
				$('.timer').timer('remove');
				var task_id = $(this).attr('task_id');
				var user_id = $('#user_id').val();
				$.post('add_completion_time.php', {task_id: task_id, user_id: user_id, time: time})
			})
			$('.resume').click(function() {
				$('.timer').timer('resume');
			})
			$('.pause').click(function() {
				$('.timer').timer('pause');
			})
			
		})
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