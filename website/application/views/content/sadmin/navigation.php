<aside id="sidebar" class="column">
<!--		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>-->
<!--                <h3>Aktifasi</h3>
                <ul class="toggle">
                    <li class="icn_upld"><a href="<?php echo base_url()?>superadmin/aktifasi/tugas">Kelas (upload tugas)</a></li>
                    <li class="icn_categories"><a href="#">Kelas Praktikum AI</a></li>
                </ul>-->
        <h3>Asisten</h3>
		<ul class="toggle">
			<li class="icn_view_users"><a href="<?php echo base_url()?>superadmin/asisten">Lihat Asisten</a></li>
			<li class="icn_add_user"><a href="<?php echo base_url()?>superadmin/asisten/tambah">Tambah Asisten</a></li>
<!--			<li class="icn_profile"><a href="#">Your Profile</a></li>-->
		</ul>
		<h3>Berita</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="<?php echo base_url()?>superadmin/berita/tambah">Tambah Berita</a></li>
			<li class="icn_edit_article"><a href="<?php echo base_url()?>superadmin/berita">Kelola Berita</a></li>
<!--			<li class="icn_categories"><a href="#">Categories</a></li>-->
<!--			<li class="icn_tags"><a href="#">Tags</a></li>-->
		</ul>
                <h3>PBO</h3>
                <ul class="toggle">
                	<li class="icn_categories"><a href="<?php echo base_url()?>superadmin/pbo/kelas">Kelas PBO</a></li>
                	<li class="icn_view_users"><a href="<?php echo base_url()?>superadmin/pbo/praktikan">Data Praktikan PBO</a></li>
                    <li class="icn_categories"><a href="<?php echo base_url()?>superadmin/pbo/nilai">Nilai</a></li>
                </ul>
                <h3>KCB</h3>
                <ul class="toggle">
                    <li class="icn_categories"><a href="<?php echo base_url()?>superadmin/kcb/kelas">Kelas KCB (teori)</a></li>
                    <li class="icn_categories"><a href="<?php echo base_url()?>superadmin/kcb/praktikum">Kelas KCB (praktikum)</a></li>
                    <li class="icn_categories"><a href="<?php echo base_url()?>superadmin/kcb/responsi">Jadwal Responsi KCB</a></li>
                    <li class="icn_view_users"><a href="<?php echo base_url()?>superadmin/kcb/mahasiswa">Data Mahasiswa KCB (teori)</a></li>
                    <li class="icn_view_users"><a href="<?php echo base_url()?>superadmin/kcb/praktikan">Data Mahasiswa KCB (praktikum)</a></li>
                    <li class="icn_view_users"><a href="<?php echo base_url()?>superadmin/kcb/responsi/praktikan">Data Responsi KCB</a></li>
                </ul>
                <h3>Repositori</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="<?php echo base_url()?>superadmin/repositori/materi">Materi</a></li>
			<li class="icn_categories"><a href="<?php echo base_url()?>superadmin/repositori/sc">Source Code</a></li>
		</ul>
                <h3>Tugas</h3>
		<ul class="toggle">
			
			<li class="icn_folder"><a href="<?php echo base_url()?>superadmin/tugas">Tugas</a></li>
		</ul>
		<h3>Pesan</h3>
		<ul class="toggle">
                    <li class="icn_tags"><a href="<?php echo base_url()?>superadmin/pesan">Pesan Masuk</a></li>
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
			<li class="icn_profile"><a href="<?php echo base_url()?>superadmin/akun">Akun</a></li>
			<li class="icn_active"><a href="<?php echo base_url()?>superadmin/aktifasi">Aktifasi</a></li>
			<li class="icn_settings"><a href="<?php echo base_url()?>superadmin/pengaturan">Pengaturan</a></li>
<!--			<li class="icn_security"><a href="#">Security</a></li>-->
			<li class="icn_jump_back"><a href="<?php echo base_url()?>superadmin/login/logout">Logout</a></li>
		</ul>
		                
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2012  KSC Laboratory</strong></p>
			<p>Script by <strong>Imam S Rifkan</strong><br/>Design by MediaLoot</p>
		</footer>
	</aside>