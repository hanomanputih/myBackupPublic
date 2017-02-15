<aside id="sidebar" class="column">
<?php
$jabatan = $this->session->userdata("user_jabatan");

?>
        <h3><a href="<?php echo base_url()?>asisten/menu">Halaman Utama</a></h3>
        <h3>Asisten</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a href="<?php echo base_url()?>asisten/asisten">Lihat Asisten</a></li>
                        <?php
                        if($jabatan == "manajer")
                        {
                        ?>
			<li class="icn_add_user"><a href="<?php echo base_url()?>asisten/asisten/tambah">Tambah Asisten</a></li>
                        <?php
                        }
                        ?>
		</ul>
		<h3>Berita</h3>
		<ul class="toggle">
                        <?php
                        if(($jabatan == "manajer") OR $jabatan == "administrasi")
                        {
                        ?>
			<li class="icn_new_article"><a href="<?php echo base_url()?>asisten/berita/tambah">Tambah Berita</a></li>
                        <?php
                        }
                        ?>
			<li class="icn_edit_article"><a href="<?php echo base_url()?>asisten/berita">Kelola Berita</a></li>
		</ul>
                <h3>PBO</h3>
                <ul class="toggle">
                    <li class="icn_view_users"><a href="<?php echo base_url()?>asisten/pbo/praktikan">Praktikan PBO</a></li>
                    <li class="icn_categories"><a href="<?php echo base_url()?>asisten/pbo/kelas">Kelas PBO</a></li>
                    <li class="icn_categories"><a href="<?php echo base_url()?>asisten/pbo/nilai">Nilai</a></li>
                </ul>
                <h3>KCB</h3>
                <ul class="toggle">
                    <li class="icn_categories"><a href="<?php echo base_url()?>asisten/kcb/kelas">Kelas KCB (teori)</a></li>
                    <li class="icn_categories"><a href="<?php echo base_url()?>asisten/kcb/praktikum">Kelas KCB (praktikum)</a></li>
                    <li class="icn_categories"><a href="<?php echo base_url()?>asisten/kcb/responsi">Jadwal Responsi KCB</a></li>
                    <li class="icn_view_users"><a href="<?php echo base_url()?>asisten/kcb/mahasiswa">Data Mahasiswa KCB (teori)</a></li>
                    <li class="icn_view_users"><a href="<?php echo base_url()?>asisten/kcb/praktikan">Data Mahasiswa KCB (praktikum)</a></li>
                    <li class="icn_view_users"><a href="<?php echo base_url()?>asisten/kcb/responsi/praktikan">Data Responsi KCB</a></li>
                </ul>
                <h3>Repositori</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="<?php echo base_url()?>asisten/repositori/materi">Materi</a></li>
			<li class="icn_categories"><a href="<?php echo base_url()?>asisten/repositori/sc">Source Code</a></li>
		</ul>
                <h3>Tugas</h3>
		<ul class="toggle">
			
			<li class="icn_folder"><a href="<?php echo base_url()?>asisten/tugas">Tugas</a></li>
		</ul>
		<h3>Pesan</h3>
		<ul class="toggle">
                    <li class="icn_tags"><a href="<?php echo base_url()?>asisten/pesan">Pesan Masuk</a></li>
		</ul>
		<h3>Laporan</h3>
		<ul class="toggle">
			<?php
			if($ta)
			{
				foreach($ta as $result)
				{
					?>
					<li class="icn_categories"><a href="#"><?php echo $result["ta_nama"]?></a></li>
					<?php
				}	
			}
			?>
		</ul>

		<h3>Pengaturan</h3>
		<ul class="toggle">
			<li class="icn_active"><a href="<?php echo base_url()?>asisten/aktifasi">Aktifasi</a></li>
			<li class="icn_settings"><a href="<?php echo base_url()?>asisten/pengaturan">Pengaturan</a></li>
			<li class="icn_jump_back"><a href="<?php echo base_url()?>asisten/login/logout">Logout</a></li>
		</ul>
		                
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2012  KSC Laboratory</strong></p>
			<p>Script by <strong>Imam S Rifkan</strong><br/>Design by MediaLoot</p>
		</footer>
	</aside>