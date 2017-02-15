<section id="main" class="column">    
    <article class="module width_3_quarter">
                <header><h3>Aktifasi Responsi KCB</h3><span>Jadwal aktif : <?php echo $jumlah?> dari <?php echo $total?></span></header>
                <?php
                $url = $this->uri->segment(4);
                ?>
                <div class="list-kelas">
                    <span class="data-kelas">
                        <?php
                        $day = array("senin"=>"senin","selasa"=>"selasa","rabu"=>"rabu","kamis"=>"kamis","jumat"=>"jum'at","sabtu"=>"sabtu","minggu"=>"minggu");
                        foreach($day as $result=>$val)
                        {
                            if($url == $result)
                            {
                                $class = "class='active'";
                            }
                            else
                            {
                                $class = "";
                            }   
                            ?>
                            <a <?php echo $class?> href="<?php echo base_url()?>superadmin/aktifasi/responsi/<?php echo $result?>"><?php echo $val?></a>&nbsp;&nbsp;|
                            <?php
                        }
                        ?>
                </span>
            </div>

                <table class="tablesorter" cellspacing="0"> 
                <thead> 
                        <tr> 
                            <th align="center">No</th> 
                            <th>Hari</th> 
                            <th>Tanggal</th>
                            <th>Jam</th> 
                            <th>Ruang</th>
                            <th align="center">Status</th>
                        </tr> 
                </thead> 
                <tbody> 
                    <?php
                    if($responsi)
                    {
                        $no = 1;
                        foreach($responsi as $result)
                        {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no?></td>
                                <td><?php echo $result["responsi_hari"]?></td>
                                <td><?php echo date("d-M-Y",human_to_unix($result["responsi_tanggal"]))?></td>
                                <td><?php echo $result["responsi_jam"]?></td>
                                <td><?php echo $result["responsi_ruang"]?></td>
                                <?php
                                switch($result["responsi_status_aktif"])
                                {
                                     case "aktif":
                                        $button = "class='button_active'";
                                        $status = "nonaktif";
                                        break;
                                    case "non-aktif":
                                        $button = "class='button_inactive'";
                                        $status = "aktif";
                                        break;
                                    default: $button = "";
                                        break;

                                }
                                ?>
                                <td align="center"><input type="submit" id="status-responsi" <?php echo $button?> value="<?php echo $result["responsi_status_aktif"]?>" title="<?php echo $result["responsi_status_aktif"]?>" onclick="<?php echo $status?>(<?php echo $result["responsi_id"]?>)"></td>
                            </tr>
                            <?php
                            $no++;
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="6" class="no-data" align="center">Tidak ada jadwal yang terdaftar</td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody> 
                </table>
                <footer>
                    <div class="submit_link right-float">
                        <?php
                        if($aktifasi)
                        {
                                $status =  $aktifasi["responsi_status_aktif"];
                                switch ($status) {
                                    case "non-aktif":
                                        $output = "non-aktif";
                                        $class = "class='button_inactive'";
                                        break;
                                    case "aktif":
                                        $output = "aktif";
                                        $class = "class='button_active'";
                                        break;
                                    default :
                                        $output = "-";
                                        $class = "class=''";
                                        break;
                                }
                        }
                        else
                        {
                            $output = "-";
                            $class = "class = ''"; 
                        }
                        ?>
                        <input type="submit" id="aktifasi" <?php echo $class?> value="<?php echo $output?>" title="<?php echo $output?>"/>
                    </div>
                </footer>
        </article><!-- end of styles article -->
        <?php echo $sidebar?>
        <div class="spacer"></div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#aktifasi").click(function(){
        var status;
        if($("#aktifasi").val() == "non-aktif")
        {
            status = "aktif";
        }else{
            status = "non-aktif";
        }
        $.post("<?php echo base_url()?>superadmin/aktifasi/aktifasiResponsi",
            {"status":status},
            function(data){
                if(data){
                    window.location.reload();
                }
            })
       });
       
    });

function aktif(id){
    $.post("<?php echo base_url()?>superadmin/aktifasi/prosesAktifResponsi",
        {"id":id},
        function(data){
            if(data){
                window.location.reload();
            }
        })
}
function nonaktif(id){
    $.post("<?php echo base_url()?>superadmin/aktifasi/prosesNonAktifResponsi",
        {"id":id},
        function(data){
            if(data){
                window.location.reload();
            }
        })
}
</script>






