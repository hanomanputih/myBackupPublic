$(document).ready(function(){
	$("#slider").easySlider();
	var message_box = new MessageBox();
	msg_buzy = function(title, message) { 
		message_box.show_busy( 
			title,message
			); 
		return false; 
	};
	
	msg_buzy_done = function() { 
		message_box.hide();
		return false; 
	};
	
	msg_confirm = function(title, message, todo){ 
		message_box.show_confirm( 
			title, message, todo
			);
		return false; 
	};
	
	msg_error = function(title, message){ 
		message_box.show_error( 
			title, message                
			);
		return false; 
	};
	
	msg_warning = function(title, message){ 
		message_box.show_warning( 
			title, message                
			);
		return false; 
	};
	
	msg_information = function( title, message) { 
		message_box.show_information( 
			title, message                
			);
		return false; 
	};
	
	$("input, textarea, button, select").uniform();
	
	$('#add_new').click(function() {
		add_new_item();
		return false;
	});
	
	$('#cancel').click(function() {
		$("a","#prevBtn").click();	
		setTimeout("clear_msgBox()",500);
		return false;
	});
	
	$("#myForm").bind("reset", function() {
		clear_val();
		return false;
	});
	
	$('#delete').click(function() {
		$('#act').val('del');
		var list_id = new Array;
		$("#rounded-corner input:checkbox:checked").each(function() {
			list_id.push($(this).val());
		});
		msg_confirm('Konfirmasi','Apakah anda yakin akan menghapus data yang tercentang?',function(){
			msg_buzy('Loading...','Please wait a minute');
			$.ajax({
				type : 'POST',
				url : $('#myForm').attr('action') + '/' + $('#act').val() + '.html',
				dataType : 'json',
				data : {
					id : list_id
				},
				success : function(data){
					load_table();
					$('#messageBoxDelete').html(data.messageBox).show(100);
					msg_buzy_done();
				},
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					msg_buzy_done();
					msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
				}
			});
		});
		return false;
	});
});

save_item = function() {
	msg_buzy('Loading...','Please wait a minute');
	// check is IE Browser
	if ($.browser.msie) {
		$.ajax({
			type : 'POST',
			url : $('#myForm').attr('action') + '/' + $('#act').val() + '.html',
			enctype: 'multipart/form-data',
			dataType : 'json',
			data : $('#myForm').serialize(),
			success : function(data){
				if (!data.error){
					clear_val();
				}
				$('#messageBox').html(data.messageBox).show(100);
				load_table();
				msg_buzy_done();
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				msg_buzy_done();
				msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
			}
		});
	} else {
		$.ajax({
			type : 'POST',
			url : $('#myForm').attr('action') + '/' + $('#act').val() + '.html',
			enctype: 'multipart/form-data',
			dataType : 'json',
			data : new FormData($('#myForm')[0]),
			success : function(data){
				if (!data.error){
					clear_val();
				}
				$('#messageBox').html(data.messageBox).show(100);
				load_table();
				msg_buzy_done();
			},
			error : function(XMLHttpRequest, textStatus, errorThrown) {
				msg_buzy_done();
				msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
			},
			//Options to tell JQuery not to process data or worry about content-type
			cache: false,
			contentType: false,
			processData: false
		});
	}
};

function pagination(page){
	$('#page').val(page);
	clear_msgBox();
	load_table();
};

function add_new_item(){
	$("a","#nextBtn").click();
	clear_val();
};

clear_val = function (){
	$('form input[type="text"],input[type="file"],input[type="password"],form select,form textarea').val('');
	$('.filename').html('Tidak ada Foto terpilih');
	$('#id').val('');
	$('#act').val('add');
	$.uniform.update();
};

function clear_msgBox(){
	$('#messageBox').hide();
	$('#messageBoxDelete').hide();
	window.top.resizeIframe();
};

load_table = function (keyword, page){
	if (keyword == null)
		keyword = window.top.getSearchKeyword();
	msg_buzy('Loading...','Please wait a minute');
	$.ajax({
		type : 'GET',
		url : $('#myForm').attr('action') + "/getList.html",
		dataType : 'json',
		data : {
			keyword : keyword,
			page : (page == null) ? $('#page').val() : page
		},
		success : function(data){
			$('#table').html(data.table).show(10);
			$('.pagination').html(data.pagination).show(10);
			setTimeout("callBackLoadTableDone()",20);
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			msg_buzy_done();
			msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
		}
	});
	return false;
};

function callBackLoadTableDone() {
	window.top.resizeIframe();
	msg_buzy_done();
};

edit_form = function edit_form(id) {
	clear_msgBox();
	msg_buzy('Loading...','Please wait a minute');
	$.ajax({
		type : 'POST',
		url : $('#myForm').attr('action') + '/getById.html',
		dataType : 'json',
		data : {
			id : id
		},
		success : function(data){
			if (data) {
				data.id = id;
				callBackEditSucces(data);
			} else {
				msg_buzy_done();
			}
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			msg_buzy_done();
			msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
		}
	});
	return false;
};

function detailForm(id,modelName){
	clear_msgBox();
	msg_buzy('Loading...','Please wait a minute');
	$.ajax({
		type : 'POST',
		url : modelName + "/detail.html",
		dataType : 'html',
		data : {
			id : id
		},
		success : function(data){
			$('#inline_content').html(data);
			msg_buzy_done();
			$("[href='#inline_content']").click();
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			msg_buzy_done();
			msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
		}
	});
	return false;
};

function getSelectOptions(element_id){
	msg_buzy('Loading...','Please wait a minute');
	$.ajax({
		type : 'GET',
		url : element_id + "/getSelect.html",
		dataType : 'html',
		success : function(data){
			$('#' + element_id).html(data);
			msg_buzy_done();
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			msg_buzy_done();
			msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
		}
	});
	return false;
};

function getSelectOptionsWithController(element_id,controller){
	msg_buzy('Loading...','Please wait a minute');
	$.ajax({
		type : 'GET',
		url : controller + "/getSelect.html",
		dataType : 'html',
		success : function(data){
			$('#' + element_id).html(data);
			msg_buzy_done();
			$.uniform.update();
		},
		error : function(XMLHttpRequest, textStatus, errorThrown) {
			msg_buzy_done();
			msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
		}
	});
	return false;
};

function initFormEdit(data) {
	var oForm = document.getElementById('myForm');
	for (i = 0; i < oForm.length; i++) {
		var obj = oForm.elements[i];
		if (obj.type == 'select-one' || obj.type == 'textarea' || obj.type == 'text' || obj.type == 'hidden') {
			if (typeof(data[obj.name]) != "undefined")
				$('#' + obj.name).val(data[obj.name]);
		}
	}
	$('#id').val(data.id);
	$('#act').val("edt");
};

function show_foto(href) {
	$('#inline_content').html("<img src='" + href + "'/>");
	$("[href='#inline_content']").click();
};