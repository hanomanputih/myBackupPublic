<div id="cB1">
        <?php
        if($berita)
        {
           switch ($berita["berita_kategori"]) {
                case "pengumuman":
                    $link = "berita/praktikum";
                    break;
                default:
                    $link = $berita["berita_kategori"];
                    break;
            }
            ?>
            <h3><a href="<?php echo base_url().$link?>"><?php echo $berita["berita_kategori"]?></a></h3>
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
                ?>
            <div class="news">
                <h4 class="title"><a href="<?php echo base_url()?>berita/detail/<?php echo $berita["berita_title"]?>"><?php echo $berita["berita_judul"]?></a></h4>
                <small class="date">
                    <?php echo date("D, d-M-Y",  human_to_unix($berita["berita_tanggal"]));?> <?php echo date("h:i A", human_to_unix($berita["berita_tanggal"]))?>
                </small>
                <p>
                    <div class="scroll width-480">
                    <?php
                    if($berita["berita_file"])
                    {
                        if($berita["berita_tipe_file"] == ".jpg" OR $berita["berita_tipe_file"] == ".jpeg" OR $berita["berita_tipe_file"] == ".png")
                        {
                            ?>
                            <a href="<?php echo base_url()?>_data/fileberita/<?php echo $berita["berita_file"]?>" target="_blank"><img class="image" src="<?php echo base_url()?>_data/fileberita/<?php echo $berita["berita_file"]?>" width="450px" title="<?php echo $berita["berita_judul_file"]?>" title="<?php echo $berita["berita_judul"]?>"></a>
                            <?php
                            echo $berita["berita_isi"];
                        }
                        else
                        {
                            echo $berita["berita_isi"];
                            ?>
                            <br/>File : <a href="<?php echo base_url()?>_data/fileberita/<?php echo $berita["berita_file"]?>" target="_blank"><?php echo $berita["berita_judul_file"]?></a>
                            <?php
                        }
                        ?>
                        
                        <?php
                    }
                    else
                    {
                        echo $berita["berita_isi"];
                    }
                    ?>
                </div>
                    <div class="left-float">
                        
                            <a href="https://twitter.com/share" class="twitter-share-button" data-via="kscUII">Tweet</a>
                            <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0];if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src="//platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document,"script","twitter-wjs");</script>
                        
                        <div class="fb-like" data-href="<?php echo base_url().uri_string()?>" data-send="true" data-layout="button_count" data-width="300" data-show-faces="true" data-action="recommend"></div>
                    </div>
                    <span class="right-float views"><small><?php echo $berita["berita_lihat"]?> views</small></span>
                </p>
                
            </div>
                <?php
            }
                ?>
        </div>
</div>
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/id_ID/all.js#xfbml=1&appId=318107314950798";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>
<style type="text/css">
    .fb-like{
        margin-left: -20px;
    }
</style>
