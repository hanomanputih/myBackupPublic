    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Kelas Teori</h3></header>
        <div class="with-padding">
            <input type="hidden" id="id-kelas" value="<?php echo $kelas_ai["kelas_id"]?>">
            <table cellspacing="10" width="500px">
                <tbody>
                    <tr>
                        <td width="75px">Nama Kelas</td><td><input type="text" class="input full" id="nama-kelas" value="<?php echo $kelas_ai["kelas_nama"]?>"/></td>
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
           window.location.href = "<?php echo base_url()?>superadmin/kcb/kelas";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/kelas"; 
       });
       
       $("#simpan").click(function(){
            displayLoading("Harap tunggu ...");
          $.post(
                "<?php echo base_url()?>superadmin/kcb/proses_edit_teori",
                {"id_kelas":$("#id-kelas").val(),"nama_kelas":$("#nama-kelas").val()},
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