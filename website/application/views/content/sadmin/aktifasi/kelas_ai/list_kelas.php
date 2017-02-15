<section id="main" class="column">     
    <article class="module width_3_quarter">
                <header><h3>Aktifasi Kelas ( daftar praktikum KCB)</h3></header>
                <div class="list-kelas">
                        <span class="data-kelas">
                 <?php
                 $url = $this->uri->segment(4);
                        $day = array("senin"=>"senin","selasa"=>"selasa","rabu"=>"rabu","kamis"=>"kamis","jum'at"=>"jumat","sabtu"=>"sabtu","minggu"=>"minggu");
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
                            <a href="<?php echo base_url()?>superadmin/aktifasi/kelas/<?php echo $val?>"><?php echo $result?></a>&nbsp;&nbsp;|
                            <?php
                        }
                        ?>
                          </span>
                    </div>
                <table class="tablesorter" cellspacing="0"> 
                <thead> 
                        <tr> 
                            <th align="center">No</th> 
                            <th>Nama Kelas</th> 
                            <th>Tanggal</th> 
                            <th>Jam</th>
                            <th align="center">Kuota</th>
                            <th align="center">Jumlahd</th>
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
                               <td align="center">
                                  <?php
                                  $data = $total->getCountUserDaftarById($result["kelas_id"]);
                                  if($data)
                                  {
                                    ?>
                                    <a href="<?php echo base_url()?>superadmin/kcb/praktikan/<?php echo $result["kelas_nama"]?>"><?php echo $data["jumlah"]?></a>
                                    <?php
                                  }
                                  else
                                  {
                                      ?>
                                      <a href="<?php echo base_url()?>superadmin/kcb/praktikan/<?php echo $result["kelas_nama"]?>">0</a>
                                      <?php
                                  }
                                  ?>
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
                                $status =  $aktifasi["kelas_status"];
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
                        <strong>Aktifkan Pendaftaran</strong> &nbsp;<input type="submit" id="aktifasi" <?php echo $class?> value="<?php echo $output?>" title="<?php echo $output?>"/>
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
           if($("#aktifasi").val() == "non-aktif"){
               status = "aktif";
           }else{
               status = "non-aktif";
           }
           $.post("<?php echo base_url()?>superadmin/aktifasi/aktifasiKelasPraktikumKcb",
            {"status":status},
            function(data){
              if(data){
                window.location.reload();
              }
            })
       });
    });
</script>