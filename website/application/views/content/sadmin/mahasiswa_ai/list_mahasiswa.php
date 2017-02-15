<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Mahasiswa KCB</h3><span>Jumlah Mahasiswa : <?php echo $total?></span></header>
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
                                        <a <?php echo $class?> href="<?php echo base_url()?>superadmin/kcb/mahasiswa/<?php echo $result["kelas_nama"]?>"><?php echo $result["kelas_nama"]?></a>&nbsp;&nbsp;|
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
                                    <th align="center">Angkatan</th>
                                    <th>Kelas</th>
                                    <th align="center">Aksi</th>
				</tr> 
			</thead> 
			<tbody>
                            <?php
                            if($mahasiswa)
                            {
                                $no = 1;
                                foreach($mahasiswa as $result)
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td><?php echo $result["praktikan_nim"]?></td>
                                        <td><?php echo $result["praktikan_nama"]?></td>
                                        <td align="center">20<?php echo substr($result["praktikan_nim"],0,2)?></td>
                                        <td>Kelas <?php echo $result["kelas_nama"]?></td>
                                        <td align="center">
                                            <input type="image" value="<?php echo $result["kelas_id"]?>" id="edit" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["praktikan_id"]?>)"/>
                                            <input type="image" id="hapus" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["praktikan_id"]?>)"/>
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
                            <div class="submit_link">
                                <?php if($this->session->userdata("ta_status") == "active"){?>
                                <input type="submit" id="tambah-mahasiswa" value="Tambah Mahasiswa" title="Tambah Praktikan"/>
                                <?php }?>
                            </div>
                            <div class="submit_link right-float twenty-right-padding">
                                <input type="text" id="quick" style="width:150px" class="ten-radius" placeholder="Cari">
                            </div>
                        </footer>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>
<script type="text/javascript">
    $(document).ready(function(){
        $("#tambah-mahasiswa").click(function(){
            window.location.href = "<?php echo base_url()?>superadmin/kcb/mahasiswa/tambah";
        });

       
    })
    function edit(id){
       window.location.href = "<?php echo base_url()?>superadmin/kcb/mahasiswa/edit/"+id; 
    }
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin untuk menghapus data praktikan ini?");
        if(conf){
            $.post("<?php echo base_url()?>superadmin/kcb/mahasiswa/hapus",{
                id_mahasiswa : id
            },function(data){
                if(data){
                    window.alert("Data mahasiswa berhasil dihapus");
                    window.location.reload();
                }else{
                    window.alert("Data mahasiswa gagal dihapus");
                }
            })
        }
    }
</script>