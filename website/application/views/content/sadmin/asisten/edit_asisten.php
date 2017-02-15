<section id="main" class="column">
    <h4 <?php echo $class?>><?php echo $pesan?></h4>
    
    <article class="module width_3_quarter">
        <header><h3>Edit Asisten</h3></header>
        <div class="with-padding">
            <?php
            echo form_open(base_url()."superadmin/asisten/edit/".$asisten["user_id"]."/proses");
            ?>
            <input type="hidden" name="id-asisten" id="id-asisten" value="<?php echo $asisten["user_id"]?>"/>
            <table cellspacing="10" width="400px">
                <tbody>
                    <tr>
                        <td width="74px">NIM</td><td><input name="nim" type="text" id="nim" class="input" readonly value="<?php echo $asisten["user_username"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Nama</td><td><input name="nama" type="text" id="nama" class="input" value="<?php echo $asisten["user_nama"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Angkatan</td><td><input name="angkatan" id="angkatan" type="text" readonly value="<?php echo $asisten["user_angkatan"]?>"/></td>
                    </tr>
                    <tr>
                        <td>Password</td><td><input name="password" id="password" class="input" type="password"><small>Kosongkan jika tidak diubah</small></td>
                    </tr>
                    <tr>
                        <td>Jenis Kelamin</td>
                        <td>
                            <select name="j-k" id="j-k" class="select">
                                <option selected="<?php echo $asisten["user_jenis_kelamin"]?>"><?php echo $asisten["user_jenis_kelamin"]?></option>
                                <?php
                                switch ($asisten["user_jenis_kelamin"])
                                {
                                    case "Laki-laki":
                                        $gender = "Perempuan";
                                        break;
                                    case "Perempuan":
                                        $gender = "Laki-laki";
                                        break;
                                        
                                }
                                ?>
                                <option value="<?php echo $gender?>"><?php echo $gender?></option>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>Jabatan</td>
                        <td>
                            <select name="jabatan" id="jabatan" class="select">
                                <option selected value="<?php echo $asisten["jabatan_id"]?>"><?php echo $asisten["jabatan_nama"]?></option>
                                <?php
                                foreach($jabatan->getJabatanExceptId($asisten["jabatan_id"]) as $result)
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
                        <td/>
                        <td>
                            <input type="submit" id="submit-asisten" value="Simpan" class="alt_btn"/>
                            <?php
                            echo form_close();
                            ?>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <footer>
            <div class="submit_link">
            <input type="submit" name="list-asisten" id="list-asisten" value="List Asisten">
            </div>
        </footer>
    </article>
</section>

<script type="text/javascript">
    $(document).ready(function(){
        $("#list-asisten").click(function(){
            window.location.href = "<?php echo base_url()?>superadmin/asisten";
        });
    })
</script>

