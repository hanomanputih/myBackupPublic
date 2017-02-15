<section id="main" class="column">     
    <article class="module width_3_quarter">
                <header><h3>Aktifasi Tahun Ajaran</h3></header>
                <table class="tablesorter" cellspacing="0"> 
                <thead> 
                        <tr> 
                            <th align="center">No</th> 
                            <th>Tahun Ajaran</th> 
                            <th align="center">Status</th>
                        </tr> 
                </thead> 
                <tbody> 
                   <?php
                   if($ta)
                   {
                       $no = 1;
                       foreach($ta as $result)
                       {
                           ?>
                           <tr>
                               <td align="center"><?php echo $no?></td>
                               <td>PBO <?php echo $result["ta_nama"]?></td>
                               <td align="center">
                                   <?php
                                   switch($result["ta_status"])
                                   {
                                       case "active":
                                           $button = "class='button_active'";
                                           $status = "aktif";
                                           break;
                                       case "inactive":
                                           $button = "class='button_inactive'";
                                           $status = "nonaktif";
                                           break;
                                       default :
                                           $button = "";
                                           $status = "";
                                           break;
                                   }
                                   ?>
                                   <input type="submit" id="status-kelas" <?php echo $button?> value="<?php echo $status?>" title="<?php echo $result["ta_status"]?>" onclick="<?php echo $status?>(<?php echo $result["ta_id"]?>)">
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
                    
                </footer>
        </article><!-- end of styles article -->
        <?php // echo $sidebar?>
        <div class="spacer"></div>
</section>
<script type="text/javascript">
    function nonaktif(id){
      $.post("<?php echo base_url()?>superadmin/menu/aktifasita",
        {"id":id},
        function(data){
          if(data){
            window.location.reload();
          }
        },'json')
    }
</script>