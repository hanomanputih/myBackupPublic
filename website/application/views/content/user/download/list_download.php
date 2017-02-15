<div id="cB1">
	<h3><a href="<?php echo base_url().uri_String()?>"><?php echo uri_string()?></a></h3>
	<div class="main-content">
		<div class="news">
            <h4 class="title">Materi</h4>
                            <?php
                            if($repo)
                            {
                                $no = 1;
                                foreach($repo as $result)
                                {
                                    ?>
                                    <p><?php echo $no?>. <a href="<?php echo base_url()?>_data/filerepo/<?php echo $result["repo_file"]?>" target="_blank"><?php echo $result["repo_nama"]?></a></p>
                                    <?php
                                    $no++;
                                }
                            }
                            else
                            {
                                ?>
                                 <p class="no-data" style="text-align: center">Tidak ada data untuk didownload</p>
                                <?php
                            }
                            ?>
                                 <?php
                                 if($repo)
                                 {
                                     ?>
                                     <span class="right-float views"><small>Terakhir diperbarui (<?php echo date("D, d-M-Y",  human_to_unix($latest["repo_tanggal"]))?>)</small></span>
                                     <?php
                                 }
                                 ?>
                                 
		</div>
        <!-- <div class="news">
            <h4 class="title">Source Code</h4>
        </div> -->
	</div>
</div>