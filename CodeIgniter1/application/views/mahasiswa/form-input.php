<h2>Input Data</h2>
<?php if($this->uri->segment(2)=='proses'){ ?>
<div class="alert">
<?php echo $msg ?>
</div>
<?php } ?>
<form class="form-action" action = "<?php echo base_url();?>index.php/data/proses" method="POST">
	<table cellpadding="5">
		<tr>
			<td>NIM</td>
			<td><input type="text" name="nim" placeholder="Masukan NIM" value="<?php echo set_value('nim');?>"></td>
		</tr>	
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama" placeholder="Masukan Nama Lengkap" value="<?php echo set_value('nama');?>"></td>
		</tr>
		<tr>
			<td>Jurusan</td>
			<td><input type="text" name="jurusan" placeholder="Masukan Jurusan" value="<?php echo set_value('jurusan');?>"></td>
		</tr>	
		<tr>
			<td></td>
			<td><input class="btn btn-primary" type="submit" name="Simpan" value="simpan">  <a class="btn" href="<?php echo base_url()?>index.php/data">Batal</a></td>
		</tr>
	</table>
</form>