<h2>Edit Data</h2>
<?php if ($this->uri->segment(2)=='update') {
	# code...
?>
<div class="alert">
<?php echo $msg ?>
</div>
<?php } ?>
<form class="form-action" action = "<?php echo base_url();?>index.php/data/update" method="POST">
	<table cellpadding="5">
		<input type="hidden" name="id" value="<?php echo $data['mahasiswa_id']?>">
		<tr>
			<td>NIM</td>
			<td><input type="text" name="nim" placeholder="Masukan NIM" value="<?php echo $data['mahasiswa_nim']?>"></td>
		</tr>	
		<tr>
			<td>Nama</td>
			<td><input type="text" name="nama" placeholder="Masukan Nama Lengkap" value="<?php echo $data['mahasiswa_nama']?>"></td>
		</tr>
		<tr>
			<td>Jurusan</td>
			<td><input type="text" name="jurusan" placeholder="Masukan Jurusan" value="<?php echo $data['mahasiswa_jurusan']?>"></td>
		</tr>	
		<tr>
			<td></td>
			<td><input class="btn btn-primary" type="submit" name="Simpan" value="simpan">  <a class="btn" href="<?php echo base_url()?>index.php/data">Batal</a></td>
		</tr>
	</table>
</form>