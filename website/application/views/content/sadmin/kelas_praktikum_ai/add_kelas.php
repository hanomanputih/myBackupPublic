    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Kelas Praktikum</h3></header>
        <div class="with-padding">
            <table cellspacing="10" width="500px">
                <tbody>
                    <tr>
                        <td width="75px">Nama Kelas</td><td><input type="text" class="input full" id="nama-kelas"/></td>
                    </tr>
                    <tr>
                        <td>Hari</td>
                        <?php
                        $hari = array("Senin"=>"Senin","Selasa"=>"Selasa","Rabu"=>"Rabu","Kamis"=>"Kamis","Jum'at"=>"Jum'at","Sabtu"=>"Sabtu");
                        ?>
                        <td>
                            <select class="select full" id="hari-kelas">
                                <option value="">-pilih-</option>
                                <?php
                                foreach($hari as $result=>$value)
                                {
                                    ?>
                                    <option value="<?php echo $result?>"><?php echo $value?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Tanggal</td>
                        <td>
                            <select id="tanggal" class="select">
                                <option value="">-tanggal-</option>
                                <?php
                                for($i=1; $i<=31; $i++)
                                {
                                    if($i<10)
                                    {
                                        $i = "0".$i;
                                    }
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $i?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select id="bulan" class="select">
                                <option value="">-bulan-</option>
                                <?php
                                $bulan = array("Januari","Februari","Maret","April","Mei","Juni","Juli","Agustus","September","Oktober","November","Desember");
                                for($i=1;$i<=12;$i++)
                                {
                                    if($i<10)
                                    {
                                        $i = "0".$i;
                                    }
                                    ?>
                                    <option value="<?php echo $i?>"><?php echo $bulan[$i-1]?></option>
                                    <?php
                                }
                                ?>
                            </select>
                            <select id="tahun" class="select">
                                <option value="">-tahun-</option>
                                <?php
                                for($i=12;$i<=20;$i++)
                                {
                                    ?>
                                <option value="20<?php echo $i?>">20<?php echo $i?></option>
                                    <?php
                                }
                                ?>
                            </option>
                        </td>
                    </tr>
                    <tr>
                        <td>Jam</td><td><input type="text" class="input full" id="jam-kelas"/></td>
                    </tr>
                    <tr>
                        <td>Keterangan</td><td><input type="text" class="input full" id="keterangan-kelas"></td>
                    </tr>
                    <tr>
                        <td>Kuota</td><td><input type="text" class="input full" id="kuota-kelas"/></td>
                    </tr>
                    <tr>
                        <td></td>
                        <td>
                            <input type="submit" value="Tambah" id="tambah" class="alt_btn"/>
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
       
       $("#tambah").click(function(){
            displayLoading("Harap tunggu ...");  
           
            var tanggal = $("#tahun").val()+"-"+$("#bulan").val()+"-"+$("#tanggal").val();
          $.post(
                "<?php echo base_url()?>superadmin/kcb/proses_tambah_kelas",
                {"nama_kelas":$("#nama-kelas").val(),"hari_kelas":$("#hari-kelas").val(),"tanggal_kelas":tanggal,"jam_kelas":$("#jam-kelas").val(),"kuota_kelas":$("#kuota-kelas").val(),"keterangan_kelas":$("#keterangan-kelas").val()},
                function(data){
                    if(data == 1){
                        displayMessage("alert_success","Kelas berhasil ditambahkan");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Kelas sudah tersedia");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else if(data == "not-number"){
                        displayMessage("alert_error","Kolom kuota harus berisi angka");
                    }else{
                        displayMessage("alert_error","Kelas gagal ditambahkan");
                    }
                }
            ) 
       });
    });
</script>