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
		//var date = today.getFullYear()+'-'+(today.getMonth()+1)+'-'+today.getDate();
		var user_id = $('#user_id').val();
		console.log(user_id);
		$.post('display_goals.php', {date: date, user_id: user_id}, function(result) {
			var response = JSON.parse(result);
			var length = response.length;
			console.log(length);
			for (var i = 0; i < length; i++) {
				let element = $(".editable").clone(true).css('display', 'block').removeClass('editable');
				element.find('.text').html(response[i].goal);
				element.find('.remove').attr('goal_id', response[i].id);
				if(response[i].total_time > 0){
					var time = new Date(null);
					time.setSeconds(response[i].total_time);
					var total_time = time.toISOString().substr(11, 8);
					$('.time').css('visibility', 'visible');
					$('.total_time').text(total_time);
				}
				element.appendTo('.todo');
			}
		});

	// $(".date").change(function() {
	// 	var date = $(this).val();
	// 	console.log(date);
	// 	var user_id = $('#user_id').val();
	// 	$.post('display_goals.php', {date: date, user_id: user_id}, function(result) {
	// 		var response = JSON.parse(result);
	// 		var length = response.length;
	// 		console.log(length);
	// 			$(".editable").remove();

	// 		for (var i = 0; i < length; i++) {
	// 			let element = $(".goal_item").clone(true).css('display', 'block').removeClass('goal_item');
	// 			element.find('.text').html(response[i].goal);
	// 			element.find('.remove').attr('goal_id', response[i].id);
	// 			if(response[i].total_time > 0){
	// 				var date = new Date(null);
	// 				date.setSeconds(response[i].total_time);
	// 				var result = date.toISOString().substr(11, 8);
	// 				$('.time').css('visibility', 'visible');
	// 				$('.total_time').text(result);
	// 			}
	// 			element.appendTo('.todo');
	// 		}
	// 	});

	// });

	$(".add_item").click(function(event) {
		event.preventDefault();
		$("#goal").css("display", "block");
		$(".add").css("display", "block");
		$(".add_item").css("display", "none");
	});

	$(".add").click(function(event) {
		event.preventDefault();
		$("#goal").css("display", "none");
		$(".add").css("display", "none");
		$(".add_item").css("display", "block");
		var goal = $("textarea").val();
		var user_id = $(".add").attr("user_id");
		$.post('add_goals.php', {goal: goal, user_id: user_id}, function(result) {
			var response = JSON.parse(result);
			let element = $(".editable").clone(true).css('display', 'block').removeClass('editable');
			element.find('.text').html(response[0].goal);
			element.find('.remove').attr('goal_id', response[0].id);;
			element.attr('goal_id', response[0].id);
			element.appendTo('.todo');
		});
	});

	$(".check_goal").change(function(event) {
		if($(this).val()) {
		//event.preventDefault();
			var goal_id = $(this).closest('[goal_id]').attr("goal_id");
			$.post('update_goals.php', {goal_id: goal_id}, function(result) {
				var response = JSON.parse(result);
				console.log(response);
				var total_time = response[0].total_time;
				var time = new Date(null);
				time.setSeconds(response[0].total_time);
				var total_time = time.toISOString().substr(11, 8);
				$("ul li[goal_id=" + goal_id + "]").find('.time').css('visibility', 'visible');
				$("ul li[goal_id=" + goal_id + "]").find('.total_time').text(total_time);

			});
		}
	});

	$(".remove").click(function(event) {
		//event.preventDefault();
		var goal_id = $(this).attr('goal_id');
		$.post('remove_goals.php', {goal_id: goal_id}, function() {
			$("ul li[goal_id=" + goal_id + "]").remove();
		});
	});
})