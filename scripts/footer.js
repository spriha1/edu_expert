$(document).ready(function() {
	var footer = document.getElementById("footer").getAttribute("footer");
	if (footer === "footer") {
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
	}

	else if (footer === "dashboard_footer") {
		$.widget.bridge('uibutton', $.ui.button);
		$('.datepicker').datepicker({
			format: $('#date_format').val()
		});
		$('.subject').select2({
			width: 'resolve'
		});
		$('._subject').select2({
			width: 'resolve'
		});
	}

	else if (footer === "profile_footer") {
		$.widget.bridge('uibutton', $.ui.button);
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
	}

	else if (footer === "timesheet_footer") {
		$.widget.bridge('uibutton', $.ui.button);
	}
})