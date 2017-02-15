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
				getSelectOptions('role');
			});
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List User</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>User</h2>  
			<form id="myForm" action="user">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="act" id="act"/>
				<input type="hidden" name="id" id="id"/>
				<dl>
					<dt><label for="username">Username:</label></dt>
					<dd><input name="username" id="username" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="nama_lengkap">Nama Lengkap:</label></dt>
					<dd><input name="nama_lengkap" id="nama_lengkap" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="password">Password:</label></dt>
					<dd><input name="password" id="password" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="role">Role:</label></dt>
					<dd><select id="role" name="role"></select></dd>
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
	<!-- This contains the hidden content for inline calls -->
	<div style='display:none'>
		<a class='inline' href="#inline_content"></a>
		<div id='inline_content' style='padding:10px; background:#fff;'></div>
	</div>
	<script  type="text/javascript">
		 var formval = new Validator("myForm");
		 formval.EnableMsgsTogether();
		 formval.addValidation('username','req','Username tidak boleh kosong!');
		 formval.addValidation('nama_lengkap','req','Nama user tidak valid!');
		 formval.setAddnlValidationFunction(save_item);
	</script>	
	</body>
</html>