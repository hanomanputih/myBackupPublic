    <section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Mahasiswa KCB</h3></header>
        <div class="with-padding">
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td width="75px">NIM</td><td><input type="text" class="input full" id="nim-praktikan"/></td>
                    </tr>
                    <tr>
                        <td>Nama</td><td><input type="text" class="input full" id="nama-praktikan"/></td>
                    </tr>
                    <tr>
                        <td>Kelas</td><td><input type="text" class="input full" id="kelas-praktikan"/></td>
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
       
       $("#tambah").click(function(){
            displayLoading("Harap tunggu ...");
            $.ajax("<?php echo base_url()?>superadmin/data/proses_tambah",{
                data : {
                    nim : $("#nim-praktikan").val(),
                    nama : $("#nama-praktikan").val(),
                    kelas : $("#kelas-praktikan").val(),
                },
                type : "POST",
                dataType : "JSON",
                success : function(data){
                    if(data.berhasil == 1){
                        displayMessage("alert_success","Data berhasil ditambahkan");
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
                        displayMessage("alert_error","Data gagal ditambahkan");
                    }
                },
                error : function(){
                    displayMessage("alert_error","Maaf, terjadi kesalahan pada server kami");
                }
            })
       });
    });
</script>