<section id="main" class="column">
    <article class="module width_3_quarter">
        <header><h3>Daftar Jabatan</h3></header>
        <table class="tablesorter" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th>Nama Jabatan</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($jabatan)
                {
                    $no = 1;
                    foreach($jabatan as $result)
                    {
                ?>
                        <tr>
                            <td align="center"><?php echo $no?></td>
                            <td><?php echo $result["jabatan_nama"]?></td>
                            <td>
                                <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["jabatan_id"]?>)"/>
                                <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Delete" onclick="hapus(<?php echo $result["jabatan_id"]?>)"/>
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
                        <td colspan="3" align="center" class="no-data">Tidak ada data jabatan</td>
                    </tr>
                    <?php
                }
                    ?>
            </tbody>
        </table>
        <footer>
            <?php if($this->session->userdata("ta_status") == "active"){?>
            <div class="submit_link left-float">
                <input type="submit" id="submit-jabatan" value="Tambah Jabatan">
            </div>
            <?php }?>
        </footer>
    </article>
    
    <?php echo $sidebar?>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#submit-jabatan").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/pengaturan/jabatan/tambah"; 
       }); 
    });
    
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin untuk menghapus jabatan ini?");
        if(conf){
            window.location.href = "<?php echo base_url()?>superadmin/pengaturan/jabatan/hapus/"+id;
        }
    }
    
    function edit(id){
        window.location.href = "<?php echo base_url()?>superadmin/pengaturan/jabatan/edit/"+id;
    }
</script>