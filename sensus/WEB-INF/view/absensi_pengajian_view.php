<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/tagit-simple-blue.css">
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery.ui.timepicker.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorbox.css" />
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-ui.1.8.7.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/tagit.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.ui.timepicker.js"></script>
		<script type="text/javascript">
			load_table = function (keyword, page){
				if (keyword == null)
					keyword = window.top.getSearchKeyword();
				msg_buzy('Loading...','Please wait a minute');
				$.ajax({
					type : 'GET',
					url : $('#myForm').attr('action') + "/getList.html",
					dataType : 'json',
					data : {
						keyword : keyword,
						page : (page == null) ? $('#page').val() : page,
						pengajian : <?php echo $_GET['pengajian'];?>,
						jk : $('input:radio[name=jk]').filter('[checked="checked"]').val()
					},
					success : function(data){
						$('#table').html(data.table).show(10);
						$('.pagination').html(data.pagination).show(10);
						setTimeout("callBackLoadTableDone()",20);
					},
					error : function(XMLHttpRequest, textStatus, errorThrown) {
						msg_buzy_done();
						msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
					}
				});
				return false;
			};
			
			function update_absen(field, id, newVal) {
				msg_buzy('Loading...','Please wait a minute');
				$.ajax({
					type : 'POST',
					url : $('#myForm').attr('action') + '/edt.html',
					dataType : 'json',
					data : {
						field : field,
						id : id,
						newVal : newVal
					},
					success : function(data){
						if(data.error) {
							msg_buzy_done();
							msg_error('ADA KESALAHAN SISTEM!' , data.messageBox);
							chkbox.checked = !chkbox.checked;
						} else{
							setTimeout("msg_buzy_done()",20);
						}
					},error : function(XMLHttpRequest, textStatus, errorThrown) {
						msg_buzy_done();
						msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
					}
				});
			}
		
			$(document).ready(function() {
				$(".inline").colorbox({inline:true,width:"100%",maxHeight:"100%"});
				$('#nama_jamaah').tagit({maxTags:1, select:true, sortable:true, allowNewTags:false, triggerKeys:['enter']});
				$('#jam_absen').timepicker();
	
				$('.tgl').live('click', function() {
					$(this).timepicker({showOn:'focus',onClose: function(time, inst) {
						update_absen('jam_absen', inst.id, time);
				    }}).focus();
				});
				
				$(".tagit-input").autocomplete({
					source: function( request, response ) {
						$.ajax({
							url: "<?php echo getScriptUrl();?>jamaah/getAutocomplete.html",
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

				$("input[name='jk']").change(function(){
					load_table();
				});
				
				// Overriding common method
				clear_val = function (){
					$("#nama_jamaah").tagit("reset");
					$('form input[type="text"],input[type="file"],input[type="password"],form select,form textarea').val('');
					$('#id').val('');
					$('#act').val('add');
					$.uniform.update();
				};
			});
		</script>
	</head>
	<body onload="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>Absensi <?php echo $_GET['detail_acara']?></h2>
				<div class="right_filter">
					<input type="radio" id="rwan" name="jk" value="P"><label for="rwan">Perempuan</label>&nbsp;
					<input type="radio" id="rlak" name="jk" value="L"><label for="rlak">Laki-laki</label>&nbsp;
					<input type="radio" id="rall" name="jk" value="all" checked="checked"><label for="rall">Semua</label>
				</div>
				<div id="table"></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<a href="#" onclick="javascript:document.location.href='<?php echo getScriptUrl();?>pengajian';" class="bt_blue"><span class="bt_blue_lft"></span><strong>Back</strong><span class="bt_blue_r"></span></a>
				<div class="pagination"></div> 
			</li>
			<li>
			<h2>Tambah Absensi</h2>  
			<form id="myForm" action="<?php echo getScriptUrl();?>absensi_pengajian">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="act" id="act"/>
				<input type="hidden" name="pengajian" id="pengajian" value="<?php echo $_GET['pengajian'];?>"/>
				<dl>
					<dt><label for="nama_jamaah">Nama Jamaah:</label></dt>
					<dd><ol id="nama_jamaah" data-name="jamaah"></ol></dd>
				</dl>
				<dl>
					<dt><label for="jam_absen">Jam Kehadiran:</label></dt>
					<dd><input name="jam_absen" id="jam_absen" type="text" size="3"/></dd>
				</dl>
				<dl>
					<dt><label for="kedatangan">Kedatangan:</label></dt>
					<dd><?php echo $this->get_kedatangan_opt();?></dd>
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
		 formval.addValidation('kedatangan','selone','Kedatangan belum ada yang dicentang!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>