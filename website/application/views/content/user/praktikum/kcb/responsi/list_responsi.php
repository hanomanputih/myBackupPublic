<div id="cB1" style="width:600px;">
        <h3 style="width:680px">DAFTAR RESPONSI</h3>
        <div class="main-content" style="width:690px">
            <div style="margin-bottom: 10px;">
                <div class="content">
                   
                <?php
                if($kelas_responsi)
                {
                    ?>
                    <div class="scroll">
                    <table class="list-table" style="width:680px;" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center">No</th>
                                <th>Kelompok</th>
                                <th>Tanggal</th>
                                <th align="center">Jam</th>
                                <th align="center">Pilih</th>
                                <th align="center">NIM</th>
                                <th align="center">Nama</th>
                                <th>Ket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $jumlah;
                            foreach($kelas_responsi as $result)
                            {                                            
                                if($no%2 == 0)
                                {
                                    ?>
                                     <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td>
                                            Kelompok <?php echo $result["responsi_id"]?>
                                        </td>
                                        <td><?php echo $result["responsi_hari"]?>,<br/> <?php echo date("d-M-Y",human_to_unix($result["responsi_tanggal"]))?></td>
                                        <td align="center"><?php echo $result["responsi_jam"]?></td>
                                        <td align="center"><input name="pilih" href="#login-box" class="pilih login-window" type="radio" <?php if($result["responsi_status"] == "ya"){echo "disabled";}?> <?php if($result["responsi_status_aktif"] == "non-aktif"){echo "disabled";}?> value="<?php echo $result["responsi_id"]?>"></td>
                                        <td align="center">
                                            <?php
                                            $data = $data_responsi->getDataResponsiByJadwal($result["responsi_id"]);
                                            if($data)
                                            {
                                                foreach($data as $row)
                                                {
                                                    echo $row["praktikan_nim"]."<br/>";
                                                }
                                            }
                                            else
                                            {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                             <?php
                                            $data = $data_responsi->getDataResponsiByJadwal($result["responsi_id"]);
                                            if($data)
                                            {
                                                foreach($data as $row)
                                                {
                                                    echo $row["praktikan_nama"]."<br/>";
                                                }
                                            }
                                            else
                                            {
                                                echo "<p style='text-align:center'>-</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>Ruang <?php echo $result["responsi_ruang"]?></td>
                                    </tr>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <tr class="white">
                                        <td align="center"><?php echo $no?></td>
                                        <td>
                                            Kelompok <?php echo $result["responsi_id"]?>
                                        </td>
                                        <td><?php echo $result["responsi_hari"]?>,<br/> <?php echo date("d-M-Y",human_to_unix($result["responsi_tanggal"]))?></td>
                                        <td align="center"><?php echo $result["responsi_jam"]?></td>
                                        <td align="center"><input name="pilih" href="#login-box" class="pilih login-window" type="radio" <?php if($result["responsi_status"] == "ya"){echo "disabled";}?> <?php if($result["responsi_status_aktif"] == "non-aktif"){echo "disabled";}?> value="<?php echo $result["responsi_id"]?>"></td>
                                        <td align="center">
                                             <?php
                                            $data = $data_responsi->getDataResponsiByJadwal($result["responsi_id"]);
                                            if($data)
                                            {
                                                foreach($data as $row)
                                                {
                                                    echo $row["praktikan_nim"]."<br/>";
                                                }
                                            }
                                            else
                                            {
                                                echo "-";
                                            }
                                            ?>
                                        </td>
                                        <td>
                                             <?php
                                            $data = $data_responsi->getDataResponsiByJadwal($result["responsi_id"]);
                                            if($data)
                                            {
                                                foreach($data as $row)
                                                {
                                                    echo $row["praktikan_nama"]."<br/>";
                                                }
                                            }
                                            else
                                            {
                                               echo "<p style='text-align:center'>-</span>";
                                            }
                                            ?>
                                        </td>
                                        <td>Ruang <?php echo $result["responsi_ruang"]?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                
                                <?php
                                $no++;
                            }
                            ?>
                        </tbody>
                    </table>
                    </div>
                    <p class="pagination">
                        <?php
                        echo $this->pagination->create_links();
                        ?>
                    </p>
                     <div id="login-box" class="login-popup" style="width:400px">
                        <a href="#" class="close"><img src="<?php echo base_url()?>public/images/close_button.png" class="close_btn" title="Close Window" alt="Close" /></a>
                            <div class="content">
                                <h4></h4>
                                <h3>Masukkan NIM</h3>
                                <input type="hidden" class="responsi">
                                <table cellspacing="5">
                                    <?php
                                    for($i=1; $i<=3; $i++)
                                    {
                                        ?>
                                        <tr>
                                            <td>
                                                <input type="text" placeholder="NIM <?php echo $i?>" class="input" id="nim<?php echo $i?>">
                                            </td>
                                            <td>
                                                <span id="nim<?php echo $i?>"></span>
                                            </td>
                                        </tr>
                                        <?php
                                    }
                                    ?>
                                    <tr>
                                        <td>
                                            <input type="submit" class="button-flat-blue tambah-responsi" value="Tambah">
                                            <input type="submit" class="button-flat-red batal" value="Batal">
                                        </td>
                                    </tr>
                                </table>
                                <span>
                                    Ketentuan :<br/>
                                    <ul>
                                        <li>
                                            Setiap kelompok harus terdiri dari 3 anggota.
                                        </li>
                                        <li>
                                            Jika kelompok Anda kurang dari 3 anggota silahkan hubungi admin untuk pendaftarannya.
                                        </li>
                                        <li>
                                            Admin tidak bertanggung jawab atas kesalahan yang dilakukan oleh pendaftar.
                                        </li>
                                    </ul>
                                </span>
                            </div>
                        </div>
                    <?php
                }
                else
                {
                    ?>
                    <p class="no-class">Tidak ada data jadwal responsi</p>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){

        $(".tambah-responsi").click(function(){
            var nim = [$("#nim1").val(),$("#nim2").val(),$("#nim3").val()];
            displayLoadingPopup("Harap tunggu ...");
            $.post("<?php echo base_url()?>kcb/proses_tambah",
            {"nim":nim,"responsi_id":$(".responsi").val()},
            function(data){
                if(data.valid == 1){
                    displayMessagePopup("green_alert","Berhasil melakukan pendaftaran");
                }else if(data.valid == "not-number"){
                    displayMessagePopup("red_alert","Kolom NIM harus angka");
                }else if(data.valid == "duplikat"){
                    displayMessagePopup("red_alert","NIM "+data.praktikan_nim+" sudah terdaftar di kelompok "+data.responsi_id);
                }else if(data.valid == "kosong"){
                    displayMessagePopup("red_alert","Data tidak lengkap");
                }else if(data.valid == "empty"){
                    displayMessagePopup("red_alert","NIM "+data.nim+" tidak terdaftar dalam sistem");
                }else if(data.valid == "full"){
                    displayMessagePopup("red_alert","Jadwal sudah dipilih oleh kelompok lain");
                }else if(data.valid == "error"){
                    displayMessagePopup("red_alert","Tidak bisa melakukan pendaftaran");
                }else{
                    displayMessagePopup("red_alert","Gagal melakukan pendaftaran");
                }
            },"json");
        })

        $(".input").blur(function(){
            var id = $(this).attr("id");
            var id_responsi = $(".responsi").val();
            var nim = $(".input#"+id).val();
            if(nim != ""){
                $.post("<?php echo base_url()?>kcb/getDataPraktikan",
                    {"nim":nim,"id_responsi":id_responsi},
                    function(data){
                        if(data.stats == "success"){
                            $("span#"+id).html(data.praktikan_nama);
                        }else if(data.stats == "error"){
                            $("span#"+id).html("NIM tidak ditemukan");
                        }
                    },"json");
            }else{
                $("span#"+id).html("");
                $(".input#"+id).val("");
            }
                
        })
        $('.pilih').click(function() {
            $(".responsi").val($(this).val());
            var loginBox = $(this).attr("href");
            $(loginBox).fadeIn(300);

            var popMargTop = ($(loginBox).height() + 24) / 2; 
            var popMargLeft = ($(loginBox).width() + 24) / 2; 
            
            $(loginBox).css({ 
                'margin-top' : -popMargTop,
                'margin-left' : -popMargLeft
            });
            

            $('body').append('<div id="mask"></div>');
            $('#mask').fadeIn(300);
        
        });
    
         $('a.close, #mask, .batal').live('click', function() { 
            $('#mask , .login-popup').fadeOut(300 , function() {
            $('#mask').remove();  
             window.location.reload();
            }); 
    // return false;
        });

    })
</script>
