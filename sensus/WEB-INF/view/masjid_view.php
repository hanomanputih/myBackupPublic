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
				$('input:checkbox[name=masjid_desa]').attr('checked', Boolean($.parseJSON((data.masjid_desa))));
				$('input:checkbox[name=masjid_daerah]').attr('checked', Boolean($.parseJSON((data.masjid_daerah))));
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}
						
			$(document).ready(function() {
				$(".inline").colorbox({inline:true,width:"100%",maxHeight:"100%"});
			});
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List Masjid</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>Masjid</h2>
			<form id="myForm" action="masjid">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="id" id="id"/>
				<input type="hidden" name="act" id="act"/>
				<dl>
					<dt><label for="nama_masjid">Nama Masjid:</label></dt>
					<dd><input name="nama_masjid" id="nama_masjid" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="masjid_desa">Masjid:</label></dt>
		            <dd>
		            	<label for="masjid_desa" ><input type="checkbox" name="masjid_desa" id="masjid_desa" value="1" />Desa</label>
		            	<label for="masjid_daerah" ><input type="checkbox" name="masjid_daerah" id="masjid_daerah" value="1" />Dearah</label>
		            </dd>
				</dl>
				<dl>
					<dt><label for="alamat">Alamat:</label></dt>
					<dd><textarea name="alamat" id="alamat" cols="37"></textarea></dd>
				</dl>
				<dl>
					<dt><label for="geo">Geo Location:</label></dt>
					<dd><input name="geo" id="geo" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="telepon">Telepon:</label></dt>
					<dd><input name="telepon" id="telepon" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="mobile">Mobile:</label></dt>
					<dd><input name="mobile" id="mobile" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="web">Web:</label></dt>
					<dd><input name="web" id="web" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="email">Email:</label></dt>
					<dd><input name="email" id="email" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="desc_masjid">Keterangan:</label></dt>
					<dd><textarea name="desc_masjid" id="desc_masjid" cols="37"></textarea></dd>
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
	<!-- This contains the hidden content for inline calls -->
	<div style='display:none'>
		<a class='inline' href="#inline_content"></a>
		<div id='inline_content' style='padding:10px; background:#fff;'></div>
	</div>
	<script  type="text/javascript">
		 var formval = new Validator("myForm");
		 formval.EnableMsgsTogether();
		 formval.addValidation('nama_masjid','req','Nama masjid tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>