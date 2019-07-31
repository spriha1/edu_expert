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
			if(result == 1)
			{
				var html = '<li><input type="checkbox" value=""><span class="text">'+goal+'</span>';
				$('.todo-list').append(html);
			}
		});
	});
	$(".check_goal").click(function(event) {
		event.preventDefault();
		var goal_id = $(this).val();
		$.post('update_goals.php', {goal_id: goal_id});
	});
})