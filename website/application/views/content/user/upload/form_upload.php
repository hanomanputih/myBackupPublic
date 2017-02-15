<div id="cB1">
        <h3>UPLOAD TUGAS</h3>
        <?php
        if($kelas AND $modul)
        {
            ?>
            <?php echo form_open_multipart(base_url()."praktikum/upload")?>
            <div class="main-content">
                <input type="hidden" name="kelas" id="kelas" value="<?php echo $kelas["kelas_id"]?>"/>
                <input type="hidden" name="modul" id="modul" value="<?php echo $modul["modul_id"]?>"/>
                <table class="table">
                    <tr>
                        <td>Kelas</td><td> : </td><td>Kelas <?php echo $kelas["kelas_nama"]?></td>
                    </tr>
                    <tr>
                        <td>Pertemuan</td><td> : </td><td><?php echo $modul["modul_nama"]?></td>
                    </tr>
                    <tr>
                        <td>NIM</td><td> : </td><td><input type="text" name="nim" class="input" id="nim" value="<?php echo set_value("nim")?>"/></td>
                    </tr>
                    <tr>
                        <td>Nama</td><td> : </td><td><input type="text" name="nama" class="input" id="nama" value="<?php echo set_value("nama")?>"/></td>
                    </tr>
                    <tr>
                        <td>Asisten Pembimbing</td><td> : </td>
                        <td>
                            <select name="asisten" id="asisten">
                                <?php
                                if($asisten)
                                {
                                    ?>
                                    <option value="">-pilih-</option>
                                    <?php
                                    foreach($asisten as $result)
                                    {
                                        ?>
                                        <option value="<?php echo $result["user_id"]?>"><?php echo $result["user_nama"]?></option>
                                        <?php
                                    }
                                }
                                else
                                {
                                    ?>
                                    <option value="-">-pilih-</option>
                                    <?php
                                }
                                ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>File Tugas</td><td> : </td><td><input type="file" name="userfile"/></td>
                    </tr>
                    <tr>
                        <td/><td/><td><input type="submit" id="upload" value="Kirim"></td>
                    </tr>
                    <tr>
                        <td colspan="3"><small>Format file yang diizinkan adalah .zip</small></td>
                    </tr>
                </table>
                <?php echo $pesan;?>
            </div>
            <?php echo form_close();?>
            <?php
        }
        else
        {
            ?>
            <div class="main-content">
                <p class="no-class" style="border-bottom: 1px dotted gray">Bukan waktunya untuk upload tugas</p>
            </div>
            <?php
        }
        ?>
        
</div>