<section id="main" class="column">
     
        <article class="module width_3_quarter">
        <header><h3>Statistik Praktikum TA <?php echo $this->session->userdata("ta_nama")?></h3></header>
        <div class="horison-padding">
              <table class="horison-padding list-table">
                   <tr>
                       <td><strong>Jumlah Asisten</strong></td><td><?php echo $asisten_jumlah;?> orang</td>
                   </tr>
                   <tr>
                       <td><strong>Jumlah Pertemuan</strong></td><td><?php echo $pbo_pertemuan;?> pertemuan</td>
                   </tr>
                   <tr>
                       <td><strong>Jumlah Kelas PBO</strong></td><td><?php echo $pbo_kelas?> kelas</td>
                   </tr>
                   <tr>
                       <td><strong>Jumlah Praktikan PBO</strong></td><td><?php echo $pbo_praktikan?> orang</td>
                   </tr>
                   <tr>
                       <td><strong>Jumlah Kelas KCB</strong></td><td><?php echo $kcb_kelas?> kelas</td>
                   </tr>
                   <tr>
                       <td><strong>Jumlah Mahasiswa KCB</strong></td><td><?php echo $kcb_mahasiswa?> orang</td>
                   </tr>
                   <tr>
                       <td><strong>Jumlah Praktikan KCB</strong></td><td><?php echo $kcb_praktikan?> orang</td>
                   </tr>
                </table>
        </div>
    </article>
    <?php
    if($this->session->userdata("ta_status") == "active")
    {
    ?>
   <div class="clear"></div>
   <article class="module width_quarter">
      <header><h3>Status</h3></header>
      <div class="horison-padding">
          <table class="list-table">
                    <tr>
                        <td><strong>Kelas</strong></td>
                        <td><?php
                            if($kelas_pbo)
                            {
                                echo "<span class='green'>Kelas ".$kelas_pbo["kelas_nama"]."</span>";
                            }
                            else
                            {
                                echo "<span class='red'>Tidak ada</span>";
                            }
                        ?></td>
                    </tr>
                    <tr>
                        <td><strong>Modul Pertemuan</strong></td>
                        <td>
                            <?php
                            if($modul)
                            {
                                echo "<span class='green'>Modul : ".$modul["modul_nama"]."</span>";
                            }
                            else
                            {
                                echo "<span class='red'>Tidak ada</span>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Daftar Praktikum KCB</strong></td>
                        <td>
                            <?php
                            if($prkcb)
                            {
                                foreach($prkcb as $result)
                                {
                                    $status = true;
                                }
                                if($status)
                                {
                                    echo "<span class='green'>Aktif</span>";
                                }
                            }
                            else
                            {
                                echo "<span class='red'>Tidak ada</span>";
                            }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <td><strong>Daftar Responsi Praktikum KCB</td>
                        <td>
                            <?php
                            if($responsi)
                            {
                                    echo "<span class='green'>Aktif</span>";
                            }
                            else
                            {
                                echo "<span class='red'>Tidak ada</span>";
                            }
                            ?>
                        </td>
                    </tr>
                </table>
      </div>
    </article>
    <?php
    }
    $this->load->view("content/asisten/dashboard/dashboard_pesan");
    ?>

    
    
    
</section>