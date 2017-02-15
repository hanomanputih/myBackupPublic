<section id="main" class="column">
    <article class="module width_3_quarter">
        <header><h3>Jadwal Responsi</h3></header>
        <?php
        if($hari)
        {
            $url = $this->uri->segment(4);
        ?>
        <div class="list-kelas">
            <span class="data-kelas">
                <?php
                foreach($hari as $result)
                {
                    if($url == $result["responsi_hari"])
                    {
                        $class = "class='active'";
                    }
                    else
                    {
                        $class = "";
                    }
                    ?>
                    <a <?php echo $class?> href="<?php echo base_url()?>superadmin/pengaturan/responsi/<?php echo $result["responsi_hari"]?>"><?php echo $result["responsi_hari"]?></a>&nbsp;&nbsp;|
                    <?php
                }
                ?>
            </span>
        </div>
        <?php
        }
        ?>
        <table class="tablesorter" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>Ruang</th>
                    <th align="center">Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($responsi)
                {
                    $no = 1;
                    foreach($responsi as $result)
                    {
                        ?>
                        <tr>
                            <td align="center"><?php echo $no?></td>
                            <td><?php echo $result["responsi_hari"]?>, <?php echo date("d-M-Y",human_to_unix($result["responsi_tanggal"]));?></td>
                            <td><?php echo $result["responsi_jam"]?></td>
                            <td><?php echo $result["responsi_ruang"]?></td>
                            <td align="center">
                                <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["responsi_id"]?>)"/>
                                <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["responsi_id"]?>)"/>
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
                        <td colspan="6" align="center" class="no-data">Tidak ada data jadwal responsi</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <footer>
            <div class="submit_link left-float">
                <input type="submit" id="submit-responsi" value="Tambah Jadwal Responsi">
            </div>
        </footer>
    </article>
    <?php echo $sidebar?>
    <div class="spacer"></div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#submit-responsi").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/pengaturan/responsi/tambah"; 
       }); 
    });
    
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin ingin menghapus Jadwal ini?");
        if(conf){
            window.location.href = "<?php echo base_url()?>superadmin/pengaturan/responsi/hapus/"+id;
        }
    }
    
    function edit(id){
        window.location.href = "<?php echo base_url()?>superadmin/pengaturan/responsi/edit/"+id;
    }
</script>