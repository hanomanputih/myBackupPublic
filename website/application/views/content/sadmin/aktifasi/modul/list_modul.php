<section id="main" class="column">     
    <article class="module width_3_quarter">
                <header><h3>Aktifasi Modul</h3></header>
                <table class="tablesorter" cellspacing="0"> 
                <thead> 
                        <tr> 
                            <th align="center">No</th> 
                            <th>Pertemuan</th> 
                            <th>Modul Judul</th> 
                            <th align="center">Status</th>
                        </tr> 
                </thead> 
                <tbody> 
                   <?php
                   if($modul)
                   {
                       $no = 1;
                       foreach($modul as $result)
                       {
                           ?>
                           <tr>
                               <td align="center"><?php echo $no?></td>
                               <td>Pertemuan <?php echo $result["modul_pertemuan"]?></td>
                               <td><?php echo $result["modul_nama"]?></td>
                               <td align="center">
                                   <?php
                                   switch($result["modul_status"])
                                   {
                                       case "aktif":
                                           $button = "class='button_active'";
                                           $status = "nonaktif";
                                           break;
                                       case "non-aktif":
                                           $button = "class='button_inactive'";
                                           $status = "aktif";
                                           break;
                                       default :
                                           $button = "";
                                           break;
                                   }
                                   ?>
                                   <input type="submit" id="status-kelas" <?php echo $button?> value="<?php echo $result["modul_status"]?>" title="<?php echo $result["modul_status"]?>" onclick="<?php echo $status?>(<?php echo $result["modul_id"]?>)">
                               </td>
                           </tr>
                           <?php
                           $no++;
                       }
                   }
                   else
                   {
                       ?>
                        <tr>
                            <td colspan="4" align="center" class="no-data">Tidak ada data kelas</d>
                        </tr>
                       <?php
                   }
                   ?>
                </tbody> 
                </table>
                <footer>
                    <div class="submit_link right-float">
                        <?php
                        if($modul)
                        {
                            ?>
                            <input type="submit" id="non-aktif-modul" value="Non-aktif" title="Non-aktif" class="button_inactive"/>
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
       $("#non-aktif-modul").click(function(){
          $.post("<?php echo base_url()?>superadmin/aktifasi/nonAktifModul",
            function(data){
              if(data){
                window.location.reload();
              }
            })  
       });
    });
    function aktif(id){
      $.post("<?php echo base_url()?>superadmin/aktifasi/prosesAktifModul",
        {"id":id},
        function(data){
          if(data){
            window.location.reload();
          }
        })
    }
    function nonaktif(id){
      $.post("<?php echo base_url()?>superadmin/aktifasi/prosesNonAktifModul",
        {"id":id},
        function(data){
          if(data){
            window.location.reload();
          }
        })
    }
</script>