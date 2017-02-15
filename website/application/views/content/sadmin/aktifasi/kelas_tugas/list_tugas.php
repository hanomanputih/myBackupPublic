<section id="main" class="column">    
    <article class="module width_3_quarter">
                <header><h3>Aktifasi Kelas ( upload tugas )</h3></header>
                <table class="tablesorter" cellspacing="0"> 
                <thead> 
                        <tr> 
                            <th align="center">No</th> 
                            <th>Nama Kelas</th> 
                            <th>Keterangan</th> 
                            <th align="center">Status</th>
                        </tr> 
                </thead> 
                <tbody> 
                    <?php
                    if($kelas_tugas)
                    {
                        $no = 1;
                        foreach($kelas_tugas as $result)
                        {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no?></td>
                                <td>Kelas <?php echo $result["kelas_nama"]?></td>
                                <td><?php echo $result["kelas_keterangan"]?></td>
                                <?php
                                    switch ($result["kelas_status"])
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
                            <td align="center"><input type="submit" id="status-kelas" <?php echo $button?> value="<?php echo $result["kelas_status"]?>" title="<?php echo $result["kelas_status"]?>" onclick="<?php echo $status?>(<?php echo $result["kelas_id"]?>)"></td>
                        </tr>
                        <?php
                        $no++;
                        }
                    }
                    else
                    {
                        ?>
                        <tr>
                            <td colspan="4" align="center"><span class="no-data">Tidak ada kelas yang terdaftar</span></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody> 
                </table>
                <footer>
                    <div class="submit_link right-float">
                        <?php
                        if($kelas_tugas)
                        {
                            ?>
                            <input type="submit" id="non-aktif-tugas" value="Non-aktif" title="Non-aktif" class="button_inactive"/>
                            <?php
                        }
                        ?>
                        
                    </div>
                </footer>
        </article><!-- end of styles article -->
        <?php echo $sidebar?>
        <div class="spacer"></div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#non-aktif-tugas").click(function(){
          $.post("<?php echo base_url()?>superadmin/aktifasi/nonAktifTugas",
            function(data){
                if(data){
                    window.location.reload();
                }
            })
       });
    });

function aktif(id){
    $.post("<?php echo base_url()?>superadmin/aktifasi/prosesAktifTugas",
        {"id":id},
        function(data){
            if(data){
                window.location.reload();
            }
        })
}
function nonaktif(id){
    $.post("<?php echo base_url()?>superadmin/aktifasi/prosesNonAktifTugas",
        {"id":id},
        function(data){
            if(data){
                window.location.reload();
            }
        })
}

</script>






