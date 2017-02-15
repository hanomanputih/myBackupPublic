<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8' />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
		<link rel='stylesheet' type='text/css' href='<?php echo getScriptUrl();?>style/fullcalendar.theme.css' />
		<link rel='stylesheet' type='text/css' href='<?php echo getScriptUrl();?>style/fullcalendar.css' />
		<link rel='stylesheet' type='text/css' href='<?php echo getScriptUrl();?>style/fullcalendar.print.css' media='print' />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorbox.css" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery.ui.timepicker.css" type="text/css" media="screen" />
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-ui.1.8.7.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.ui.timepicker.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorbox.js"></script>
		<script type='text/javascript' src='<?php echo getScriptUrl();?>js/fullcalendar.js'></script>
		<script type="text/javascript">
			var calendar;
			
			function callBackEditSucces(data){
				initFormEdit(data);
				$('input:radio[name=tingkat_organisasi]').filter('[value='+data.tingkat_organisasi_visible+']').click();
				$('#organisasi').val(data.organisasi_visible);
				$("#allday_event").attr("checked", Boolean($.parseJSON(data.allday_event))).change();
				var ds = (data.start_event == null) ? new Array('','') : data.start_event.split(' ');
				var de = (data.end_event == null) ? new Array('','') : data.end_event.split(' ');
				$("#st_date").val(ds[0]);
				$("#st_time").val(ds[1]);
				$("#en_date").val(de[0]);
				$("#en_time").val(de[1]);
				$.uniform.update();
				$("a","#nextBtn").click();
				$.colorbox.close();
				msg_buzy_done();
			};
			function deleteEvent(id) {
				$('#act').val('del');
				var list_id = new Array;
				list_id.push(id);
				$.colorbox.close();
				msg_confirm('Konfirmasi','Apakah anda yakin akan menghapus event ini?',function(){
					msg_buzy('Loading...','Please wait a minute');
					$.ajax({
						type : 'POST',
						url : $('#myForm').attr('action') + '/' + $('#act').val() + '.html',
						dataType : 'json',
						data : {
							id : list_id
						},
						success : function(data){
							calendar.fullCalendar( 'removeEvents', id);
							msg_buzy_done();
							msg_information('Informasi',data.messageBox);
						},
						error : function(XMLHttpRequest, textStatus, errorThrown) {
							msg_buzy_done();
							msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
						}
					});
				});
				return false;
			};
			
			// override method in common.js
			save_item = function() {
				msg_buzy('Loading...','Please wait a minute');
				$.ajax({
					type : 'POST',
					url : $('#myForm').attr('action') + '/' + $('#act').val() + '.html',
					enctype: 'multipart/form-data',
					dataType : 'json',
					data : $('#myForm').serialize(),
					success : function(data){
						if (!data.error){
				    		clear_val();
				    	}
				    	$('#messageBox').html(data.messageBox).show(100);
				    	calendar.fullCalendar('unselect');
				    	calendar.fullCalendar('refetchEvents');
						msg_buzy_done();
					},
					error : function(XMLHttpRequest, textStatus, errorThrown) {
						msg_buzy_done();
						msg_error('ADA KESALAHAN SISTEM!' , errorThrown.toString());
					}
				});
			};
			$(document).ready(function(){
				getSelectOptionsWithController('organisasi',$('input:radio[name=tingkat_organisasi]').filter('[checked="checked"]').attr('id'));
				getSelectOptions('jenis_event');
				$("#st_date, #en_date").datepicker({
					dateFormat: "yy-mm-dd"
				});
				$('#st_time, #en_time').timepicker();
				$('#allday_event').live('change', function() {
				    if ($(this).attr('checked') == "checked")
					   $("#st_date, #en_date").next().hide(); 
				    else
				    	$("#st_date, #en_date").next().show();
				});
				calendar = $('#calendar').fullCalendar({
					theme: true,
					header: {
						left: 'prev,next today',
						center: 'title',
						//left:'',
						right: 'month,agendaWeek,agendaDay'
					},
					selectable: <?php echo $this->user_authority('event');?>,
					selectHelper: <?php echo $this->user_authority('event');?>,
					disableDragging : true,
					disableResizing : true,
					select: function(start, end, allDay) {
						msg_confirm('Konfirmasi','Apakah anda ingin membuat event baru?',function() {
							clear_val();
							var st_date = new Date(start);
							$("#st_date").val(st_date.getFullYear() + "-" + (st_date.getMonth()+1) + "-" + st_date.getDate());
							$("#st_time").val(st_date.getHours() + ":" + st_date.getMinutes() + ":" + st_date.getSeconds());

							var en_date = new Date(end);
							$("#en_date").val(en_date.getFullYear() + "-" + (en_date.getMonth()+1) + "-" + en_date.getDate());
							$("#en_time").val(en_date.getHours() + ":" + en_date.getMinutes() + ":" + en_date.getSeconds());

							$("#allday_event").attr("checked", allDay).change();
							$.uniform.update();
							$("a","#nextBtn").click();
						});						
					},
					editable: true,
					events: "<?php echo getScriptUrl();?>event/fullCal.html",
					loading: function(bool) {
						if (bool) 
							msg_buzy('Loading...','Please wait a minute');
						else 
							setTimeout("callBackLoadTableDone()",5);
					}
				});
				$("#a_inline_content").colorbox({inline:true,width:"100%",maxHeight:"100%"});
			});
		</script>
	</head>
	<body>
		<div id="slider">
			<ul>
				<li>
					<h2>Jadwal Kegiatan</h2>
					<div id='calendar'></div>
					<div class="clear"></div>
				</li>
				<li>
					<h2>Event</h2>  
					<form id="myForm" action="event">
					<fieldset>
						<input type="hidden" name="id" id="id"/>
						<input type="hidden" name="act" id="act"/>
						<dl>
							<dt><label for="nama_event">Nama Event:</label></dt>
							<dd><input name="nama_event" id="nama_event" type="text" size="40"/></dd>
						</dl>
						<dl>
							<dt><label for="jenis_event">Jenis Event:</label></dt>
							<dd>
								<select name="jenis_event" id="jenis_event"></select>
							</dd>
						</dl>
						<dl>
							<dt><label for="st_date">Tanggal Mulai:</label></dt>
							<dd><input name="st_date" id="st_date" readonly="readonly" type="text" size="15"/><span>&emsp;Jam: <input name="st_time" id="st_time" readonly="readonly" type="text" size="10"/></span>&emsp;<input type="checkbox" name="allday_event" id="allday_event" value="1"><label for="allday_event">Seharian</label></dd>
						</dl>
						<dl>
							<dt><label for="en_date">Tanggal Selesai:</label></dt>
							<dd><input name="en_date" id="en_date" readonly="readonly" type="text" size="15"/><span>&emsp;Jam: <input name="en_time" id="en_time" readonly="readonly" type="text" size="10"/></span></dd>
						</dl>
						<dl>
							<dt><label for="organisasi">Tempat:</label></dt>
							<dd><?php echo $this->tingkat_organisasi_opt();?><br/><select name="organisasi" id="organisasi"></select></dd>
						</dl>
						<dl>
							<dt><label for="desc_event">Keterangan:</label></dt>
							<dd><textarea name="desc_event" id="desc_event" cols="37"></textarea></dd>
						</dl>
						<dl>
							<dt></dt>
							<dd>
								<input id="submit" type="submit" value="save" />
								<input type="reset" value="clear"/>
								<input type="button" value="back" id="cancel"/>
							</dd>
						</dl>
					</fieldset>
					</form>
					<div id="messageBox" style="display: none;"></div>
				</li>
			</ul>
		</div>
		<!-- END OF SLIDER -->
		<!-- This contains the hidden content for inline calls -->
		<div style='display: none'>
			<a id="a_inline_content" class='inline' href="#inline_content"></a>
			<div id='inline_content' style='padding: 10px; background: #fff;'></div>
		</div>
		<script type="text/javascript">
			 var formval = new Validator("myForm");
			 formval.EnableMsgsTogether();
			 formval.addValidation('nama_event','req','Nama event tidak boleh kosong!');
			 formval.addValidation('jenis_event','dontselect=00','Jenis Event Belum ada yang dipilih!');
			 formval.addValidation('organisasi','dontselect=00','Organisasi Belum ada yang dipilih!');
			 formval.addValidation('st_date','req','Tanggal mulai tidak boleh kosong!');
			 formval.addValidation('en_date','req','Tanggal selesai tidak boleh kosong!');
			 formval.setAddnlValidationFunction(save_item);
		</script>
	</body>
</html>
