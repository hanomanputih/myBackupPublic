<section id="main" class="column">
    <article class="module width_3_quarter">
        <header><h3>Daftar Tahun Ajaran</h3></header>
        <table class="tablesorter" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th>Tahun Ajaran</th>
                    <th align="center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $no = 1;
                if($tahun_ajaran)
                {
                    foreach($tahun_ajaran as $result)
                    {
                        ?>
                        <tr>
                            <td align="center"><?php echo $no?></td>
                            <td><?php echo $result["ta_nama"]?></td>
                            <td align="center">
                                <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" value="Edit" title="Edit" onclick="edit(<?php echo $result["ta_id"]?>)"/>
                                <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" value="Hapus" title="Hapus" onclick="hapus(<?php echo $result["ta_id"]?>)"/>
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
                        <td colspan="3" align="center" class="no-data">Tidak ada data tahun ajaran</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" id="submit-tahun-ajaran" value="Tambah Tahun Ajaran">
            </div>
        </footer>
    </article>
    
    <?php 
    if($this->session->userdata("ta_status"))
    {
        echo $sidebar;
    }
    ?>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#submit-tahun-ajaran").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/menu/ta/tambah"; 
       }); 
    });
    
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin untuk menghapus tahun ajaran ini?\nSemua data nilai yang berhubungan dengan tahun ajaran ini akan hilang.");
        if(conf){
            window.location.href = "<?php echo base_url()?>superadmin/menu/ta/hapus/"+id;
        }
    }
    
    function edit(id){
        window.location.href = "<?php echo base_url()?>superadmin/menu/ta/edit/"+id;
    }
</script>