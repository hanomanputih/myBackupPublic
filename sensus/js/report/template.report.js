$(document).ready(function() {
	var message_box = new MessageBox();
	msg_buzy = function(title, message) { 
		message_box.show_busy( 
			title,message
			); 
		return false; 
	};
	msg_warning = function(title, message){ 
		message_box.show_warning( 
			title, message                
			);
		return false; 
	};
	msg_error = function(title, message){ 
		message_box.show_error( 
			title, message                
			);
		return false; 
	};
	msg_buzy_done = function() { 
		message_box.hide();
		return false; 
	};

	$('#search').click(function (e) {
		$('.search_submit').click();
	});
				
	$('#keyword').keyup(function (e) {
		if (e.keyCode == 13) {
			$('.search_submit').click();
		    return false;
		  }
	});
	$("#keyword").focus(function() {
		if (($("#keyword")).attr('class') == "search_input_water") {
			$("#keyword").val("");
			$("#keyword").removeClass("search_input_water");
			$("#keyword").addClass("search_input");
		}
	});
	$("#keyword").blur(function() {
		if ($.trim($("#keyword").val()) == "") {
			$("#keyword").val(this.title);
			$("#keyword").removeClass("search_input");
			$("#keyword").addClass("search_input_water");
		}
	});
});	