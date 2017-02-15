<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Tahun Ajaran</h3></header>
        <table cellspacing="10" class="full">
            <tr>
                <td width="100px">Tahun Ajaran</td><td><input type="text" name="tahun-ajaran" id="tahun-ajaran" class="input full" /></td>
            </tr>
            <tr>
                <td/><td><input type="submit" value="Tambah" id="submit-tahun-ajaran" class="alt_btn"></td>
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
            "<?php echo base_url()?>superadmin/menu/simpanta",
            {"nama_ta":$("#tahun-ajaran").val()},
            function(data){
                 if(data == 1){
                        displayMessage("alert_success","Tahun ajaran berhasil ditambahkan");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Tahun ajaran sudah tersedia");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else{
                        displayMessage("alert_error","Tahun ajaran gagal ditambahkan");
                 }
            }
          ); 
       });
    })
</script>