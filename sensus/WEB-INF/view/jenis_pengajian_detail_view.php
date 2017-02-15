<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/style.css" type="text/css" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/message-box.css" type="text/css" media="screen" />
		
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-1.7.1.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/message-box.js"></script>
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
				
				load_menu_function_detail();
			});

			function callBackLoadFunctionDone() {
				window.top.resizeIframe();
				msg_buzy_done();
			}
			
			function load_menu_function_detail() {
				msg_buzy('Loading...','Please wait a minute');
				$.ajax({
					type : 'GET',
					url : "<?php echo getScriptUrl();?>jenis-pengajian-detail/getList.html",
					dataType : 'html',
					data : {
						jenis_pengajian : <?php echo $_GET['jenis_pengajian']?>
					},
					success : function(data){
						$('#jenis_pengajian_detail').html(data).show(10);
						setTimeout('callBackLoadFunctionDone()',20);
					},
					error : function(XMLHttpRequest, textStatus, errorThrown) {
						msg_buzy_done();
						msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
					}
				});
			}

			function toggle(chkbox, status_sambung) { 
			    if (chkbox.checked){
			    	update_detail(chkbox,'add',status_sambung);
			    } else {
			    	update_detail(chkbox,'del',status_sambung);
			    }
			}

			function update_detail(chkbox, func, status_sambung) {
				msg_buzy('Loading...','Please wait a minute');
				$.ajax({
					type : 'POST',
					url : "<?php echo getScriptUrl();?>jenis-pengajian-detail/" + func + '.html',
					dataType : 'json',
					data : {
						jenis_pengajian : $('#jenis_pengajian').val(),
						status_sambung : status_sambung
					},
					success : function(data){
						if(data.error) {
							msg_buzy_done();
							msg_error('ADA KESALAHAN SISTEM!' , data.messageBox);
							chkbox.checked = !chkbox.checked;
						} else{
							setTimeout("callBackLoadFunctionDone()",20);
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
		<h2>Peserta Wajib <?php echo $_GET[nama_jenis_pengajian]?></h2>
		<input type="hidden" id="jenis_pengajian" name="jenis_pengajian" value="<?php echo $_GET['jenis_pengajian']?>"/>
		<div id="jenis_pengajian_detail"></div>
		<a id="apply" href="#" onclick="javascript:window.top.jsSession('<?php echo getScriptUrl();?>jenis-pengajian/list.html');" class="bt_blue"><span class="bt_blue_lft"></span><strong>Apply</strong><span class="bt_blue_r"></span></a>
		<div class="clear"></div>
	</body>
</html>