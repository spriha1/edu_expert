$(document).ready(function() {

	
	
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

			element.appendTo('.todo');
		});
	});

	$(".check_goal").click(function(event) {
		//event.preventDefault();
		var goal_id = $(this).val();
		$.post('update_goals.php', {goal_id: goal_id});
	});

	$(".remove").click(function(event) {
		//event.preventDefault();
		var goal_id = $(this).attr('goal_id');
		$.post('remove_goals.php', {goal_id: goal_id});
	});
})