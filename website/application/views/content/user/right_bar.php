
<div id="cB2" style="width: 200px;">
				
				<div class="about">
                    <h3><a href="<?php echo base_url()?>berita/agenda">AGENDA</a></h3>
					   <ul>
                            <?php
                            if($side_agenda)
                            {
                                foreach($side_agenda as $result)
                                {
                                ?>
                                <li><a href="<?php echo base_url()?>berita/detail/<?php echo $result["berita_title"]?>"><?php echo $result["berita_judul"]?></a></li>
                                <?php
                                }
                            }
                            else
                            {
                                ?>
                                <li>Tidak ada agenda</li>
                                <?php
                            }
                            ?>
					   </ul>
                        <br/>
				<h3><a href="<?php echo base_url()?>berita/praktikum">BERITA TERKINI</a></h3>
					<ul>
                                            <?php
                                            if($side_berita)
                                            {
                                                foreach($side_berita as $result)
                                                {
                                                ?>
                                                <li><a href="<?php echo base_url()?>berita/detail/<?php echo $result["berita_title"]?>"><?php echo $result["berita_judul"]?></a></li>
                                                <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <li>Tidak ada berita</li>
                                                <?php
                                            }
                                            ?>
					</ul>
                                <br/>
				<h3><a href="<?php echo base_url()?>download">DOWNLOAD</a></h3>
					<ul>
                                            <?php
                                            if($side_repo)
                                            {
                                                foreach($side_repo as $result)
                                                {
                                                    ?>
                                                    <li><a href="<?php echo base_url()?>_data/filerepo/<?php echo $result["repo_file"]?>" target="_blank" onclick="update(<?php echo $result["repo_id"]?>)"><?php echo $result["repo_nama"]?></a></li>
                                                    <?php
                                                }
                                            }
                                            else
                                            {
                                                ?>
                                                <li>Tidak ada data</li>
                                                <?php
                                            }
                                            ?>
					</ul>
				</div>
			</div>
<script type="text/javascript">
   function update(id){
       $.post(
            "<?php echo base_url()?>download/lihat/"+id,
            {"id-repo":id}
       );
   }
</script>