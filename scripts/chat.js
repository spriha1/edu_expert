function make_chat_dialog_box(to_user_name, to_first_name) {
	// var modal_content = '<div id="user_dialog_'+to_user_name+'" class="user_dialog" title="Chat with '+to_first_name+'">';
	// modal_content += '<div style="height:400px; border:1px solid #ccc; overflow-y: scroll; margin-bottom:24px; padding:16px;" class="chat_history" data-tousername="'+to_user_name+'" id="chat_history_'+to_user_name+'">';
	// modal_content += '</div>';
	// modal_content += '<div class="form-group">';
	// modal_content += '<textarea name="chat_message_'+to_user_name+'" id="chat_message_'+to_user_name+'" class="form-control"></textarea>';
	// modal_content += '</div><div class="form-group" align="right">';
	// modal_content += '<button type="button" name="send_chat" id="'+to_user_name+'" class="btn btn-info send_chat">Send</button></div></div>';
	// $('#user_modal_details').html(modal_content);

}

$(document).ready(function() {
	$(".start_chat").click(function() {
		var to_user_name = $(this).attr('data-tousername');
		var to_first_name = $(this).attr('data-tofirstname');
		console.log(to_user_name);
		console.log(to_first_name);
		make_chat_dialog_box(to_user_name, to_first_name);
		$("#user_dialog_"+to_user_name).dialog({
			autoOpen:false,
			width:400
		});
		$("#user_dialog_"+to_user_name).dialog('open');
	});
})
