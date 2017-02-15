<style type="text/css">
</style>
<section id="main" class="column">
    <article class="module width_full">
        <header><h3>Jadwal Responsi</h3><span>Jadwal aktif : <?php echo $jumlah?> dari <?php echo $total?></span></header>
        <?php
            $url = $this->uri->segment(4);
            ?>
            <div class="list-kelas">
                <span class="data-kelas">
                        <?php
                        $day = array("senin"=>"senin","selasa"=>"selasa","rabu"=>"rabu","kamis"=>"kamis","jumat"=>"jum'at","sabtu"=>"sabtu","minggu"=>"minggu");
                        foreach($day as $result=>$val)
                        {
                            if($url == $result)
                            {
                                $class = "class='active'";
                            }
                            else
                            {
                                $class = "";
                            }   
                            ?>
                            <a <?php echo $class?> href="<?php echo base_url()?>superadmin/kcb/responsi/<?php echo $result?>"><?php echo $val?></a>&nbsp;&nbsp;|
                            <?php
                        }
                    ?>
                </span>
            </div>
            <?php
        ?>
        <table class="tablesorter" cellspacing="0">
            <thead>
                <tr>
                    <th align="center">No</th>
                    <th>Hari</th>
                    <th>Tanggal</th>
                    <th>Jam</th>
                    <th>Ruang</th>
                    <th>Aksi</th>
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
                            <td><?php echo $result["responsi_hari"]?></td>
                            <td><?php echo date("d-M-Y",human_to_unix($result["responsi_tanggal"]))?></td>
                            <td><?php echo $result["responsi_jam"]?></td>
                            <td><?php echo $result["responsi_ruang"]?></td>
                            <td>
                                <?php if($this->session->userdata("ta_status") == "active"){?>
                                <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" id="edit" onclick="edit(<?php echo $result["responsi_id"]?>)">
                                <?php }?>
                                <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" id="hapus" onclick="hapus(<?php echo $result["responsi_id"]?>)">
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
            <div class="submit_link">
                <?php if($this->session->userdata("ta_status") == "active"){?>
                <input type="submit" id="tambah-responsi" value="Tambah Responsi" title="Tambah Responsi"/>
                <?php }?>
                <input type="submit" id="hapus-semua" class="alt_alert" value="Hapus Semua" title="Hapus Semua"/>
            </div>
        </footer>
    </article>
    <div class="spacer"></div>
</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tambah-responsi").click(function(){
            window.location.href = "<?php echo base_url()?>superadmin/kcb/responsi/tambah";
        })

        $("#hapus-semua").click(function(){
            var conf = window.confirm("Apakah Anda yakin menghapus semua jadwal responsi?\nSemua data yang berhubungan dengan jadwal responsi akan terhapus");
            if(conf){
                $.post("<?php echo base_url()?>superadmin/kcb/responsi_hapus",
                    {hapus:1},
                    function(data){
                        if(data){
                            window.alert("Semua jadwal berhasil dihapus");
                            window.location.reload();
                        }else{
                            window.alert("Jadwal gagal dihapus");
                            window.location.reload();
                        }
                    }
                    )
            }
        })
    })
    function edit(id){
        window.location.href="<?php echo base_url()?>superadmin/kcb/responsi/edit/"+id;
    }
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin ingin menghapus jadwal ini?\nData yang berhubungan dengan jadwal ini juga akan dihapus");
        if(conf){
            $.post("<?php echo base_url()?>superadmin/kcb/responsi/hapus",
            {"id_responsi":id},
            function(data){
                if(data){
                    window.alert("Jadwal berhasil dihapus");
                    window.location.reload();
                }else
                {
                    window.alert("Jadwal gagal dihapus");
                }
            })
        }  
    }
</script>