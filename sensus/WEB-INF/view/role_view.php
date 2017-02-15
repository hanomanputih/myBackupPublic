<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
				$('input:checkbox[name=show_deleted_record]').attr('checked', Boolean($.parseJSON((data.show_deleted_record))));
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}
			
			$(document).ready(function() {
				getSelectOptions('tingkat_organisasi');
				getSelectOptions('menu');
			});
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List Role</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>Role</h2>  
			<form id="myForm" action="role">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="id" id="id"/>
				<input type="hidden" name="act" id="act"/>
				<dl>
					<dt><label for="nama_role">Nama role:</label></dt>
					<dd><input name="nama_role" id="nama_role" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="tingkat_organisasi">Tingkat Organisasi:</label></dt>
					<dd>
						<select name="tingkat_organisasi" id="tingkat_organisasi"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="show_deleted_record">Show Deleted Record:</label></dt>
		            <dd>
		            	<input type="checkbox" name="show_deleted_record" id="show_deleted_record" value="1" />
		            </dd>
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
		 formval.addValidation('nama_role','req','Nama role tidak boleh kosong!');
		 formval.addValidation('tingkat_organisasi','dontselect=00','Tingkat Organisasi belum ada yang dipilih!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>