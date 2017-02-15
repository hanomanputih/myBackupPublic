<div id="cB1">
        <h3>Beranda</h3>
        <div class="main-content">
        <?php
        if($berita)
        {
            foreach($berita as $result)
            {
                ?>
            <div class="news">
                <h4 class="title"><a href="<?php echo base_url()?>berita/detail/<?php echo $result["berita_title"]?>"><?php echo $result["berita_judul"]?></a></h4>
                <small class="date">
                    <?php echo date("D, d-M-Y",  human_to_unix($result["berita_tanggal"]));?> <?php echo date("h:i A", human_to_unix($result["berita_tanggal"]))?>
                </small>
                <p>
                    <?php
                    $word =  str_word_count($result["berita_isi"]);
                    if($word <= 100)
                    {
                        echo $result["berita_isi"];
                        ?>
                        <a href="<?php echo base_url()?>berita/detail/<?php echo $result["berita_title"]?>">.. selengkapnya</a>
                        <?php
                    }
                    else
                    {
                        $jumlah =  explode(" ", $result["berita_isi"]);
                        for($i = 0;$i <= 100; $i++)
                        {
                            echo $jumlah[$i]." ";
                        }
                        ?>
                        <a href="<?php echo base_url()?>berita/detail/<?php echo $result["berita_title"]?>">.. selengkapnya</a>
                        <?php
                    }
                    ?>
                </p>
                <div class="left-float">
                    <!-- <span class="right-float views"><small><?php echo $result["berita_lihat"]?> views</small></span> -->
                </div>
            </div>
                <?php
            }
            
        }
        else
        {
            ?>
                <p class="no-class" style="border-bottom: 1px dotted gray">Tidak ada berita</p>
            <?php
        }
        ?>
        </div>
</div>

