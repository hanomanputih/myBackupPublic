<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery.ui.timepicker.css" type="text/css" media="screen" />
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-ui.1.8.7.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.ui.timepicker.js"></script>
		
		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}

			$(document).ready(function(){
				$("#tanggal").datepicker({
					dateFormat: "yy-mm-dd"
				});

				$('#jam').timepicker();  
			});
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>Todo List</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>Todo</h2>  
			<form id="myForm" action="todo">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="id" id="id"/>
				<input type="hidden" name="act" id="act"/>
				<dl>
					<dt><label for="tanggal">Tanggal:</label></dt>
					<dd><input name="tanggal" id="tanggal" readonly="readonly" type="text" size="15"/>&nbsp;Jam: <input name="jam" id="jam" readonly="readonly" type="text" size="10"/></dd>
				</dl>
				<dl>
					<dt><label for="todo">Todo:</label></dt>
					<dd><textarea name="todo" id="todo" maxlength="160" cols="37"></textarea></dd>
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
		 formval.addValidation('todo','req','Todo tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>