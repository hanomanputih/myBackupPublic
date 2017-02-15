<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List Status Jamaah</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>Status Jamaah</h2>  
			<form id="myForm" action="status_jamaah">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="id" id="id"/>
				<input type="hidden" name="act" id="act"/>
				<dl>
					<dt><label for="nama_status_jamaah">Nama Status Jamaah:</label></dt>
					<dd><input name="nama_status_jamaah" id="nama_status_jamaah" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="desc_status_jamaah">Keterangan:</label></dt>
					<dd><textarea name="desc_status_jamaah" id="desc_status_jamaah" cols="37"></textarea></dd>
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
	<script  type="text/javascript">
		 var formval = new Validator("myForm");
		 formval.EnableMsgsTogether();
		 formval.addValidation('nama_status_jamaah','req','Nama status jamaah tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>