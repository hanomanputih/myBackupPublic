    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Kelas Praktikum</h3></header>
        <div class="with-padding">
            <input type="hidden" id="id-kelas" value="<?php echo $kelas_ai["kelas_id"]?>">
            <table cellspacing="10" width="500px">
                <tbody>
                    <tr>
                        <td width="75px">Nama Kelas</td><td><input type="text" class="input full" id="nama-kelas" value="<?php echo $kelas_ai["kelas_nama"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Hari</td>
                        <?php
                        $hari = array("Senin"=>"Senin","Selasa"=>"Selasa","Rabu"=>"Rabu","Kamis"=>"Kamis","Jum'at"=>"Jum'at","Sabtu"=>"Sabtu");
                        ?>
                        <td>
                            <select class="select full" id="hari-kelas">
                                <option value="<?php echo $kelas_ai["kelas_hari"]?>"><?php echo $kelas_ai["kelas_hari"]?></option>
                                <?php
                                    foreach($hari as $result => $value)
                                    {
                                        if($result == $kelas_ai["kelas_hari"])
                                        {
                                            continue;
                                        }
                                        else
                                        {
                                            ?>
                                            <option value="<?php echo $result?>"><?php echo $value?></option>
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
                            <select id="tanggal" class="select">
                                <?php
                                $tanggal = substr($kelas_ai["kelas_tanggal"],8,2);
                                ?>
                                <option value="<?php echo $tanggal?>"><?php echo $tanggal?></option>
                                <?php
                                for($i=1; $i<=31; $i++)
                                {
                                    if($i <10)
                                    {
                                        $i = "0".$i;
                                    }
                                    if($i == $tanggal)
                                    {
                                        continue;
                                    }
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select id="bulan" class="select">
                                <?php
                                $bln = substr($kelas_ai["kelas_tanggal"],5,2);
                                $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                ?>
                                <option value="<?php echo $bln?>"><?php echo $bulan[$bln-1]?></option>
                                <?php
                                for($i=1;$i<=12;$i++)
                                {
                                    if($i<10)
                                    {
                                        $i = "0".$i;
                                    }

                                    if($i == $bln)
                                    {
                                        continue;
                                    }
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $bulan[$i-1]?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select id="tahun" class="select">
                                <?php
                                $thn = substr($kelas_ai["kelas_tanggal"],0,4);
                                ?>
                                <option value="<?php echo $thn?>"><?php echo $thn?></option>
                                <?php
                                for($i=12;$i<=20;$i++)
                                {
                                    $thn = substr($thn,2,2);
                                    if($i == $thn)
                                    {
                                        continue;
                                    }
                                    ?>
                                <option value="20<?php echo $i?>">20<?php echo $i?></option>
                                    <?php
                                }
                                ?>
                            </option>
                        </td>
                    </tr>
                    <tr>
                        <td>Jam</td><td><input type="text" class="input full" id="jam-kelas" value="<?php echo $kelas_ai["kelas_jam"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td><td><input type="text" class="input full" id="keterangan-kelas" value="<?php echo $kelas_ai["kelas_keterangan"]?>"></td>
                    </tr>
                    <tr>
                        <td>Kuota</td><td><input type="text" class="input full" id="kuota-kelas" value="<?php echo $kelas_ai["kelas_kuota"]?>"/></td>
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
                <input type="submit" id="list-kelas" value="List Kelas"/>
            </div>
        </footer>
    </article>
</section>

<script type="text/javascript">
    $(document).ready(function(){
       $("#list-kelas").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/kcb/praktikum";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/praktikum"; 
       });
       
       $("#simpan").click(function(){
            displayLoading("Harap tunggu ...");
            var tanggal = $("#tahun").val()+"-"+$("#bulan").val()+"-"+$("#tanggal").val();
            $.post(
                "<?php echo base_url()?>superadmin/kcb/proses_edit_kelas",
                {"id_kelas":$("#id-kelas").val(),"nama_kelas":$("#nama-kelas").val(),"hari_kelas":$("#hari-kelas").val(),"tanggal_kelas":tanggal,"jam_kelas":$("#jam-kelas").val(),"keterangan_kelas":$("#keterangan-kelas").val(),"kuota_kelas":$("#kuota-kelas").val()},
                function(data){
                   if(data == 1){
                        displayMessage("alert_success","Kelas berhasil diubah");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Kelas sudah tersedia");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else{
                        displayMessage("alert_error","Kelas gagal diubah");
                    }
                }
            ) 
       });
    });
</script>