    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Kelas Praktikum</h3></header>
        <div class="with-padding">
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td width="75px">Nama Kelas</td><td><input type="text" class="input full" id="nama-kelas"/></td>
                    </tr>
                    <tr>
                        <td>Hari</td><td><input type="text" class="input full" id="hari-kelas"/></td>
                    </tr>
                    <tr>
                        <td>Tanggal</td><td><input type="text" class="input full" id="tanggal-kelas"/></td>
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
           window.location.href = "<?php echo base_url()?>superadmin/kelas/ai";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kelas/ai"; 
       });
       
       $("#tambah").click(function(){
          $.post(
                "<?php echo base_url()?>superadmin/kelas/proses_tambah_ai",
                {"nama_kelas":$("#nama-kelas").val(),"hari_kelas":$("#hari-kelas").val(),"tanggal_kelas":$("#tanggal-kelas").val(),"jam_kelas":$("#jam-kelas").val(),"kuota_kelas":$("#kuota-kelas").val(),"keterangan_kelas":$("#keterangan-kelas").val()},
                function(data){
                    $("#info").hide();   
                    $("#info").removeClass();   
                    if(data == 1){
                        $("#info").addClass("alert_success");
                        $("#info").html("Kelas berhasil ditambahkan.");
                    }else if(data == "duplikat"){
                        $("#info").addClass("alert_error");
                        $("#info").html("Kelas sudah tersedia.");
                    }else if(data == "kosong"){
                        $("#info").addClass("alert_error");
                        $("#info").html("Data tidak lengkap.");
                    }else{
                        $("#info").addClass("alert_error");
                        $("#info").html("Kelas gagal ditambahkan.");
                    }
                    $("#info").slideDown(300);
                }
            ) 
       });
    });
</script>