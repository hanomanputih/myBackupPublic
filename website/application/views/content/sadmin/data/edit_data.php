    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Mahasiswa KCB</h3></header>
        <div class="with-padding">
            <input type="hidden" id="id-praktikan" value="<?php echo $data["praktikan_id"]?>">
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td width="75px">NIM</td><td><input type="text" class="input full" id="nim-praktikan" readonly value="<?php echo $data["praktikan_nim"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Nama</td><td><input type="text" class="input full" id="nama-praktikan" value="<?php echo $data["praktikan_nama"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Kelas</td><td><input type="text" class="input full" id="kelas-praktikan" value="<?php echo $data["praktikan_kelas"]?>"/></td>
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
                <input type="submit" id="list-praktikan" value="List Mahasiswa"/>
            </div>
        </footer>
    </article>
</section>

<script type="text/javascript">
    $(document).ready(function(){
       $("#list-praktikan").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/data";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/data"; 
       });
       
       $("#simpan").click(function(){
            displayLoading("Harap tunggu ...");
            $.ajax("<?php echo base_url()?>superadmin/data/proses_edit",{
                data : {
                    id : $("#id-praktikan").val(),
                    nim : $("#nim-praktikan").val(),
                    nama : $("#nama-praktikan").val(),
                    kelas : $("#kelas-praktikan").val(),
                },
                type : "POST",
                dataType : "JSON",
                success : function(data){
                    if(data.berhasil == 1){
                        displayMessage("alert_success","Data berhasil diubah");
                    }else if(data.berhasil == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else if(data.berhasil == "not-number"){
                        displayMessage("alert_error","Kolom NIM harus berisi angka");
                    }else if(data.berhasil == "not-8"){
                        displayMessage("alert_error","Kolom NIM harus berisi 8 karakter");
                    }else if(data.berhasil == "not-alpha"){
                        displayMessage("alert_error","Kolom nama harus karakter alphabet");
                    }else if(data.berhasil == "duplikat"){
                        displayMessage("alert_error","Data sudah tersedia");
                    }else{
                        displayMessage("alert_error","Data gagal diubah");
                    }
                },
                error : function(){
                    displayMessage("alert_error","Maaf, terjadi kesalahan pada server kami");
                }
            })
       });
    });
</script>