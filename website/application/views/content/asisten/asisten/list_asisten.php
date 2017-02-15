<section id="main" class="column">
    <article class="module width_full">
        <header><h3>Data Asisten</h3></header>
        <table class="tablesorter" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th align="center">NIM</th>
                    <th>Nama</th>
                    <th>Jenis Kelamin</th>
                    <th align="center">Angkatan</th>
                    <th>Jabatan</th>
                    <th align="center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                        <?php
                        if($asisten)
                        {
                            $no = 1;
                            foreach($asisten as $result)
                            {
                                ?>
                                <tr>
                                    <td align="center"><?php echo $no?></td>
                                    <td align="center"><?php echo $result["user_username"]?></td>
                                    <td><?php echo $result["user_nama"]?></td>
                                    <td><?php echo $result["user_jenis_kelamin"]?></td>
                                    <td align="center"><?php echo $result["user_angkatan"]?></td>
                                    <td><?php echo $result["jabatan_nama"]?></td>
                                    <td align="center">
                                        <?php if($this->session->userdata("ta_status") == "active"){?>
                                        <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["user_id"]?>)"/>
                                        <?php }?>
                                        <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Delete" onclick="hapus(<?php echo $result["user_id"]?>)"/>
                                    </td>
                                </tr>
                                <?php
                                $no++;
                            }
                        }
                        else
                        {
                            ?>
                                <tr>
                                    <td colspan="7" align="center" class="no-data">Tidak ada data Asisten</td>
                                </tr>
                            <?php
                        }
                        ?>
                </tbody>
        </table>
        <footer>
        </footer>
    </article>
    <div class="spacer"></div>
</section>
<script type="text/javascript">
    function edit(id){
        window.location.href = "<?php echo base_url()?>asisten/asisten/edit/"+id;
    }
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin untuk menghapus data asisten ini?");
        if(conf){
            window.location.href = "<?php echo base_url()?>asisten/asisten/hapus/"+id;
        }
    }
</script>