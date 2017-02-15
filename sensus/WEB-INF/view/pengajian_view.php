<!DOCTYPE html>
<html>
	<head>
		<meta charset='utf-8'/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/colorbox.css"/>
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery-ui-1.8.18.custom.css" type="text/css" media="screen" />
		<link rel="stylesheet" href="<?php echo getScriptUrl();?>style/jquery.ui.timepicker.css" type="text/css" media="screen" />
		<?php include 'WEB-INF/common/layout.php';?>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery-ui.1.8.7.min.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.ui.timepicker.js"></script>
		<script type="text/javascript" src="<?php echo getScriptUrl();?>js/jquery.colorbox.js"></script>
		<script type="text/javascript">
			function callBackEditSucces(data){
				initFormEdit(data);
				$('input:radio[name=tingkat_organisasi]').filter('[value='+data.tingkat_organisasi+']').attr('checked', true);
				var a = (data.alquran_ayat == null) ? new Array('','') : data.alquran_ayat.split('-');
				$('#alquran_ayat1').val(a[0]);
				$('#alquran_ayat2').val(a[1]);
				var b = (data.alhadist_halaman == null) ? new Array('','') : data.alhadist_halaman.split('-');
				$('#alhadist_halaman1').val(b[0]);
				$('#alhadist_halaman2').val(b[1]);
				var c = (data.alquran_bacaan_ayat == null) ? new Array('','') : data.alquran_bacaan_ayat.split('-');
				$('#alquran_bacaan_ayat1').val(c[0]);
				$('#alquran_bacaan_ayat2').val(c[1]);
				var d = (data.tanggal_pengajian == null) ? new Array('','') : data.tanggal_pengajian.split(' ');
				$('#tanggal').val(d[0]);
				$('#jam').val(d[1]);
				$.uniform.update();
				$("a","#nextBtn").click();
				msg_buzy_done();
			}
			
			$(document).ready(function() {
				$(".inline").colorbox({inline:true,width:"100%",maxHeight:"100%"});
				getSelectOptions('jenis_pengajian');
				getSelectOptionsWithController('organisasi',$('input:radio[name=tingkat_organisasi]').filter('[checked="checked"]').attr('id'));
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
				<h2>List Pengajian</h2>           
				<div id="table" ></div>
				<div id="messageBoxDelete" style="display: none;"></div>
				<?php $this->user_authority();?>
				<div class="pagination"></div> 	 
			</li>
			<li>
			<h2>Pengajian</h2>
			<form id="myForm" action="pengajian">
			<fieldset>
				<input type="hidden" name="page" id="page" value="1"/>
				<input type="hidden" name="id" id="id"/>
				<input type="hidden" name="act" id="act"/>
				<dl>
					<dt><label for="jenis_pengajian">Jenis Pengajian</label></dt>
					<dd><select name="jenis_pengajian" id="jenis_pengajian" ></select></dd>
				</dl>
				<dl>
					<dt><label for="tingkat_organisasi">Tingkat Organisasi:</label></dt>
		            <dd>
		            	<?php echo $this->tingkat_organisasi_opt();?>
		            </dd>
				</dl>
				<dl>
					<dt><label for="organisasi">Organisasi:</label></dt>
					<dd><select name="organisasi" id="organisasi"></select></dd>
				</dl>
				<dl>
					<dt><label for="tanggal_pengajian">Tanggal Pengajian:</label></dt>
					<dd><input name="tanggal" id="tanggal" readonly="readonly" type="text" size="15"/>&nbsp;Jam: <input name="jam" id="jam" readonly="readonly" type="text" size="10"/></dd>
				</dl>
				<dl>
					<dt><label for="alquran_bacaan">Surat Alquran Bacaan:</label></dt>
					<dd>
						<select name="alquran_bacaan" id="alquran_bacaan">
							<option value="AL FAATIHAH">AL FAATIHAH</option>
							<option value="AL BAQARAH">AL BAQARAH</option>
							<option value="ALI 'IMRAN">ALI 'IMRAN</option>
							<option value="AN NISAA'">AN NISAA'</option>
							<option value="AL MAA-IDAH">AL MAA-IDAH</option>
							<option value="AL AN'AAM">AL AN'AAM</option>
							<option value="AL A'RAAF">AL A'RAAF</option>
							<option value="AL ANFAAL">AL ANFAAL</option>
							<option value="AT TAUBAH">AT TAUBAH</option>
							<option value="YUNUS">YUNUS</option>
							<option value="HUD">HUD</option>
							<option value="YUSUF">YUSUF</option>
							<option value="AR RA'D">AR RA'D</option>
							<option value="IBRAHIM">IBRAHIM</option>
							<option value="AL HIJR">AL HIJR</option>
							<option value="AN NAHL">AN NAHL</option>
							<option value="AL ISRAA'">AL ISRAA'</option>
							<option value="AL KAHFI">AL KAHFI</option>
							<option value="MARYAM">MARYAM</option>
							<option value="THAAHAA">THAAHAA</option>
							<option value="AL ANBYAA'">AL ANBYAA'</option>
							<option value="AL HAJJ">AL HAJJ</option>
							<option value="AL MU'MINUUN">AL MU'MINUUN</option>
							<option value="AN NUUR">AN NUUR</option>
							<option value="AL FURQAAN">AL FURQAAN</option>
							<option value="ASY SYU'ARAA'">ASY SYU'ARAA'</option>
							<option value="AN NAML">AN NAML</option>
							<option value="AL QASHASH">AL QASHASH</option>
							<option value="AL'ANKABUUT">AL'ANKABUUT</option>
							<option value="AR RUUM">AR RUUM</option>
							<option value="LUQMAN">LUQMAN</option>
							<option value="AS SAJDAH">AS SAJDAH</option>
							<option value="AL AHZAB">AL AHZAB</option>
							<option value="SABA'">SABA'</option>
							<option value="FATHIR">FATHIR</option>
							<option value="YASSIIN">YASSIIN</option>
							<option value="ASH SHAAFFAAT">ASH SHAAFFAAT</option>
							<option value="SHAAD">SHAAD</option>
							<option value="AZ ZUMAR">AZ ZUMAR</option>
							<option value="AL MU'MIN">AL MU'MIN</option>
							<option value="AL FUSHSHILAT">AL FUSHSHILAT</option>
							<option value="ASY SYURA">ASY SYURA</option>
							<option value="AZ ZUKHRUF">AZ ZUKHRUF</option>
							<option value="AD DUKHAAN">AD DUKHAAN</option>
							<option value="AL JAATSIYAH">AL JAATSIYAH</option>
							<option value="AL AHQAAF">AL AHQAAF</option>
							<option value="MUHAMMAD">MUHAMMAD</option>
							<option value="AL FATH">AL FATH</option>
							<option value="AL HUJURAAT">AL HUJURAAT</option>
							<option value="QAAF">QAAF</option>
							<option value="ADZ DZAARIYAAT">ADZ DZAARIYAAT</option>
							<option value="ATH THUUR">ATH THUUR</option>
							<option value="AN NAJM">AN NAJM</option>
							<option value="AL QAMAR">AL QAMAR</option>
							<option value="AR RAHMAAN">AR RAHMAAN</option>
							<option value="AL WAAQI'AH">AL WAAQI'AH</option>
							<option value="AL HADIID">AL HADIID</option>
							<option value="AL MUJAADILAH">AL MUJAADILAH</option>
							<option value="AL HASYR">AL HASYR</option>
							<option value="AL MUMTAHANAH">AL MUMTAHANAH</option>
							<option value="ASH SHAFF">ASH SHAFF</option>
							<option value="AL JUMU'AH">AL JUMU'AH</option>
							<option value="AL MUNAAFIQUUN">AL MUNAAFIQUUN</option>
							<option value="AT TAGHAABUN">AT TAGHAABUN</option>
							<option value="ATH THALAAQ">ATH THALAAQ</option>
							<option value="AT TAHRIIM">AT TAHRIIM</option>
							<option value="AL MULK">AL MULK</option>
							<option value="AL QALAM">AL QALAM</option>
							<option value="AL HAAQQAH">AL HAAQQAH</option>
							<option value="AL MA'AARIJ">AL MA'AARIJ</option>
							<option value="NUH">NUH</option>
							<option value="AL JIN">AL JIN</option>
							<option value="AL MUZZAMMIL">AL MUZZAMMIL</option>
							<option value="AL MUDDATSTSIR">AL MUDDATSTSIR</option>
							<option value="AL QIYAAMAH">AL QIYAAMAH</option>
							<option value="AL INSAAN">AL INSAAN</option>
							<option value="AL MURSALAAT">AL MURSALAAT</option>
							<option value="AN NABA'">AN NABA'</option>
							<option value="AN NAAZI'AAT">AN NAAZI'AAT</option>
							<option value="'ABASA">'ABASA</option>
							<option value="AT TAKWIIR">AT TAKWIIR</option>
							<option value="AL INFITHAAR">AL INFITHAAR</option>
							<option value="AL MUTHAFFIFIIN">AL MUTHAFFIFIIN</option>
							<option value="AL INSYIQAAQ">AL INSYIQAAQ</option>
							<option value="AL BURUUJ">AL BURUUJ</option>
							<option value="ATH THAARIQ">ATH THAARIQ</option>
							<option value="AL A'LAA">AL A'LAA</option>
							<option value="AL GHAASYIYAH">AL GHAASYIYAH</option>
							<option value="AL FAJR">AL FAJR</option>
							<option value="AL BALAD">AL BALAD</option>
							<option value="ASY SYAMS">ASY SYAMS</option>
							<option value="AL LAIL">AL LAIL</option>
							<option value="ADH DHUHAA">ADH DHUHAA</option>
							<option value="ALAM NASYRAH">ALAM NASYRAH</option>
							<option value="AT TIIN">AT TIIN</option>
							<option value="AL 'ALAQ">AL 'ALAQ</option>
							<option value="AL QADR">AL QADR</option>
							<option value="AL BAYYINAH">AL BAYYINAH</option>
							<option value="AZ ZALZALAH">AZ ZALZALAH</option>
							<option value="AL 'ADIYAAT">AL 'ADIYAAT</option>
							<option value="AL QAARI'AH">AL QAARI'AH</option>
							<option value="AT TAKAATSUR">AT TAKAATSUR</option>
							<option value="AL 'ASHR">AL 'ASHR</option>
							<option value="AL HUMAZAH">AL HUMAZAH</option>
							<option value="AL FIIL">AL FIIL</option>
							<option value="QURAISY">QURAISY</option>
							<option value="AL MAA'UUN">AL MAA'UUN</option>
							<option value="AL KAUTSAR">AL KAUTSAR</option>
							<option value="AL KAAFIRUUN">AL KAAFIRUUN</option>
							<option value="AN NASHR">AN NASHR</option>
							<option value="AL LAHAB">AL LAHAB</option>
							<option value="AL IKHLASH">AL IKHLASH</option>
							<option value="AL FALAQ">AL FALAQ</option>
							<option value="AN NAAS">AN NAAS</option>
						</select>
					</dd>
				</dl>
				<dl>
					<dt><label for="alquran_bacaan_ayat">Ayat Alquran Bacaan:</label></dt>
					<dd><input name="alquran_bacaan_ayat[]" id="alquran_bacaan_ayat1" type="text" size="10" /> - <input name="alquran_bacaan_ayat[]" id="alquran_bacaan_ayat2" type="text" size="10" /></dd>
				</dl>
				<dl>
					<dt><label for="alquran_surat">Surat Alquran Makna:</label></dt>
					<dd>
						<select name="alquran_surat" id="alquran_surat">
							<option value="AL FAATIHAH">AL FAATIHAH</option>
							<option value="AL BAQARAH">AL BAQARAH</option>
							<option value="ALI 'IMRAN">ALI 'IMRAN</option>
							<option value="AN NISAA'">AN NISAA'</option>
							<option value="AL MAA-IDAH">AL MAA-IDAH</option>
							<option value="AL AN'AAM">AL AN'AAM</option>
							<option value="AL A'RAAF">AL A'RAAF</option>
							<option value="AL ANFAAL">AL ANFAAL</option>
							<option value="AT TAUBAH">AT TAUBAH</option>
							<option value="YUNUS">YUNUS</option>
							<option value="HUD">HUD</option>
							<option value="YUSUF">YUSUF</option>
							<option value="AR RA'D">AR RA'D</option>
							<option value="IBRAHIM">IBRAHIM</option>
							<option value="AL HIJR">AL HIJR</option>
							<option value="AN NAHL">AN NAHL</option>
							<option value="AL ISRAA'">AL ISRAA'</option>
							<option value="AL KAHFI">AL KAHFI</option>
							<option value="MARYAM">MARYAM</option>
							<option value="THAAHAA">THAAHAA</option>
							<option value="AL ANBYAA'">AL ANBYAA'</option>
							<option value="AL HAJJ">AL HAJJ</option>
							<option value="AL MU'MINUUN">AL MU'MINUUN</option>
							<option value="AN NUUR">AN NUUR</option>
							<option value="AL FURQAAN">AL FURQAAN</option>
							<option value="ASY SYU'ARAA'">ASY SYU'ARAA'</option>
							<option value="AN NAML">AN NAML</option>
							<option value="AL QASHASH">AL QASHASH</option>
							<option value="AL'ANKABUUT">AL'ANKABUUT</option>
							<option value="AR RUUM">AR RUUM</option>
							<option value="LUQMAN">LUQMAN</option>
							<option value="AS SAJDAH">AS SAJDAH</option>
							<option value="AL AHZAB">AL AHZAB</option>
							<option value="SABA'">SABA'</option>
							<option value="FATHIR">FATHIR</option>
							<option value="YASSIIN">YASSIIN</option>
							<option value="ASH SHAAFFAAT">ASH SHAAFFAAT</option>
							<option value="SHAAD">SHAAD</option>
							<option value="AZ ZUMAR">AZ ZUMAR</option>
							<option value="AL MU'MIN">AL MU'MIN</option>
							<option value="AL FUSHSHILAT">AL FUSHSHILAT</option>
							<option value="ASY SYURA">ASY SYURA</option>
							<option value="AZ ZUKHRUF">AZ ZUKHRUF</option>
							<option value="AD DUKHAAN">AD DUKHAAN</option>
							<option value="AL JAATSIYAH">AL JAATSIYAH</option>
							<option value="AL AHQAAF">AL AHQAAF</option>
							<option value="MUHAMMAD">MUHAMMAD</option>
							<option value="AL FATH">AL FATH</option>
							<option value="AL HUJURAAT">AL HUJURAAT</option>
							<option value="QAAF">QAAF</option>
							<option value="ADZ DZAARIYAAT">ADZ DZAARIYAAT</option>
							<option value="ATH THUUR">ATH THUUR</option>
							<option value="AN NAJM">AN NAJM</option>
							<option value="AL QAMAR">AL QAMAR</option>
							<option value="AR RAHMAAN">AR RAHMAAN</option>
							<option value="AL WAAQI'AH">AL WAAQI'AH</option>
							<option value="AL HADIID">AL HADIID</option>
							<option value="AL MUJAADILAH">AL MUJAADILAH</option>
							<option value="AL HASYR">AL HASYR</option>
							<option value="AL MUMTAHANAH">AL MUMTAHANAH</option>
							<option value="ASH SHAFF">ASH SHAFF</option>
							<option value="AL JUMU'AH">AL JUMU'AH</option>
							<option value="AL MUNAAFIQUUN">AL MUNAAFIQUUN</option>
							<option value="AT TAGHAABUN">AT TAGHAABUN</option>
							<option value="ATH THALAAQ">ATH THALAAQ</option>
							<option value="AT TAHRIIM">AT TAHRIIM</option>
							<option value="AL MULK">AL MULK</option>
							<option value="AL QALAM">AL QALAM</option>
							<option value="AL HAAQQAH">AL HAAQQAH</option>
							<option value="AL MA'AARIJ">AL MA'AARIJ</option>
							<option value="NUH">NUH</option>
							<option value="AL JIN">AL JIN</option>
							<option value="AL MUZZAMMIL">AL MUZZAMMIL</option>
							<option value="AL MUDDATSTSIR">AL MUDDATSTSIR</option>
							<option value="AL QIYAAMAH">AL QIYAAMAH</option>
							<option value="AL INSAAN">AL INSAAN</option>
							<option value="AL MURSALAAT">AL MURSALAAT</option>
							<option value="AN NABA'">AN NABA'</option>
							<option value="AN NAAZI'AAT">AN NAAZI'AAT</option>
							<option value="'ABASA">'ABASA</option>
							<option value="AT TAKWIIR">AT TAKWIIR</option>
							<option value="AL INFITHAAR">AL INFITHAAR</option>
							<option value="AL MUTHAFFIFIIN">AL MUTHAFFIFIIN</option>
							<option value="AL INSYIQAAQ">AL INSYIQAAQ</option>
							<option value="AL BURUUJ">AL BURUUJ</option>
							<option value="ATH THAARIQ">ATH THAARIQ</option>
							<option value="AL A'LAA">AL A'LAA</option>
							<option value="AL GHAASYIYAH">AL GHAASYIYAH</option>
							<option value="AL FAJR">AL FAJR</option>
							<option value="AL BALAD">AL BALAD</option>
							<option value="ASY SYAMS">ASY SYAMS</option>
							<option value="AL LAIL">AL LAIL</option>
							<option value="ADH DHUHAA">ADH DHUHAA</option>
							<option value="ALAM NASYRAH">ALAM NASYRAH</option>
							<option value="AT TIIN">AT TIIN</option>
							<option value="AL 'ALAQ">AL 'ALAQ</option>
							<option value="AL QADR">AL QADR</option>
							<option value="AL BAYYINAH">AL BAYYINAH</option>
							<option value="AZ ZALZALAH">AZ ZALZALAH</option>
							<option value="AL 'ADIYAAT">AL 'ADIYAAT</option>
							<option value="AL QAARI'AH">AL QAARI'AH</option>
							<option value="AT TAKAATSUR">AT TAKAATSUR</option>
							<option value="AL 'ASHR">AL 'ASHR</option>
							<option value="AL HUMAZAH">AL HUMAZAH</option>
							<option value="AL FIIL">AL FIIL</option>
							<option value="QURAISY">QURAISY</option>
							<option value="AL MAA'UUN">AL MAA'UUN</option>
							<option value="AL KAUTSAR">AL KAUTSAR</option>
							<option value="AL KAAFIRUUN">AL KAAFIRUUN</option>
							<option value="AN NASHR">AN NASHR</option>
							<option value="AL LAHAB">AL LAHAB</option>
							<option value="AL IKHLASH">AL IKHLASH</option>
							<option value="AL FALAQ">AL FALAQ</option>
							<option value="AN NAAS">AN NAAS</option>
						</select>
					</dd>
				</dl>
				<dl>
					<dt><label for="alquran_ayat">Ayat Alquran Makna:</label></dt>
					<dd><input name="alquran_ayat[]" id="alquran_ayat1" type="text" size="10" /> - <input name="alquran_ayat[]" id="alquran_ayat2" type="text" size="10" /></dd>
				</dl>
				<dl>
					<dt><label for="penyampai_alquran">Penyampai Alquran:</label></dt>
					<dd><input name="penyampai_alquran" id="penyampai_alquran" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="alhadist">Alhadist:</label></dt>
					<dd><input name="alhadist" id="alhadist" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="alhadist_halaman">Halaman Alhadist:</label></dt>
					<dd><input name="alhadist_halaman[]" id="alhadist_halaman1" type="text" size="10" /> - <input name="alhadist_halaman[]" id="alhadist_halaman2" type="text" size="10" /></dd>
				</dl>
				<dl>
					<dt><label for="penyampai_alhadist">Penyampai Alhadist:</label></dt>
					<dd><input name="penyampai_alhadist" id="penyampai_alhadist" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="nasehat_materi">Materi Nasehat:</label></dt>
					<dd><input name="nasehat_materi" id="nasehat_materi" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="penasehat">Penasehat:</label></dt>
					<dd><input name="penasehat" id="penasehat" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="materi_lain">Materi Lain:</label></dt>
					<dd><input name="materi_lain" id="materi_lain" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="penyampai_materi_lain">Penyampai Materi Lain:</label></dt>
					<dd><input name="penyampai_materi_lain" id="penyampai_materi_lain" type="text" size="40" /></dd>
				</dl>
				<dl>
					<dt><label for="desc_pengajian">Keterangan Pengajian:</label></dt>
					<dd><textarea name="desc_pengajian" id="desc_pengajian" cols="37"></textarea></dd>
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
		 formval.addValidation('jenis_pengajian','dontselect=00','Jenis pengajian belum ada yang dipilih!');
		 formval.addValidation('organisasi','dontselect=00','Organisasi belum ada yang dipilih!');
		 formval.addValidation('tanggal','req','Tanggal tidak boleh kosong!');
		 formval.addValidation('jam','req','Tanggal tidak boleh kosong!');
		 formval.setAddnlValidationFunction(save_item);
	</script>
	</body>
</html>