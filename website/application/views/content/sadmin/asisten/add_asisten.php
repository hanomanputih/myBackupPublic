<section id="main" class="column">
    <h4 <?php echo $class?>><?php echo $pesan?></h4>
    <article class="module width_3_quarter">
        <header><h3>Tambah Asisten</h3></header>
        <div class="with-padding">
            <?php
            echo form_open(base_url()."superadmin/asisten/tambah/proses")
            ?>
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td width="74px">NIM</td><td><input name="nim" id="nim" type="text" class="input" value="<?php echo set_value("nim")?>"/></td>
                    </tr>
                    <tr>
                        <td>Nama</td><td><input name="nama" id="nama" type="text" class="input" value="<?php echo set_value("nama")?>"/></td>
                    </tr>
                    <tr>
                        <td>Angkatan</td><td><input name="angkatan" id="angkatan" type="text" value="<?php echo set_value("angkatan")?>"/></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <select name="j-k" id="j-k" class="select">
                                <option value="">-pilih-</option>
                                <option value="Laki-laki">Laki-laki</option>
                                <option value="Perempuan">Perempuan</option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>
                            <select name="jabatan" id="jabatan" class="select">
                                <option value="">-pilih-</option>
                                <?php
                                foreach($jabatan as $result)
                                {
                                    ?>
                                    <option value="<?php echo $result["jabatan_id"]?>"><?php echo $result["jabatan_nama"]?></option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><small>*) Default password : ksc-laboratory</small></td>
                    </tr>
                    <tr>
                        <td/>
                        <td>
                            <input type="submit" id="submit-asisten" value="Simpan" class="alt_btn"/>
                        </td>
                    </tr>
                </tbody>
            </table>
            <?php
            echo form_close();
            ?>
        </div>
        <footer>
            <div class="submit_link">
                <input type="submit" id="list-asisten" value="List Asisten"/>
            </div>
        </footer>
    </article>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#list-asisten").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/asisten"; 
       });
       $("#nim").change(function(){
            var nim = $(this).val();
            if(nim == ""){
                $("#angkatan").val("");
            }else{
                $("#angkatan").val("20"+nim[0]+nim[1]);
                $("#angkatan").attr("readonly","readonly");
            }
       })
    })
</script>