    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Jadwal Responsi</h3></header>
        <div class="with-padding">
            <table cellspacing="10" width="500px" border="0">
                <tbody>
                    <input type="hidden" id="id-responsi" value="<?php echo $responsi["responsi_id"]?>"/>
                    <tr>
                        <td width="75px">Hari Responsi</td>
                        <td>
                            <select class="select" id="hari-responsi">
                                <option value="<?php echo $responsi["responsi_hari"]?>"><?php echo $responsi["responsi_hari"]?></option>
                                <?php
                                $hari = array("Senin","Selasa","Rabu","Kamis","Jumat");
                                foreach($hari as $result)
                                {
                                    if($result != $responsi["responsi_hari"])
                                    {
                                    ?>
                                        <option value="<?php echo $result?>"><?php echo $result?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>
                            <select class="select" id="tanggal-responsi">
                                <option value="<?php echo substr($responsi["responsi_tanggal"],8,2)?>"><?php echo substr($responsi["responsi_tanggal"],8,2)?></option>
                                <?php
                                for($i=1;$i<=31;$i++)
                                {
                                    if($i != substr($responsi["responsi_tanggal"],8,2))
                                    {
                                        if($i < 10)
                                        {
                                        $i = "0".$i;
                                        }
                                    ?>
                                        <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php    
                                    }
                                    
                                }
                                ?>
                            </select>
                            <select class="select" id="bulan-responsi">
                                <?php
                                $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                ?>
                                <option value="<?php echo substr($responsi["responsi_tanggal"],5,2)?>"><?php echo $bulan[substr($responsi["responsi_tanggal"],5,2)-1]?></option>
                                <?php
                                for($i=1;$i<=12;$i++)
                                {
                                    if($i != substr($responsi["responsi_tanggal"], 5, 2))
                                    {
                                        if($i < 10)
                                        {
                                            $i = "0".$i;
                                        }
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $bulan[$i-1]?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                            <select class="select" id="tahun-responsi">
                                <option value="<?php echo substr($responsi["responsi_tanggal"],0,4)?>"><?php echo substr($responsi["responsi_tanggal"],0,4)?></option>
                                <?php
                                for($i=12;$i<=20;$i++)
                                {
                                    if("20".$i != substr($responsi["responsi_tanggal"],0,4))
                                    {
                                    ?>
                                    <option value="20<?php echo $i?>">20<?php echo $i?></option>
                                    <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jam</td><td><input type="text" class="input full" id="jam-responsi" placeholder="xx:xx-xx:xx" value="<?php echo $responsi["responsi_jam"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td><td><input type="text" class="input full" id="ruang-responsi" placeholder="Ruang responsi" value="<?php echo $responsi["responsi_ruang"]?>"></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Simpan" id="simpan" class="alt_btn"/>
                            <input type="submit" value="Batal" id="batal"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" id="list-responsi" value="List Daftar Responsi"/>
            </div>
        </footer>
    </article>
    <?php echo $sidebar?>
    <div class="spacer"></div>
</section>

<script type="text/javascript">
    $(document).ready(function(){
       $("#list-responsi").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/pengaturan/responsi";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/pengaturan/responsi"; 
       });
       
       $("#simpan").click(function(){
        displayLoading("Harap tunggu ...");
          $.post(
                "<?php echo base_url()?>superadmin/pengaturan/proses_edit_responsi",
                {"id_responsi":$("#id-responsi").val(),"hari_responsi":$("#hari-responsi").val(),"tanggal_responsi":$("#tanggal-responsi").val(),"bulan_responsi":$("#bulan-responsi").val(),"tahun_responsi":$("#tahun-responsi").val(),"jam_responsi":$("#jam-responsi").val(),"ruang_responsi":$("#ruang-responsi").val()},
                function(data){
                     if(data == 1){
                        displayMessage("alert_success","Jadwal responsi berhasil diubah");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Jadwal responsi sudah tersedia");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else{
                        displayMessage("alert_error","Jadwal responsi gagal ditambahkan");
                 }
                }
            ) 
       });
    });
</script>