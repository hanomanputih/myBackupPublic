<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
				$("#shortcut").attr("checked", $.parseJSON(data.shortcut));
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}
	
			$(document).ready(function() {
				getSelectOptions('menu');
			});
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List Menu</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>Menu</h2>  
			<form id="myForm" action="menu">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="id" id="id"/>
				<input type="hidden" name="act" id="act"/>
				<dl>
					<dt><label for="title_menu">Title Menu:</label></dt>
					<dd><input name="title_menu" id="title_menu" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="controller">Controller:</label></dt>
					<dd><input name="controller" id="controller" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="end_path">End path:</label></dt>
					<dd><input name="end_path" id="end_path" type="text" size="40" value="#"/></dd>
				</dl>
				<dl>
					<dt><label for="target">Target:</label></dt>
					<dd>
						<select id="target" name="target">
							<option value="Self">Self</option>
							<option value="Blank">Blank</option>
						</select>
					</dd>
				</dl>
				<dl>
					<dt><label for="urut">Nomor Urut:</label></dt>
					<dd><input name="urut" id="urut" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="menu">Menu:</label></dt>
					<dd><select name="menu" id="menu"></select></dd>
				</dl>
				<dl>
					<dt><label for="shortcut">Shortcut:</label></dt>
					<dd><input type="checkbox" name="shortcut" id="shortcut" value="true"/></dd>
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
		 formval.addValidation('title_menu','req','Title menu tidak boleh kosong!');
		 formval.addValidation('urut','req','No. Urut tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>