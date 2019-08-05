$(document).ready(function() {
	$('#task').submit(function(event) {
		event.preventDefault();
		var teacher_id = $('#teacher').val();
		var subject_id = $('#subject').val();
		var class_id= $('#class').val();
		$.post('add_timetable.php', {teacher_id: teacher_id, subject_id: subject_id, class_id: class_id}, function(result) {
			$('#alert').text(result).css('display', 'block');
		});
	})
})