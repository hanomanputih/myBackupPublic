<h2><?php echo $title ?></h2>
<hr>
<table class="table table-bordered table-striped">
	<thead>
		<tr>
			<th>No</th>
			<th>NIM</th>
			<th>Nama</th>
			<th>Jurusan</th>
		</tr>	
	</thead>
	<tbody>
		<?php 
			if ($data) {
				$no = 1;
				foreach ($data as $result) {
					?>
						<tr>
							<td><?php echo $no ?></td>
							<td><?php echo $result['mahasiswa_nim'] ?></td>
							<td><?php echo $result['mahasiswa_nama']?></td>
							<td><?php echo $result['mahasiswa_jurusan'] ?></td>
							<td><a href="<?php echo base_url()?>/index.php/data/edit/<?php echo $result['mahasiswa_id']?> ">Edit</a> | <a href="<?php echo base_url()?>/index.php/data/hapus/<?php echo $result['mahasiswa_id']?>">Delete</a></td>
						</tr>
					<?php 
					$no++;
				}
			}else{
				?>
				<tr class="color-red">
					<td colspan="4">Data Tidak tersedia</td>
				</tr>
				<?php
			}
		 ?>
	</tbody>
</table>
<a class="btn btn-primary" href="<?php base_url()?>data/input">Tambah</a>
