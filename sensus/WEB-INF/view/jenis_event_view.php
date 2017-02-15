<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorPicker.css" type="text/css" media="screen" />
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorPicker.min.js"></script>

		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
			    $(".colorPickerC").change();
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}
	        $(document).ready(function() {
	            $(".colorPickerC").colorPicker({pickerDefault: "ffffff", showHexField: false});
	        });
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List Jenis Event</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
				<h2>Jenis Event</h2>  
				<form id="myForm" action="jenis_event">
				<fieldset>
					<input type="hidden" name="page" id="page" value="1"/>
					<input type="hidden" name="id" id="id"/>
					<input type="hidden" name="act" id="act"/>
					<dl>
						<dt><label for="nama_jenis_event">Nama Jenis Event:</label></dt>
						<dd><input name="nama_jenis_event" id="nama_jenis_event" type="text" size="40" /></dd>
					</dl>
					<dl>
						<dt><label for="color">Warna Background:</label></dt>
						<dd><input class="colorPickerC" id="color" name="color" type="text" /></dd>
					</dl>
					<dl>
						<dt><label for="bordercolor">Warna Border:</label></dt>
						<dd><input class="colorPickerC" id="bordercolor" name="bordercolor" type="text" /></dd>
					</dl>
					<dl>
						<dt><label for="textcolor">Warna Text:</label></dt>
						<dd><input class="colorPickerC" id="textcolor" name="textcolor" type="text" /></dd>
					</dl>
					<dl>
						<dt><label for="desc_jenis_event">Deskripsi:</label></dt>
						<dd><textarea name="desc_jenis_event" id="desc_jenis_event" cols="37"></textarea></dd>
					</dl>
					<dl>
					<dt></dt>
					<dd>
						<input id="submit" type="submit" value="save" />
						<input id="hapus" type="reset" />
						<input type="button" id="cancel" value="back" />
					</dd>
					</dl>
				</fieldset>
				</form>
				<div id="messageBox" style="display: none;"></div>
			</li>
		</ul>
	</div> <!-- END OF SLIDER -->
	<script  type="text/javascript">
		 var formval = new Validator("myForm");
		 formval.EnableMsgsTogether();
		 formval.addValidation('nama_jenis_event','req','Nama jenis event tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>