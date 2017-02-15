<aside id="sidebar" class="column">
<!--		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>-->
		<?php
		if($this->session->userdata("user_divisi") == "Manajer" || $this->session->userdata("user_divisi") == "Administrasi")
		{
		?>
  		<h3>Berita</h3>
		<ul class="toggle">
			<li class="icn_new_article"><a href="<?php echo base_url()?>asisten/berita/tambah">Tambah Berita</a></li>
			<li class="icn_edit_article"><a href="<?php echo base_url()?>asisten/berita">Kelola Berita</a></li>
		<?php
		}
		?>
        <h3>Nilai</h3>
        <ul class="toggle">
            <li class="icn_categories"><a href="<?php echo base_url()?>asisten/nilai">Nilai</a></li>
        </ul>
        <h3>Praktikum AI</h3>
        <ul class="toggle">
            <li class="icn_categories"><a href="<?php echo base_url()?>asisten/kelas/ai">Kelas</a></li>
            <li class="icn_view_users"><a href="<?php echo base_url()?>asisten/kelas/ai/praktikan">Praktikan</a></li>
            <li class="icn_categories"><a href="<?php echo base_url()?>asisten/kelas/ai/responsi">Responsi</a></li>
        </ul>
        <h3>Repositori</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="<?php echo base_url()?>asisten/repositori">Data</a></li>
		</ul>
                <h3>Tugas</h3>
		<ul class="toggle">
			<li class="icn_categories"><a href="<?php echo base_url()?>asisten/kelas/tugas">Kelas</a></li>
			<li class="icn_folder"><a href="<?php echo base_url()?>asisten/tugas">Tugas</a></li>
		</ul>
		<h3>Pesan</h3>
		<ul class="toggle">
			<li class="icn_tags"><a href="#">Pesan Masuk</a></li>
		</ul>

		<h3>Pengaturan</h3>
		<ul class="toggle">
			<li class="icn_active"><a href="<?php echo base_url()?>asisten/aktifasi">Aktifasi</a></li>
			<li class="icn_jump_back"><a href="<?php echo base_url()?>asisten/login/logout">Logout</a></li>
		</ul>
		                
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2012  KSC Laboratory</strong></p>
			<p>Script by <strong>Imam S Rifkan</strong><br/>Design by MediaLoot</p>
		</footer>
	</aside>