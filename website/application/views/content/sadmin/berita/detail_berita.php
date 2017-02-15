<section id="main" class="column">
        <article class="module width_full">
            <header><h3>Detail Berita</h3></header>
            <?php
            if($berita)
            {
                ?>
                <h3><?php echo $berita["berita_judul"]?></h3>
                <div class="with-padding">
                <small><?php echo date("d-M-Y h:i A",human_to_unix($berita["berita_tanggal"]))?></small>
                <?php
                if($berita["berita_file"])
                {
                    if($berita["berita_tipe_file"] == ".jpg" OR $berita["berita_tipe_file"] == ".jpeg" OR $berita["berita_tipe_file"] == ".png")
                    {
                        ?>
                        <p>
                              <a href="<?php echo base_url()?>_data/fileberita/<?php echo $berita["berita_file"]?>" target="_blank"><img src="<?php echo base_url()?>_data/fileberita/<?php echo $berita["berita_file"]?>" width="320px"></a>
                            <?php echo $berita["berita_isi"]?>
                        </p>
                        <?php
                    }
                    else
                    {
                        ?>
                        <p>
                            <?php echo $berita["berita_isi"]?><br/>
                            File : <a href="<?php echo base_url()?>_data/fileberita/<?php echo $berita["berita_file"]?>" target="_blank"><?php echo $berita["berita_judul_file"]?></a>
                        </p>
                        <?php
                    }
                }
                else
                {
                    ?>
                    <p><?php echo $berita["berita_isi"]?></p>
                    <?php
                }
                    
                ?>
            </div>
                <?php
            }
            else
            {
                ?>
                    <h3 class="red-color">Berita tidak ditemukan</h3>
                <?php
            }
            ?>
            
        <footer>
            <div class="submit_link">
                <input type="submit" id="list-berita" value="List Berita"/>
            </div>
        </footer>
                        
        </article><!-- end of styles article -->
                <div class="spacer"></div>
    </section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#list-berita").click(function(){
            window.location.href = "<?php echo base_url()?>superadmin/berita";
        })
    })
    function edit(id){
        window.location.href = "<?php echo base_url()?>superadmin/berita/edit/"+id;
    }
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin ingin menghapus berita ini?");
        if(conf){
            window.location.href = "<?php echo base_url()?>superadmin/berita/hapus/"+id;
        }
    }
</script>
