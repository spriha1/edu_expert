$(document).ready(function() {
	var date = new Date();
	// var year = today.getFullYear();
	// var month = today.getMonth()+1;
	// var date = today.getDate();
	// if (month < 10 && date < 10)
	// {
	// 	var date = year+'-0'+month+'-0'+date;
	// }
	// else if (month < 10)
	// {
	// 	var date = year+'-0'+month+'-'+date;
	// }
	// else if (date < 10)
	// {
	// 	var date = year+'-'+month+'-0'+date;
	// }
	//$('#date').attr('value',date);
	$('.datepicker').datepicker('setDate', date);
	//date = $(".datepicker").data('datepicker').getFormattedDate('yyyy-mm-dd');
	var date = $('#date').val(); 
	var user_id = $('#user_id').val();
	var user_type = $('#user_type').val();
	var date_format = $('#date_format').val();

	load_display_data(date,user_id,user_type,date_format);

	$('#share').click(function(event) {
		event.preventDefault();
		var user_id = $("#user_id").val();

		var date_format = $('#date_format').val();
		var date = $("#date").val();
		$.post('add_shared_timesheets.php', {user_id: user_id, date: date, timesheet_check: 1, date_format: date_format});
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
		// var today = new Date(date);
		// var year = today.getFullYear();
		// var month = today.getMonth()+1;
		// var date = today.getDate();
		// if (month < 10 && date < 10)
		// {
		// 	var date = year+'-0'+month+'-0'+date;
		// }
		// else if (month < 10)
		// {
		// 	var date = year+'-0'+month+'-'+date;
		// }
		// else if (date < 10)
		// {
		// 	var date = year+'-'+month+'-0'+date;
		// }
		var user_id = $('#user_id').val();
		var user_type = $('#user_type').val();
		var date_format = $('#date_format').val();

		$('.timetable').html("");
		load_display_data(date,user_id,user_type,date_format);
	})
})

function load_display_data(date,user_id,user_type,date_format) {
	$.post('display_timetable.php', {date: date, user_id: user_id, user_type: user_type, date_format: date_format}, function(result) {
		var response = JSON.parse(result);
		var tasks = response[0];
		var length = tasks.length;
		if (user_type === 'teacher') {
			for (var i = 0; i < length; i++) {
				console.log(response)
				let element = $(".editable").clone(true).css('display', 'table-row').removeClass('editable');
				element.attr('task_id', tasks[i].task_id);
				element.appendTo('.timetable');
				var task_id = tasks[i].task_id;

				// var seconds = response[i].total_time;
				// if (seconds > 0) {
				// 	var hours = Math.floor(seconds / 3600);
				// 	seconds = seconds - (hours * 3600);
				// 	var minutes = Math.floor(seconds / 60);
				// 	seconds = seconds - (minutes * 60);
				// 	var time = hours + ':' + minutes + ':' + seconds;
				// 	$("tbody tr[task_id=" + task_id + "] .timer").val(time);

				// }
				
				$("tbody tr[task_id=" + task_id + "] .subject").val(tasks[i].name);
				$("tbody tr[task_id=" + task_id + "] .class").val(tasks[i].class);
				//$("tbody tr[task_id=" + task_id + "] .stop").attr('task_id', response[i].task_id);
				console.log(response[task_id].length);
				var len = response[task_id].length;
				for(var j = 0; j < len; j++)
				{
					if(response[task_id][j].length != 0) 
					{
						console.log("hi");
						var task_id = response[task_id][j][0].task_id;
						$("tbody tr[task_id=" + task_id + "] td[dow=" + j + "] input").val(response[task_id][j][0].total_time);
						$("tbody tr[task_id=" + task_id + "] td[dow=" + j + "] input").css('display', 'table-row');

					}
				}
			}
		}
		// else if (user_type === 'student') {
		// 	for (var i = 0; i < length; i++) {
		// 		let element = $(".editable").clone(true).css('display', 'table-row').removeClass('editable');
		// 		element.attr('task_id', response[i].task_id);
		// 		element.appendTo('.timetable');
		// 		task_id = response[i].task_id;
		// 		$("tbody tr[task_id=" + task_id + "] .name").html(response[i].name);
		// 		$("tbody tr[task_id=" + task_id + "] .teacher").html(response[i].firstname);
		// 		$("tbody tr[task_id=" + task_id + "] .stop").attr('task_id', response[i].task_id);
		// 	}
		// }
	});
}