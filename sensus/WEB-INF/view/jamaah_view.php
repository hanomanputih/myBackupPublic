<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery.ui.timepicker.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorbox.css" />
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorbox.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-ui.1.8.7.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.ui.timepicker.js"></script>
		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
				$('input:radio[name=mubaligh]').filter('[value='+data.mubaligh+']').attr('checked', true);
				$('input:radio[name=status_hidup]').filter('[value='+data.status_hidup+']').attr('checked', true);
				$('input:radio[name=jenis_kelamin]').filter('[value='+data.jenis_kelamin+']').attr('checked', true);
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}

			function reload_data(){
				getSelectOptions('kelompok');
				getSelectOptions('pekerjaan');
				getSelectOptions('status_jamaah');
				getSelectOptions('status_kawin');
				getSelectOptions('status_sambung');
				getSelectOptions('pendidikan');
				$.uniform.update();
			}
			
			$(document).ready(function() {
				getSelectOptions('kelompok');
				getSelectOptions('pekerjaan');
				getSelectOptions('status_jamaah');
				getSelectOptions('status_kawin');
				getSelectOptions('status_sambung');
				getSelectOptions('pendidikan');
				$(".foto_jamaah").colorbox({rel:'foto_jamaah', transition:"fade"});
				$(".inline").colorbox({inline:true,width:"100%",maxHeight:"100%"});
				$("#tanggal_lahir").datepicker({
					changeMonth	: true,
					changeYear	: true,
					dateFormat	: "yy-mm-dd",
					yearRange	: 'c-110:c'
				});
				$("#tanggal_aktif").datepicker({
					dateFormat	: "yy-mm-dd"
				});
			});
		</script>
	</head>
	<body onLoad="load_table()">
	<div id="slider">
		<ul>				
			<li>
				<h2>List Jamaah</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>Jamaah</h2>
			<form id="myForm" action="jamaah" enctype="multipart/form-data">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="id" id="id"/>
				<input type="hidden" name="act" id="act"/>
				<input type="hidden" name="foto" id="foto"/>
				<dl>
					<dt><label for="nama_lengkap">Nama Lengkap:</label></dt>
					<dd><input name="nama_lengkap" id="nama_lengkap" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="nama_panggilan">Nama Panggilan:</label></dt>
					<dd><input name="nama_panggilan" id="nama_panggilan" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="tempat_lahir">Tempat Lahir:</label></dt>
					<dd><input name="tempat_lahir" id="tempat_lahir" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="tanggal_lahir">Tanggal Lahir:</label></dt>
					<dd><input name="tanggal_lahir" id="tanggal_lahir" type="text" size="40"/><label for="tanggal_lahir">&nbsp;(yyyy-mm-dd)</label></dd>
				</dl>
				<dl>
					<dt><label for="jenis_kelamin">Jenis Kelamin:</label></dt>
		            <dd>
		            	<input type="radio" name="jenis_kelamin" id="jenis_kelamin_l" value="L" checked="checked"/><label for="jenis_kelamin_l" class="opt">Laki-laki</label>
		                <input type="radio" name="jenis_kelamin" id="jenis_kelamin_p" value="P" /><label for="jenis_kelamin_p" class="opt">Perempuan</label>
		            </dd>
				</dl>
				<dl>
					<dt><label for="nama_ayah">Nama Ayah:</label></dt>
					<dd><input name="nama_ayah" id="nama_ayah" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="nama_ibu">Nama Ibu:</label></dt>
					<dd><input name="nama_ibu" id="nama_ibu" type="text" size="40"/></dd>
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
					<dt><label for="telepon_wali">Telepon Wali:</label></dt>
					<dd><input name="telepon_wali" id="telepon_wali" type="text" size="40"/></dd>
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
					<dt><label for="status_jamaah">Status Jamaah:</label></dt>
					<dd>
						<select name="status_jamaah" id="status_jamaah"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="tanggal_aktif">Tanggal Mulai Aktif:</label></dt>
					<dd><input name="tanggal_aktif" id="tanggal_aktif" type="text" readonly="readonly" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="status_kawin">Status Kawin:</label></dt>
					<dd>
						<select name="status_kawin" id="status_kawin"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="pendapatan">Pendapatan:</label></dt>
					<dd><input name="pendapatan" id="pendapatan" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="harta">Harta:</label></dt>
					<dd><input name="harta" id="harta" type="text" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="status_sambung">Status Sambung:</label></dt>
					<dd>
						<select name="status_sambung" id="status_sambung"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="kelompok">Kelompok:</label></dt>
					<dd>
						<select name="kelompok" id="kelompok"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="mubaligh">Mubaligh/Mubalighot:</label></dt>
		            <dd>
		            	<input type="radio" name="mubaligh" id="mubaligh_y" value="1" /><label for="mubaligh_y" class="opt">Ya</label>
		                <input type="radio" name="mubaligh" id="mubaligh_n" value="0" checked="checked" /><label for="mubaligh_n" class="opt">Bukan</label>
		            </dd>
				</dl>
				<dl>
					<dt><label for="status_hidup">Status Hidup:</label></dt>
		            <dd>
		            	<input type="radio" name="status_hidup" id="status_hidup_y" value="HIDUP" checked="checked" /><label for="status_hidup_y" class="opt">Hidup</label>
		                <input type="radio" name="status_hidup" id="status_hidup_n" value="MATI" /><label for="status_hidup_n" class="opt">Mati</label>
		            </dd>
				</dl>
				<dl>
					<dt><label for="pekerjaan">Pekerjaan:</label></dt>
					<dd>
						<select name="pekerjaan" id="pekerjaan"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="pendidikan">Pendidikan Terakhir:</label></dt>
					<dd>
						<select name="pendidikan" id="pendidikan"></select>
					</dd>
				</dl>
				<dl>
					<dt><label for="file">Foto:</label></dt>
					<dd><input name="file" id="file" type="file" size="40"/></dd>
				</dl>
				<dl>
					<dt><label for="desc_jamaah">Keterangan:</label></dt>
					<dd><textarea name="desc_jamaah" id="desc_jamaah" cols="37"></textarea></dd>
				</dl>
				<dl>
					<dt></dt>
					<dd>
						<input id="submit" type="submit" value="save" />
						<input type="button" value="reload" onclick="javascript:reload_data()"/>
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
	<script type="text/javascript">
		 var formval = new Validator("myForm");
		 formval.EnableMsgsTogether();
		 formval.addValidation('nama_lengkap','req','Nama lengkap tidak boleh kosong!');
		 formval.addValidation('status_jamaah','dontselect=00','Status Jamaah belum ada yang dipilih!');
		 formval.addValidation('status_kawin','dontselect=00','Status Kawin belum ada yang dipilih!');
		 formval.addValidation('status_sambung','dontselect=00','Status Sambung belum ada yang dipilih!');
		 formval.addValidation('kelompok','dontselect=00','Kelompok belum ada yang dipilih!');
		 formval.addValidation('pekerjaan','dontselect=00','Pekerjaan belum ada yang dipilih!');
		 formval.addValidation('pendidikan','dontselect=00','Pendidikan belum ada yang dipilih!');
		 formval.addValidation('nama_panggilan','req','Nama panggilan tidak boleh kosong!');
		 formval.addValidation('tanggal_aktif','req','Tanggal mulai aktif tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>