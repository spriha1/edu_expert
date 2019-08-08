$(document).ready(function() {

	$.get('display_class.php', function(result) {
		var response = JSON.parse(result);
		var length = response.length;
		for (var i = 0; i < length; i++) {
			let element = $(".clone").clone(true).css('display', 'block').removeClass('clone');
			element.find('.text').text(response[i].class);
			element.attr('class_id', response[i].class);
			element.appendTo('.append_class');
		}
	});
		
	$(".add_item").click(function(event) {
		event.preventDefault();
		$(".add_class").css("display", "block");
	});

	$('.subject').on('select2:select', function (e) {
	    var data = e.params.data;
	    var id = data.id; //value of options
	    var text = data.text;
	    $.post('fetch_teachers.php', {subject_id: id}, function(result) {
	    	var response = JSON.parse(result);
	    	let element = $(".editable").clone(true).css('display', 'block').removeClass('editable');
			element.find('label').text(text);
			element.find('label').attr('for', id);
			element.find('select').attr('name', id);

	    	for(var i = 0; i < response.length; i++)
	    	{
	    		let element2 = $(".editable option").clone(true);
	    		// element.closest('select').removeClass('teacher');
	    		console.log(element)
				element2.attr('value', response[i].id);
				element2.html(response[i].firstname);
				element2.appendTo(element.find('select'))
	    	}
			element.appendTo('.append_teacher');

	    });
	});

	$('.subject').on('select2:unselect', function(e) {
		var data = e.params.data;
	    var id = data.id;
		$('.append_teacher label[for='+id+']').remove();
		$('.append_teacher select[name='+id+']').remove();

	})

	$("#add").click(function(event) {
		event.preventDefault();
		$(".add_class").css("display", "none");
		$.post('add_class.php', $('#add_class').serialize(), function(result) {
			var response = JSON.parse(result);
			console.log(response[0].class);
			let element = $(".clone").clone(true).css('display', 'block').removeClass('clone');
			element.find('.text').text(response[0].class);
			element.attr('class_id', response[0].class);
			element.appendTo('.append_class');
		});
		// $('.subject').text("");
		// $('#class').val("");
	});

	$(".remove").click(function(event) {
		//event.preventDefault();
		var class_id = $(this).closest('li').attr('class_id');
		$.post('remove_class.php', {class_id: class_id}, function() {
			$("ul li[class_id=" + class_id + "]").remove();
		});
	});

	$('.edit').click(function(event) {
		var class_id = $(this).closest('li').attr('class_id');
		$.post('fetch_class_details.php', {class: class_id}, function(result) {
			var response = JSON.parse(result);
			var length = response.length;
			console.log(response[0].class)
			$('#view_subjects').html("");
			for (var i = 0; i < length; i++) 
			{
				console.log(response[i].name);
				var element = $('.subjects_body').clone(true).css('display', 'table-row').removeClass('subjects_body');
				element.find('.subject_name').text(response[i].name);
				element.find('.teacher').text(response[i].firstname);
				element.attr('subject_id', response[i].subjectid);
				element.attr('class_id', response[i].class);

				element.appendTo('#view_subjects');
			}
		});
	});

	$(".remove_subject").click(function(event) {
		//event.preventDefault();
		var class_id = $(this).closest('tr').attr('class_id');
		var subject_id = $(this).closest('tr').attr('subject_id');

		$.post('remove_class_subject.php', {class_id: class_id, subject_id: subject_id}, function() {
			$("table tr[subject_id=" + subject_id + "]").remove();
		});
	});
})

	

	




// function load_display_data() {
// 	$.get('display_subjects.php', function(result) {
// 		var response = JSON.parse(result);
// 		var length = response.length;
// 		for (var i = 0; i < length; i++) {
// 			let element = $(".editable").clone(true).css('display', 'block').removeClass('editable');
// 			element.attr('subject_id', response[i].id);
// 			element.appendTo('.todo');
// 			subject_id = response[i].id;
// 			$("ul li[subject_id=" + subject_id + "] .text").html(response[i].name);
// 		}
// 	});
// }
