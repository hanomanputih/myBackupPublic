<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorbox.css" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/tagit-simple-blue.css">
  		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-ui.1.8.7.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/tagit.js"></script>
		<script type="text/javascript">
			function callBackEditSucces(data){
				$("#nama_suami").tagit("reset");
				$("#nama_istri").tagit("reset");
				$("#list_anak").tagit("reset");
				initFormEdit(data);
				if (data.suami != null)
					$('#nama_suami').tagit("add", {label: data.nama_suami, value: data.suami});
				if (data.istri != null)
					$('#nama_istri').tagit("add", {label: data.nama_istri, value: data.istri});
				for(var id in data.anak){
					$('#list_anak').tagit("add", {label: data.anak[id].nama, value: data.anak[id].anak});
				}
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}
	
			$(document).ready(function() {
				getSelectOptions('kelompok');
				$('#list_anak').tagit({select:true, sortable:true, allowNewTags:false, triggerKeys:['enter']});
				$('#nama_suami').tagit({maxTags:1, select:true, allowNewTags:false, triggerKeys:['enter']});
				$('#nama_istri').tagit({maxTags:1, select:true, allowNewTags:false, triggerKeys:['enter']});
				$(".inline").colorbox({inline:true,width:"100%",maxHeight:"100%"});
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
					$("#nama_suami").tagit("reset");
					$("#nama_istri").tagit("reset");
					$("#list_anak").tagit("reset");
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
				<h2>List Keluarga</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
				<h2>Keluarga</h2>  
				<form id="myForm" action="keluarga">
				<fieldset>
					<input type="hidden" name="page" id="page" value="1"/>
					<input type="hidden" name="id" id="id"/>
					<input type="hidden" name="act" id="act"/>
					<dl>
						<dt><label for="kelompok">Kelompok:</label></dt>
						<dd>
							<select name="kelompok" id="kelompok"></select>
						</dd>
					</dl>
					<dl>
						<dt><label for="kepala_keluarga">Kepala Keluarga:</label></dt>
						<dd><input name="kepala_keluarga" id="kepala_keluarga" type="text" size="40"/></dd>
					</dl>
					<dl>
						<dt><label for="nama_suami">Suami:</label></dt>
						<dd><ol id="nama_suami" data-name="suami"></ol></dd>
					</dl>
					<dl>
						<dt><label for="nama_istri">Istri:</label></dt>
						<dd><ol id="nama_istri" data-name="istri"></ol></dd>
					</dl>
					<dl>
						<dt><label for="list_anak">Anak:</label></dt>
						<dd><ol id="list_anak" data-name="anak[]"></ol></dd>
					</dl>
					<dl>
						<dt></dt>
						<dd>
							<input id="submit" type="submit" value="save" />
							<input type="reset" value="reset" onclick="javascript:clear_val()"/>
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
		 formval.addValidation('kelompok','dontselect=00','Kelompok belum ada yang dipilih!');
		 formval.addValidation('kepala_keluarga','req','Kepala keluarga tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>