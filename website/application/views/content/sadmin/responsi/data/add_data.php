    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Data Praktikan Responsi</h3></header>
        <div class="with-padding">
            <input type="text" id="id-jadwal" value="<?php echo $id_jadwal?>">
            <table cellspacing="10" width="500px" border="0">
                <tbody>
                    <tr>
                        <td>NIM 1</td><td><input type="text" id="nim1"></td>
                    </tr>
                    <tr>
                        <td>NIM 2</td><td><input type="text" id="nim2"></td>
                    </tr>
                    <tr>
                        <td>NIM 3</td><td><input type="text" id="nim3"></td>
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
                <input type="submit" id="list-kelas" value="List Daftar Responsi"/>
            </div>
        </footer>
    </article>
</section>

<script type="text/javascript">
    $(document).ready(function(){
       $("#list-kelas").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/kcb/responsi";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/responsi"; 
       });
       
       $("#tambah").click(function(){
            displayLoading("Harap tunggu ...");

          $.post(
                "<?php echo base_url()?>superadmin/kcb/proses_tambah_data_responsi",
                {"nim1":$("#nim1").val(),"nim2":$("#nim2").val(),"nim3":$("#nim3").val()},
                function(data){
                    if(data == 1){
                        displayMessage("alert_success","Jadwal responsi berhasil ditambahkan");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Data sudah tersedia");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else if(data == "not-number"){
                        displayMessage("alert_error","Kolom NIM harus angka");
                    }else{
                        displayMessage("alert_error","Jadwal responsi gagal ditambahkan");
                    }
                }
            ) 
       });
    });
</script>