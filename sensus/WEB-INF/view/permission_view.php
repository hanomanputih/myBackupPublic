<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/style.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/message-box.css" type="text/css" media="screen" />
		
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/message-box.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/easy.dhtml.treeview.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/sessionJs.js"></script>
		
		<script type="text/javascript">
			$(document).ready(function(){
				var message_box = new MessageBox();
				msg_buzy = function(title, message) { 
					message_box.show_busy( 
						title,message
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
				
				load_permission();
			});

			function callBackLoadPermissionDone() {
				window.top.resizeIframe();
				msg_buzy_done();
			}
			
			function load_permission() {
				msg_buzy('Loading...','Please wait a minute');
				$.ajax({
					type : 'GET',
					url : "<?php echo getScriptUrl();?>menu/menu_permission.html",
					dataType : 'html',
					data : {
						role : <?php echo $_GET[role]?>
					},
					success : function(data){
						$('#permission').html(data).show(10);
						setTimeout("callBackLoadPermissionDone()",20);
					},
					error : function(XMLHttpRequest, textStatus, errorThrown) {
						msg_buzy_done();
						msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
					}
				});
			}

			function toggle(chkbox, id, menu_function) { 
			    if (chkbox.checked){
			    	update_permission(chkbox,'add',id, menu_function);
			    } else {
			    	update_permission(chkbox,'del',id, menu_function);
			    }
			}

			function update_permission(chkbox, func, menu, menu_function) {
				msg_buzy('Loading...','Please wait a minute');
				$.ajax({
					type : 'POST',
					url : "<?php echo getScriptUrl();?>permission/" + func + '.html',
					dataType : 'json',
					data : {
						menu : menu,
						role : $('#role').val(),
						menu_function : menu_function
					},
					success : function(data){
						if(data.error) {
							msg_buzy_done();
							msg_error('ADA KESALAHAN SISTEM!' , data.messageBox);
							chkbox.checked = !chkbox.checked;
						} else{
							setTimeout("callBackLoadPermissionDone()",20);
						}
					},error : function(XMLHttpRequest, textStatus, errorThrown) {
						msg_buzy_done();
						msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
					}
				});
			}
		</script>	
	</head>
	<body>
		<h2>Permission Role's <?php echo $_GET[nama_role]?></h2>
		<input type="hidden" id="role" name="role" value="<?php echo $_GET[role]?>"/>
		<div id="permission"></div>
		<a id="apply" href="#" onclick="javascript:document.location.href='<?php echo getScriptUrl();?>role';" class="bt_blue"><span class="bt_blue_lft"></span><strong>Apply</strong><span class="bt_blue_r"></span></a>
		<div class="clear"></div>
	</body>
</html>