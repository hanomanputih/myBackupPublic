<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Praktikan</h3></header>
        <div class="with-padding">
            <input type="hidden" id="id-praktikan" value="<?php echo $pbo["pbo_id"]?>">
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td>NIM</td><td><input type="text" class="input full readonly" readonly id="nim-praktikan" value="<?php echo $pbo["pbo_nim"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Nama</td><td><input type="text" class="input full" id="nama-praktikan" value="<?php echo $pbo["pbo_nama"]?>"></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>
                            <select id="id-kelas" class="select">
                                
                                <?php
                                    
                                    foreach($kelas as $result)
                                    {
                                        if($result["kelas_id"] == $pbo["kelas_id"])
                                        {
                                            ?>
                                            <option selected value="<?php echo $pbo["kelas_id"]?>">Kelas <?php echo $pbo["kelas_nama"]?></option>
                                            <?php
                                            continue;
                                        }
                                        ?>
                                        <option value="<?php echo $result["kelas_id"]?>">Kelas <?php echo $result["kelas_nama"]?></option>
                                        <?php
                                    }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td/>
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
       
       $("#simpan").click(function(){
        displayLoading("Harap tunggu ...");
          $.post(
                "<?php echo base_url()?>superadmin/pbo/proses_edit_praktikan",
                {"id_praktikan":$("#id-praktikan").val(),"nim_praktikan":$("#nim-praktikan").val(),"nama_praktikan":$("#nama-praktikan").val(),"id_kelas":$("#id-kelas").val()},
                function(data){
                     if(data == 1){
                        displayMessage("alert_success","Data berhasil diubah");
                    }else if(data == "not-alpha"){
                        displayMessage("alert_error","Kolom nama harus karakter alphabet");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data tidak lengkap");
                    }else{
                        displayMessage("alert_error","Data gagal diubah");
                    }
                }
            ) 
       });
    });
</script>