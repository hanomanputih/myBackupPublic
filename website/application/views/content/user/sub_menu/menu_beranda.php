<h3>Info Praktikum</h3>
<ul class="sub-menu">
	<li id="pengumuman" ><a>Pengumuman</a></li>
	<ul id="sub-pengumuman" class="sub-sub-menu">
		<li><a href="<?php echo base_url()?>berita/praktikum/pbo">Praktikum PBO</a></li>
		<li><a href="<?php echo base_url()?>berita/praktikum/kcb">Praktikum KCB</a></li>
	</ul>
	<li id="agenda"><a>Agenda</a></li>
	<ul id="sub-agenda" class="sub-sub-menu">
		<li><a href="<?php echo base_url()?>berita/agenda/pbo">Praktikum PBO</a></li>
		<li><a href="<?php echo base_url()?>berita/agenda/kcb">Praktikum KSC</a></li>
	</ul>
	<li><a href="<?php echo base_url()?>download">Download</a></li>
</ul>

<script type="text/javascript">
	$(document).ready(function(){
		$(".sub-sub-menu").hide();
		$("#pengumuman").click(function(){
			$("#sub-pengumuman").slideToggle(100);
		});
		$("#agenda").click(function(){
			$("#sub-agenda").slideToggle(100);
		});
	})
</script>