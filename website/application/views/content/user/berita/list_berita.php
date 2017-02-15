<div id="cB1">
        <?php
        if($berita)
        {
            switch ($berita_kategori) {
                case "pengumuman":
                    $link = "berita/praktikum";
                    break;
                default:
                    $link = $berita_kategori;
                    break;
            }
            ?>
            <h3><a href="<?php echo base_url().$link?>"><?php echo $berita_kategori?></a></h3>
            <?php
        }
        else
        {
            ?>
            <h3 class="red-color">Berita tidak ditemukan</h3>
            <?php
        }
        ?>
        
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
        ?>
        <p class="pagination">
            <?php
            echo $this->pagination->create_links();
            ?>
        </p>
        </div>
</div>
<style type="text/css">
    .frame{
        width: 100px;
        height: 100px;
        border: 1px solid black;
        float: left;
        margin-right: 5px;
        background: none;
    }
</style>
