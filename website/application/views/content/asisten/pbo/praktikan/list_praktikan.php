<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Praktikan PBO</h3><span>Total praktikan : <?php echo $total?></span></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead>
                            <?php
                            if($kelas)
                            {
                                $url = $this->uri->segment(4);
                             ?>
                            <div class="list-kelas">
                                <span class="data-kelas">
                                    <?php
                                    foreach($kelas as $result)
                                    {
                                        if($url == $result["kelas_nama"])
                                        {
                                            $class = "class = 'active'";
                                        }
                                        else
                                        {
                                            $class = "";
                                        }
                                        ?>
                                        <a <?php echo $class?> href="<?php echo base_url()?>superadmin/pbo/praktikan/<?php echo $result["kelas_nama"]?>"><?php echo $result["kelas_nama"]?></a>&nbsp;&nbsp;|
                                        <?php
                                    }
                                    ?>
                                </span>
                                </div>
                             <?php   
                            }
                            ?>
				<tr> 
                    <th align="center">No</th> 
                    <th>NIM</th> 
                    <th>Nama</th> 
                    <!-- <th align="center">Angkatan</th> -->
                    <th>Kelas</th>
                    <th align="center">Aksi</th>
				</tr> 
			</thead> 
			<tbody>
                            <?php
                            if($pbo)
                            {
                                $no = 1;
                                foreach($pbo as $result)
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td><?php echo $result["pbo_nim"]?></td>
                                        <td><?php echo $result["pbo_nama"]?></td>
                                        <!-- <td align="center"><?php echo $result["pbo_angkatan"]?></td> -->
                                        <td>Kelas <?php echo $result["kelas_nama"]?></td>
                                        <td align="center">
                                            <input type="image" id="edit" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["pbo_id"]?>)"/>
                                            <input type="image" id="hapus" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["pbo_id"]?>)"/>
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
                                    <td colspan="6" align="center" class="no-data">Tidak ada data praktikan</td>
                                </tr>
                                <?php
                            }
                            ?>
			</tbody> 
			</table>
                        <footer>
                            <?php if($this->session->userdata("ta_status") == "active"){?>
                            <div class="submit_link">
                                <input type="submit" id="tambah-praktikan" value="Tambah praktikan" title="Tambah Praktikan"/>
                            </div>
                            <?php }?>
                        </footer>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tambah-praktikan").click(function(){
            window.location.href = "<?php echo base_url()?>superadmin/pbo/praktikan/tambah";
        });
    })
    function edit(id){
       window.location.href = "<?php echo base_url()?>superadmin/pbo/praktikan/edit/"+id; 
    }
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin untuk menghapus data praktikan ini?");
        if(conf){
            // window.location.href = "<?php echo base_url()?>superadmin/pbo/praktikan/hapus/"+id;
            $.post("<?php echo base_url()?>superadmin/pbo/praktikan/hapus",
                {"id":id},
                function(data){
                    if(data){
                        window.location.reload();
                    }
                })
        }
    }
</script>