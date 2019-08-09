$(document).ready(function() {
	$('#task').submit(function(event) {
		event.preventDefault();
		// var teacher_id = $('#teacher').val();
		// var subject_id = $('#subject').val();
		// var class_id= $('#class').val();
		$.post('add_timetable.php', $("#task").serialize(), function(result) {
			$('#alert').text(result).css('display', 'block');
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