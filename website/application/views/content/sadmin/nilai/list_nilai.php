<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Tugas</h3></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead> 
                 <?php
                            if($ta)
                            {
                                $url = $this->uri->segment(4);
                             ?>
                            <div class="list-kelas">
                                <span class="data-kelas">
                                    <?php
                                    foreach($ta as $result)
                                    {
                                        if($url == $result["ta_nama"])
                                        {
                                            $class = "class = 'active'";
                                        }
                                        else
                                        {
                                            $class = "";
                                        }
                                        ?>
                                        <a <?php echo $class?> href="<?php echo base_url()?>superadmin/pbo/nilai/ta/<?php echo $result["ta_nama"]?>"><?php echo $result["ta_nama"]?></a>&nbsp;&nbsp;|
                                        <?php
                                    }
                                    ?>
                                </span>
                                </div>
                             <?php   
                            }
                            ?>
				<tr> 
                                    <th align="center">No</th> 
                                    <th>NIM</th>
                                    <th>Nama</th> 
                                    <th>Tahun Ajaran</th> 
                                    <th>Nilai</th>
                                    <th>Status</th>
                                    <th colspan="2">Aksi</th> 
				</tr> 
			</thead> 
			<tbody>
			</tbody> 
			</table>
                        <footer>
                            <div class="submit_link right-float twenty-right-padding">
                                <!-- <form class="quick_search"> -->
                                    <input type="text" style="width:150px" class="ten-radius" placeholder="Cari" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
                                <!-- </form> -->
                            </div>
                            <div class="submit_link">
                                <input type="submit" id="tambah-nilai" value="Tambah Nilai">
                            </div>
                        </footer>
		</article><!-- end of styles article -->
                <?php
//                $this->load->view("content/sadmin/nilai/right_side");
                ?>
		<div class="spacer"></div>
	</section>
<script type="text/javascript">
$(document).ready(function(){
    $("#tambah-nilai").click(function(){
        window.location.href = "<?php echo base_url()?>superadmin/pbo/nilai/tambah";
    })
})
</script>