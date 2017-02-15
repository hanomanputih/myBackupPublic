<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/tagit-simple-blue.css">
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorbox.css" />
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-ui.1.8.7.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/tagit.js"></script>
		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
				$('#nama_lengkap').tagit("add", {label: data.nama_lengkap, value: data.jamaah});
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}

			$(document).ready(function() {
				$(".inline").colorbox({inline:true,width:"100%",maxHeight:"100%"});
				$('#nama_lengkap').tagit({maxTags:1, select:true, sortable:true, allowNewTags:false, triggerKeys:['enter']});
				getSelectOptions('jenis_pengurus');
				getSelectOptions('tingkat_organisasi');
				$(".tagit-input").autocomplete({
					source: function( request, response ) {
						$.ajax({
							url: "jamaah/getAutocomplete.html",
							dataType: "json",
							data: {
								q : request.term
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
			
				// Overriding common method
				clear_val = function (){
					$("#nama_lengkap").tagit("reset");
					$('form input[type="text"],input[type="file"],input[type="password"],form select,form textarea').val('');
					$('#id').val('');
					$('#act').val('add');
					$.uniform.update();
				};
			});
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List Pengurus</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
				<h2>Pengurus</h2>  
				<form id="myForm" action="pengurus">
				<fieldset>
					<input type="hidden" name="page" id="page" value="1"/>
					<input type="hidden" name="id" id="id"/>
					<input type="hidden" name="act" id="act"/>
					<dl>
						<dt><label for="nama_lengkap">Nama Pengurus:</label></dt>
						<dd><ol id="nama_lengkap" data-name="jamaah"></ol></dd>
					</dl>
					<dl>
						<dt><label for="jenis_pengurus">Dapuan:</label></dt>
						<dd>
							<select name="jenis_pengurus" id="jenis_pengurus"></select>
						</dd>
					</dl>
					<dl>
						<dt><label for="tingkat_organisasi">Tingkat Organisasi:</label></dt>
						<dd>
							<select name="tingkat_organisasi" id="tingkat_organisasi"></select>
						</dd>
					</dl>
					<dl>
						<dt><label for="desc_pengurus">Keterangan:</label></dt>
						<dd><textarea name="desc_pengurus" id="desc_pengurus" cols="37"></textarea></dd>
					</dl>
					<dl>
						<dt></dt>
						<dd>
							<input id="submit" type="submit" value="save" />
							<input type="reset" value="clear"/>
							<input type="button" id="cancel" value="back" />
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
	<script  type="text/javascript">
		 var formval = new Validator("myForm");
		 formval.EnableMsgsTogether();
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>