<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Tahun Ajaran</h3></header>
        <input type="hidden" id="id-ta" value="<?php echo $tahun_ajaran["ta_id"]?>"/>
        <table cellspacing="10" class="full">
            <tr>
                <td width="100px">Tahun Ajaran</td><td><input type="text" name="tahun-ajaran" id="tahun-ajaran" class="input full" value="<?php echo $tahun_ajaran["ta_nama"]?>"/></td>
            </tr>
            <tr>
                <td/><td><input type="submit" value="Simpan" id="submit-tahun-ajaran" class="alt_btn"></td>
            </tr>
        </table>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" value="List Tahun Ajaran" id="list-tahun-ajaran">
            </div>
        </footer>
    </article>
    
    <?php
    if($this->session->userdata("ta_status"))
    {
        echo $sidebar;
    }
    ?>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#list-tahun-ajaran").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/menu/ta";
       });
       
       $("#submit-tahun-ajaran").click(function(){
        displayLoading("Harap tunggu ...");
          $.post(
            "<?php echo base_url()?>superadmin/menu/editta",
            {"id_ta":$("#id-ta").val(),"nama_ta":$("#tahun-ajaran").val()},
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