$(document).ready(function() {
	$('#task').submit(function(event) {
		event.preventDefault();
		// var teacher_id = $('#teacher').val();
		// var subject_id = $('#subject').val();
		// var class_id= $('#class').val();
		// end_date = $('#end_date').val();
		$("#spinner").css('display','block');
		// var start_date = format_date($('#start_date').val());
		// var end_date = format_date($('#end_date').val());
		// var _class = $('#class').val();
		// var subject = $('#subject').val();
		var start_date = $('#start_date').val();
		var date_format = $('#date_format').val();
		if (date_format === 'yyyy.mm.dd') {
			start_date = start_date.split(".").join("-")
		}
		else if (date_format === 'yyyy/mm/dd') {
			start_date = start_date.split("/").join("-")
		}
		else if (date_format === 'yyyy-mm-dd') {
			start_date = start_date
		}
		else if (date_format === 'dd.mm.yyyy') {
			start_date = start_date.split(".").reverse().join("-")
		}
		else if (date_format === 'dd/mm/yyyy') {
			start_date = start_date.split("/").reverse().join("-")
		}
		else if (date_format === 'dd-mm-yyyy') {
			start_date = start_date.split("-").reverse().join("-")
		}
		console.log(start_date);
		$.post('add_timetable.php', $('#task').serialize(), function(result) {
			$('#spinner').css('display', 'none');
			$('#alert').text(result).css('display', 'block');
			$('.datepicker').val('');
			$('.subject').val('');
			$('.subject').html('');
			$('.subject').select2('destroy').select2();
			$('#class').val('');
		});
	})

	$('#class').change(function() {
		var class_id = $(this).val();
		$('.subject').val('');
		$('.subject').html('');
		$('.subject').select2('destroy').select2();

		$.post('fetch_subjects.php', {class_id: class_id}, function(result) {
			var response = JSON.parse(result);
			var length = response.length;
			// console.log(response);
			

			for(var i = 0; i < length; i++)
			{
				var element = $('.clone').clone(true).removeClass('clone');

				element.attr('value', response[i].id);
				console.log(element);
				element.text(response[i].name);
				element.appendTo('.subject');
			}
		});
	})
})
function format_date(date) {
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
	return date;
}