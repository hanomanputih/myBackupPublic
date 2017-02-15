<section id="main" class="column">
    <article class="module width_3_quarter">
        <header><h3>Daftar Modul</h3></header>
        <table class="tablesorter" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th>Pertemuan</th>
                    <th>Modul</th>
                    <th align="center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($modul)
                {
                    $no = 1;
                    foreach($modul as $result)
                    {
                        ?>
                        <tr>
                            <td align="center"><?php echo $no?></td>
                            <td>Pertemuan <?php echo $result["modul_pertemuan"]?></td>
                            <td><?php echo $result["modul_nama"]?></td>
                            <td align="center">
                                <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["modul_id"]?>)"/>
                                <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["modul_id"]?>)"/>
                            </td>
                        </tr>
                        <?php
                        $no++;
                    }
                }
                else
                {
                    ?>
                    <tr><td colspan="4" align="center" class="no-data">Tidak ada data modul pertemuan</td></tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <footer>
            <?php if($this->session->userdata("ta_status") == "active"){?>
            <div class="submit_link left-float">
                <input type="submit" id="submit-modul" value="Tambah Modul">
            </div>
            <?php }?>
        </footer>
    </article>
    
    <?php echo $sidebar?>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#submit-modul").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/pengaturan/modul/tambah"; 
       }); 
    });
    
    function hapus(id){
        var conf = window.confirm("Apakah Anda ingin untuk menghapus modul pertemuan ini?\nTugas yang berhubungan dengan modul ini akan hilang.");
        if(conf){
            window.location.href = "<?php echo base_url()?>superadmin/pengaturan/modul/hapus/"+id;
        }
    }
    
    function edit(id){
        window.location.href = "<?php echo base_url()?>superadmin/pengaturan/modul/edit/"+id;
    }
</script>