<div id="cB1">
    <h3>DAFTAR PRAKTIKUM</h3>
    <div class="main-content">
        <?php
        if($status["kelas_status"] == "aktif")
        {
            if($jumlah_praktikan["jumlah"] >= $kelas["kelas_kuota"])
             {
                 ?>
                 <p class="no-data">Kuota sudah penuh. Tidak bisa melakukan pendaftaran</p>
                 <?php
             }
             else
             {
                ?>
            <div id="info"></div>
            <table class="table">
            <input type="hidden" id="id-kelas" value="<?php echo $kelas_id?>"/>
            <tr>
                <td>NIM</td><td> : </td><td><input type="text" name="nim" class="input" id="nim" maxlength="8"/></td>
            </tr>
            <tr>
                <td>Nama</td><td> : </td><td><input type="text" name="nama" class="input" id="nama" /></td>
            </tr>
            <tr>
                <td/><td/><td><input type="submit" id="daftar" class="submit button-blue" value="Kirim"> <input type="submit" class="submit button-red" id="batal" value="Batal"></td>
            </tr>
            </table>

                <?php

            }
        ?>
            <?php
        }
        else
        {
            ?>
            
            <p class="no-data">Bukan waktunya pendaftaran praktikum</p>
            <?php
        }
        ?>
               <div class="content">
        <h4><b>Data Praktikan Kelas <?php echo $kelas["kelas_nama"]?></b></h4>
        <table class="list-table" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th align="center">NIM</th>
                    <th>Nama</th>
                    <th align="center">Angkatan</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($praktikan)
                {
                    $no = 1;
                    foreach($praktikan as $result)
                    {
                        if($no%2 == 0)
                        {
                            ?>
                            <tr>
                                <td align="center"><?php echo $no?></td>
                                <td align="center"><?php echo $result["daftar_nim"]?></td>
                                <td><?php echo $result["praktikan_nama"]?></td>
                                <td align="center">20<?php echo substr($result["praktikan_nim"],0,2)?></td>
                            </tr>
                            <?php
                        }
                        else
                        {
                            ?>
                            <tr class="white">
                                <td align="center"><?php echo $no?></td>
                                <td align="center"><?php echo $result["daftar_nim"]?></td>
                                <td><?php echo $result["praktikan_nama"]?></td>
                                <td align="center">20<?php echo substr($result["praktikan_nim"],0,2)?></td>
                            </tr>
                            <?php
                        }
                        $no++;
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="4" align="center" class="no-data">Belum ada praktikan yang mendaftar kelas ini</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        </div>
        
    </div>
</div>
<script type="text/javascript">
    $(document).ready(function(){
        $("#info").hide();
        $("#info").click(function(){
            $(this).slideUp(300);
        })
        $("#batal").click(function(){
            window.location.href = "<?php echo base_url()?>kcb/pendaftaran";
        })
        $("#nim").change(function(){
            var panjang = $("#nim").val();
            $("#info").slideUp(300);
            if(panjang != ""){
                if(panjang.length != 8){
                   displayMessage("alert_error","Kolom NIM harus berisi 8 karakter");
                }else{
                    $.post("<?php echo base_url()?>kcb/getData",
                        {"nim":$("#nim").val()},
                        function(data){
                            $("#nama").css("color","black");
                            if(data.stats){
                                $("#nama").val(data.praktikan_nama);
                            }
                            else{
                                $("#nama").css("color","red");
                                $("#nama").val("Tidak Terdaftar");
                            }
                            $("#nama").attr("readonly","readonly");
                        },"json");
                }
            }else if(panjang == ""){
                $("#angkatan").val("");
            }
        })

        $("#daftar").click(function(){
            displayLoading("Harap tunggu ...");
            $.post(
            "<?php echo base_url()?>kcb/daftar",
            {"id_kelas":$("#id-kelas").val(),"nim":$("#nim").val(),"nama":$("#nama").val()},
            function(data){
                if(data.stats == 1){
                    displayMessage("alert_success","Berhasil melakukan pendaftaran");
                    window.location.reload();
                }else if(data.stats == "kosong"){
                    displayMessage("alert_error","Data tidak lengkap");
                }else if(data.stats == "not-number"){
                    displayMessage("alert_error","Kolom NIM harus angka");
                }else if(data.stats == "not-alpha"){
                    displayMessage("alert_error","Kolom Nama harus karakter alphabet");
                }else if(data.stats == "not-8"){
                    displayMessage("alert_error","Kolom NIM harus berisi 8 karakter");
                }else if(data.stats == "penuh"){
                    displayMessage("alert_error","Kuota untuk kelas ini sudah penuh");
                }else if(data.stats == "tidak"){
                    displayMessage("alert_error","NIM "+$("#nim").val()+" tidak terdaftar dalam sistem");
                }else if(data.stats == "duplikat"){
                    displayMessage("alert_error","NIM "+$("#nim").val()+" sudah terdaftar di kelas "+data.kelas_nama);
                }
            },"json");
        });
    })
</script>