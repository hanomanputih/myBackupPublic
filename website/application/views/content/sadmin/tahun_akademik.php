<aside id="sidebar" class="column">
<!--		<form class="quick_search">
			<input type="text" value="Quick Search" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
		</form>
		<hr/>-->

        <h3>Tahun Aktif Akademik</h3>
		<ul class="toggle">
			<?php
			if($ta_active)
			{
				foreach($ta_active as $result)
				{
					?>
					<li class="icn_categories"><a href="#<?php echo $result["ta_id"]?>">PBO <?php echo $result["ta_nama"]?></a></li>
					<?php
				}
			}
			else
			{
				?>
				<li class="no-data"><a href="#">TIDAK ADA</a></li>
				<?php	
			}
			?>
		</ul>

		<h3>Tahun Akademik</h3>
		<ul class="toggle">
			<?php
			if($ta_inactive)
			{
				foreach($ta_inactive as $result)
				{
					?>
					<li class="icn_categories"><a href="#<?php echo $result["ta_id"]?>">PBO <?php echo $result["ta_nama"]?></a></li>
					<?php
				}
			}
			else
			{
				?>
				<li class="no-data"><a href="#">TIDAK ADA</a></li>
				<?php
			}
			?>
		</ul>

		<h3>Pengaturan</h3>
		<ul class="toggle">
                        <li class="icn_active"><a href="<?php echo base_url()?>superadmin/menu/aktifasi">Aktifasi</a></li>
			<li class="icn_profile"><a href="<?php echo base_url()?>superadmin/menu/akun">Akun</a></li>
			<li class="icn_categories"><a href="<?php echo base_url()?>superadmin/menu/ta">Tahun Akademik</a></li>
			<li class="icn_jump_back"><a href="<?php echo base_url()?>superadmin/login/logout">Logout</a></li>
		</ul>
                
		                
		<footer>
			<hr />
			<p><strong>Copyright &copy; 2012  KSC Laboratory</strong></p>
			<p>Script by <strong>Imam S Rifkan</strong><br/>Design by MediaLoot</p>
		</footer>
	</aside>
<script type="text/javascript">
    $(document).ready(function(){
        $("a").click(function(){
            var href = $(this).attr("href");
            var id = href[1];
            window.location.reload();
            window.location.href = "<?php echo base_url()?>superadmin/home/ta/"+id;
        })
    })
</script>