<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Praktikan</h3></header>
        <div class="with-padding">
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td>NIM</td><td><input type="text" class="input full" id="nim-praktikan"/></td>
                    </tr>
                    <tr>
                        <td>nama</td><td><input type="text" class="input full" id="nama-praktikan"></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>
                            <select id="id-kelas" class="select">
                                <option value="">-pilih-</option>
                                <?php
                                if($kelas)
                                {
                                    foreach($kelas as $result)
                                    {
                                        ?>
                                        <option value="<?php echo $result["kelas_id"]?>">Kelas <?php echo $result["kelas_nama"]?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td/>
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
                <input type="submit" id="list-praktikan" value="List Praktikan"/>
            </div>
        </footer>
    </article>
</section>

<script type="text/javascript">
    $(document).ready(function(){
       $("#list-praktikan").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/pbo/praktikan";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/pbo/praktikan"; 
       });
       
       $("#tambah").click(function(){
        displayLoading("harap tunggu ...")
          $.post(
                "<?php echo base_url()?>superadmin/pbo/proses_tambah_praktikan",
                {"nim_praktikan":$("#nim-praktikan").val(),"nama_praktikan":$("#nama-praktikan").val(),"id_kelas":$("#id-kelas").val()},
                function(data){
                     if(data.stats == 1){
                        displayMessage("alert_success","Data berhasil ditambahkan");
                    }else if(data.stats == "duplikat"){
                        displayMessage("alert_error","Data sudah tersedia");
                    }else if(data.stats == "not-number"){
                        displayMessage("alert_error","Kolom nim harus angka");
                    }else if(data.stats == "not-8"){
                        displayMessage("alert_error","Kolom nim harus berisi 8 karakter");
                    }else if(data.stats == "not-alpha"){
                        displayMessage("alert_error","Kolom nama harus karakter alphabet");
                    }else if(data.stats == "avail"){
                        displayMessage("alert_error","NIM "+$("#nim-praktikan").val()+" sudah terdaftar dalam sistem di kelas "+data.kelas_nama);
                    }else if(data.stats == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else{
                        displayMessage("alert_error","Data gagal ditambahkan");
                    }
                },"json") ;
       });
    });
</script>