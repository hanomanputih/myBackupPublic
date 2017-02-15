<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Edit Mahasiswa KCB</h3></header>
        <div class="with-padding">
            <input type="hidden" id="id-mahasiswa" value="<?php echo $mahasiswa["praktikan_id"]?>">
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td>NIM</td><td><input type="text" class="input full readonly" readonly id="nim-mahasiswa" value="<?php echo $mahasiswa["praktikan_nim"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Nama</td><td><input type="text" class="input full" id="nama-mahasiswa" value="<?php echo $mahasiswa["praktikan_nama"]?>"/><td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>
                            <select id="id-kelas" class="select">
                                <option value="<?php echo $mahasiswa["kelas_id"]?>">Kelas <?php echo $mahasiswa["kelas_nama"]?></option>
                                <?php
                                $dataKelas = $kelas->getKelasKcbExceptId($mahasiswa["kelas_id"]);
                                if($dataKelas)
                                {
                                    foreach($dataKelas as $result)
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
                            <input type="submit" value="Simpan" id="simpan" class="alt_btn"/>
                            <input type="submit" value="Batal" id="batal"/>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" id="list-mahasiswa" value="List Mahasiswa"/>
            </div>
        </footer>
    </article>
</section>

<script type="text/javascript">
    $(document).ready(function(){
       $("#list-mahasiswa").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/kcb/mahasiswa";
       });
       $("#batal").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/mahasiswa"; 
       });
       
       $("#simpan").click(function(){
        displayLoading("harap tunggu ...")
          $.post(
                "<?php echo base_url()?>superadmin/kcb/proses_edit_mahasiswa",
                {"id_mahasiswa":$("#id-mahasiswa").val(),"nim_mahasiswa":$("#nim-mahasiswa").val(),"nama_mahasiswa":$("#nama-mahasiswa").val(),"id_kelas":$("#id-kelas").val()},
                function(data){
                    if(data == 1){
                        displayMessage("alert_success","Data mahasiswa berhasil diubah");
                    }else if(data == "duplikat"){
                        displayMessage("alert_error","Data mahasiswa sudah tersedia");
                    }else if(data == "not-number"){
                        displayMessage("alert_error","Kolom nim harus angka");
                    }else if(data == "not-8"){
                        displayMessage("alert_error","Kolom nim harus berisi 8 karakter");
                    }else if(data == "kosong"){
                        displayMessage("alert_error","Data mahasiswa tidak lengkap");
                    }else{
                        displayMessage("alert_error","Data mahasiswa gagal diubah");
                    }
                }
            ) 
       });
    });
</script>