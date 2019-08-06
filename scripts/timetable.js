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
	$('#date').attr('value',date);

	$('#share').click(function(event) {
		event.preventDefault();
		var user_id = $("#user_id").val();
		var date = $("#date").val();
		$.post('add_shared_timesheets.php', {user_id: user_id, date: date, timesheet_check: 1});
	});
})