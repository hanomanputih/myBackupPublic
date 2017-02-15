<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Jabatan</h3></header>
        <table cellspacing="10" class="full">
            <tr>
                <td width="100px">Nama Jabatan</td><td><input type="text" name="jabatan" id="jabatan" class="input full" /></td>
            </tr>
            <tr>
                <td/><td><input type="submit" value="Tambah" id="submit-jabatan" class="alt_btn"></td>
            </tr>
        </table>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" value="List Jabatan" id="list-jabatan">
            </div>
        </footer>
    </article>
    
    <?php echo $sidebar?>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#list-jabatan").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/pengaturan/jabatan";
       });
       
       $("#submit-jabatan").click(function(){
        displayLoading("Harap tunggu ...");
          $.post(
            "<?php echo base_url()?>superadmin/pengaturan/proses_simpan_jabatan",
            {"nama_jabatan":$("#jabatan").val()},
            function(data){
                 if(data == 1){
                        displayMessage("alert_success","Data jabatan berhasil ditambahkan");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Data jabatan sudah tersedia");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else{
                        displayMessage("alert_error","Data jabatan gagal ditambahkan");
                    }
            }
          ); 
       });
    })
</script>