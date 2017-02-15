<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Modul</h3></header>
        <div class="horison-padding">
            <fieldset>
                <label>Modul</label>
                <p>
                    <input type="hidden" id="id-modul" value="<?php echo $modul["modul_id"]?>"/>
                    <input type="text" name="pertemuan-nama" id="pertemuan-nama" class="input full" value="<?php echo $modul["modul_nama"]?>">
                </p>
            </fieldset>
            <input type="submit" value="Simpan" id="submit-modul" class="alt_btn">
            <input type="submit" value="Batal" id="submit-batal">
            <div class="spacer"></div>
        </div>

        <footer>
            <div class="submit_link left-float">
                <input type="submit" value="List Modul" id="list-modul">
            </div>
        </footer>
    </article>
    
    <?php echo $sidebar?>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#list-modul").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/pengaturan/modul";
       });
        $("#submit-batal").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/pengaturan/modul";
       });
       
       $("#submit-modul").click(function(){
        displayLoading("Harap tunggu ...");
          $.post(
            "<?php echo base_url()?>superadmin/pengaturan/proses_edit_modul",
            {"id_modul":$("#id-modul").val(),"pertemuan_modul":$("#pertemuan-modul").val(),"pertemuan_nama":$("#pertemuan-nama").val()},
            function(data){
                if(data == 1){
                        displayMessage("alert_success","Modul berhasil diubah");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Modul sudah tersedia");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else{
                        displayMessage("alert_error","Modul gagal diubah");
                 }
            }
          ); 
       });
    })
</script>