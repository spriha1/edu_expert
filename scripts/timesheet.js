$(document).ready(function() {

	$(function () {
		$('#timesheet').DataTable({
		'paging'      : true,
		'lengthChange': true,
		'searching'   : true,
		'ordering'    : true,
		'info'        : true,
		'autoWidth'   : false
		})
	})
	
	$('.view').click(function() {
		var from_id = $(this).attr('from_id');
		var of_date = $(this).attr('of_date');
		$.post('fetch_timesheet.php', {from_id: from_id, of_date: of_date}, function(result) {
			var response = JSON.parse(result);
			var length = response.length;
			for (var i = 0; i < length; i++) 
			{
				var element = $('.timesheet_body').clone(true).removeClass('timesheet_body');
				element.find('.number').text(i+1);
				element.find('.goal').text(response[0].goal);
				element.find('.from_time').text(response[0].from_time);
				element.find('.to_time').text(response[0].to_time);
				element.find('.total_time').text(response[0].total_time);
				element.appendTo('#view_timesheet');
			}
			
		});
	})
})