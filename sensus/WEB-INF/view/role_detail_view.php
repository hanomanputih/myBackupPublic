<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/tagit-simple-blue.css">
  		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-ui.1.8.7.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/tagit.js"></script>
		<script type="text/javascript">
			function callBackEditSucces(data){
				for(var idx in data.organisasi){
					$('#list_organisasi').tagit("add", {label: data.organisasi[idx].nama, value: data.organisasi[idx].id});
				}
				$.uniform.update();
				msg_buzy_done();
			}
	
			$(document).ready(function() {
				$('#list_organisasi').tagit({select:true, sortable:true, allowNewTags:false, triggerKeys:['enter']});
				$(".tagit-input").autocomplete({
					source: function( request, response ) {
						$.ajax({
							url: "getAutocomplete.html",
							dataType: "json",
							data: {
								q : request.term,
								role : <?php echo $_GET['role']?>
							},
							success: function( data ) {
								response( $.map( data.result, function( item ) {
									return {
										label: item.label,
										value: item.value
									};
								}));
							}
						});
					},
					minLength: 2,
					select: function( event, ui ) {
						($(this).parent()).parent().tagit("hijack_add", {label: ui.item.value.split("(")[0], value: ui.item.label});
					},
					open: function() {
						$( this ).removeClass( "ui-corner-all" ).addClass( "ui-corner-top" );
					},
					close: function() {
						$( this ).removeClass( "ui-corner-top" ).addClass( "ui-corner-all" );
					}
				});

				// Overriding common.js method
				$('#myForm').submit(function() {
					msg_buzy('Loading...','Please wait a minute');
					$.ajax({
						type : 'POST',
						url : 'add.html',
						enctype: 'multipart/form-data',
						dataType : 'json',
						data : $('#myForm').serialize(),
						success : function(data){
					    	$('#messageBox').html(data.messageBox).show(100);
							msg_buzy_done();
						},
						error : function(XMLHttpRequest, textStatus, errorThrown) {
							msg_buzy_done();
							msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
						}
					});
					return false;
				});

				edit_form = function (id) {
					msg_buzy('Loading...','Please wait a minute');
					$.ajax({
						type : 'POST',
						url : 'getById.html',
						dataType : 'json',
						data : {
							id : id
						},
						success : function(data){
							data.id = id;
							callBackEditSucces(data);
						},
						error : function(XMLHttpRequest, textStatus, errorThrown) {
							msg_buzy_done();
							msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
						}
					});
					return false;
				};
				
				clear_val = function (){
					$("#list_organisasi").tagit("reset");
					$.uniform.update();
				};
			});
		</script>
	</head>
	<body onload="edit_form(<?php echo $_GET['role']?>)">
	<div id="slider">
		<ul>				
			<li>
				<h2>Detail Organisasi Role's <?php echo $_GET['nama_role']?></h2>  
				<form id="myForm" action="role_detail">
				<fieldset>
					<input type="hidden" name="role[]" id="role" value="<?php echo $_GET['role']?>"/>
					<input type="hidden" name="act" id="act" value="add"/>
					<dl>
						<dt><label for="list_organisasi">Organisasi:</label></dt>
						<dd><ol id="list_organisasi" data-name="organisasi[]"></ol></dd>
					</dl>
					<dl>
						<dt></dt>
						<dd>
							<input id="submit" type="submit" value="save" />
							<input type="reset" value="reset" onclick="javascript:clear_val()"/>
							<input type="button" value="back" onclick="javascript:document.location.href='<?php echo getScriptUrl();?>role';" />
						</dd>
					</dl>
				</fieldset>
				</form>
				<div id="messageBox" style="display: none;"></div>
			</li>
		</ul>
	</div> <!-- END OF SLIDER -->
	<div style='display:none'>
		<a class='inline' href="#inline_content"></a>
		<div id='inline_content' style='padding:10px; background:#fff;'></div>
	</div>
	</body>
</html>