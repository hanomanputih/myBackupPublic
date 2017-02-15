<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorbox.css" />
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorbox.js"></script>
		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}

			$(document).ready(function() {
				getSelectOptions('masjid');
				getSelectOptions('desa');
				$(".inline").colorbox({inline:true,width:"100%",maxHeight:"100%"});
			});
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List Kelompok</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>Kelompok</h2>  
			<form id="myForm" action="kelompok">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="id" id="id"/>
				<input type="hidden" name="act" id="act"/>
				<dl>
					<dt><label for="nama_kelompok">Nama Kelompok:</label></dt>
					<dd><input name="nama_kelompok" id="nama_kelompok" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="desa">Nama Desa:</label></dt>
					<dd>
						<select name="desa" id="desa"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="masjid">Masjid:</label></dt>
					<dd>
						<select name="masjid" id="masjid"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="desc_kelompok">Keterangan:</label></dt>
					<dd><textarea name="desc_kelompok" id="desc_kelompok" cols="37"></textarea></dd>
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
		 formval.addValidation('nama_kelompok','req','Nama kelompok tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>