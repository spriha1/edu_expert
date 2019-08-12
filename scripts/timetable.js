$(document).ready(function() {
	var today = new Date();
	var year = today.getFullYear();
	var month = today.getMonth()+1;
	var date = today.getDate();
	if (month < 10 && date < 10)
	{
		var date = year+'-0'+month+'-0'+date;
	}
	else if (month < 10)
	{
		var date = year+'-0'+month+'-'+date;
	}
	else if (date < 10)
	{
		var date = year+'-'+month+'-0'+date;
	}
	console.log(date);
	//$('#date').attr('value',date);
	$('.datepicker').datepicker('setDate', date);

	var user_id = $('#user_id').val();
	var user_type = $('#user_type').val();
	load_display_data(date,user_id,user_type);

	$('#share').click(function(event) {
		event.preventDefault();
		var user_id = $("#user_id").val();
		var date = $("#date").val();
		$.post('add_shared_timesheets.php', {user_id: user_id, date: date, timesheet_check: 1});
	});

	// $("#date").change(function(event) {
	// 	var date = $(this).val();
	// 	var user_id = $('#user_id').val();
	// 	var user_type = $('#user_type').val();

	// 	$('.timetable').html("");
	// 	load_display_data(date,user_id,user_type);
	// });

	$('.datepicker').datepicker().on('changeDate', function(e) {
		var date = e.format();
		console.log(date)
		var today = new Date(date);
		var year = today.getFullYear();
		var month = today.getMonth()+1;
		var date = today.getDate();
		if (month < 10 && date < 10)
		{
			var date = year+'-0'+month+'-0'+date;
		}
		else if (month < 10)
		{
			var date = year+'-0'+month+'-'+date;
		}
		else if (date < 10)
		{
			var date = year+'-'+month+'-0'+date;
		}
		console.log(date);
		var user_id = $('#user_id').val();
		var user_type = $('#user_type').val();

		$('.timetable').html("");
		load_display_data(date,user_id,user_type);
	})
})

function load_display_data(date,user_id,user_type) {
	$.post('display_timetable.php', {date: date, user_id: user_id, user_type: user_type}, function(result) {
		var response = JSON.parse(result);
		var length = response.length;
		if (user_type === 'teacher') {
			for (var i = 0; i < length; i++) {
				let element = $(".editable").clone(true).css('display', 'table-row').removeClass('editable');
				element.attr('task_id', response[i].task_id);
				element.appendTo('.timetable');
				console.log($(".editable"))
				task_id = response[i].task_id;
				$("tbody tr[task_id=" + task_id + "] .name").html(response[i].name);
				$("tbody tr[task_id=" + task_id + "] .class").html(response[i].class);
				$("tbody tr[task_id=" + task_id + "] .stop").attr('task_id', response[i].task_id);
			}
		}
		else if (user_type === 'student') {
			for (var i = 0; i < length; i++) {
				let element = $(".editable").clone(true).css('display', 'table-row').removeClass('editable');
				element.attr('task_id', response[i].task_id);
				element.appendTo('.timetable');
				console.log($(".editable"))
				task_id = response[i].task_id;
				$("tbody tr[task_id=" + task_id + "] .name").html(response[i].name);
				$("tbody tr[task_id=" + task_id + "] .teacher").html(response[i].firstname);
				$("tbody tr[task_id=" + task_id + "] .stop").attr('task_id', response[i].task_id);
			}
		}
	});
}