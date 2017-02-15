<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Praktikan</h3></header>
        <div class="with-padding">
            <input type="hidden" id="id-daftar" value="<?php echo $praktikan_ai["daftar_id"]?>">
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td>NIM</td><td><input type="text" class="input full" readonly id="nim-praktikan" value="<?php echo $praktikan_ai["daftar_nim"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>
                            <select id="id-kelas" class="select">
                                <option value="<?php echo $praktikan_ai["kelas_id"]?>">Kelas <?php echo $praktikan_ai["kelas_nama"]?></option>
                                <?php
                                    $data = $kelas->getKelasKcbExceptById($praktikan_ai["kelas_id"]);
                                    foreach($data as $result)
                                    {
                                        if($result["kelas_id"] == $praktikan_ai["kelas_id"])
                                        {
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
           window.location.href = "<?php echo base_url()?>superadmin/kcb/praktikan";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/praktikan"; 
       });
       
       $("#simpan").click(function(){
        displayLoading("Harap tunggu ...");
          $.post(
                "<?php echo base_url()?>superadmin/kcb/proses_edit_praktikan",
                {"id_daftar":$("#id-daftar").val(),"nim_praktikan":$("#nim-praktikan").val(),"id_kelas":$("#id-kelas").val()},
                function(data){
                     if(data == 1){
                        displayMessage("alert_success","Data berhasil diubah");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Data sudah tersedia");
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