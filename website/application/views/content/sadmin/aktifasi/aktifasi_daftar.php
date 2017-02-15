<!--         <article class="module width_3_quarter">
                <header><h3>Aktifasi Kelas ( daftar praktikum AI)</h3></header>
                <table class="tablesorter" cellspacing="0"> 
                <thead> 
                        <tr> 
                            <th align="center">No</th> 
                            <th>Nama Kelas</th> 
                            <th>Tanggal</th> 
                            <th>Jam</th>
                            <th align="center">Kuota</th>
                            <th align="center">Jumlah</th>
                        </tr> 
                </thead> 
                <tbody> 
                   <?php
                   if($kelas_ai)
                   {
                       $no = 1;
                       foreach($kelas_ai as $result)
                       {
                           ?>
                           <tr>
                               <td align="center"><?php echo $no?></td>
                               <td>Kelas <?php echo $result["kelas_nama"]?></td>
                               <td><?php echo $result["kelas_hari"]?>, <?php echo $result["kelas_tanggal"]?></td>
                               <td><?php echo $result["kelas_jam"]?></td>
                               <td align="center"><?php echo $result["kelas_kuota"]?></td>
                               <td align="center">-</td>
                           </tr>
                           <?php
                           $no++;
                       }
                   }
                   else
                   {
                       ?>
                        <tr>
                            <td colspan="6" align="center" class="no-data">Tidak ada data kelas</d>
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
                            foreach($aktifasi as $result)
                            {
                                $status =  $result["kelas_status"];
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
                        }
                        else
                        {
                            $output = "-";
                            $class = "class = ''"; 
                        }
                        ?>
                        <strong>Aktifkan Pendaftaran</strong> &nbsp;<input type="submit" id="aktifasi" <?php echo $class?> value="<?php echo $output?>" title="<?php echo $output?>"/>
                    </div>
                </footer>
        </article><!-- end of styles article -->
        <div class="spacer"></div>
<script type="text/javascript">
    $(document).ready(function(){
       $("#non-aktif").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/aktifasi/tugas_nonaktif"; 
       });
       $("#aktifasi").click(function(){
           var status;
           if($("#aktifasi").val() == "non-aktif"){
               status = "aktif";
           }else{
               status = "non-aktif";
           }
          window.location.href = "<?php echo base_url()?>superadmin/aktifasi/aktifasi_kelas/"+status; 
       });
       
    });

function aktif(id){
    window.location.href = "<?php echo base_url()?>superadmin/aktifasi/aktif/"+id;
}
function nonaktif(id){
    window.location.href = "<?php echo base_url()?>superadmin/aktifasi/nonaktif/"+id;
}

</script> -->