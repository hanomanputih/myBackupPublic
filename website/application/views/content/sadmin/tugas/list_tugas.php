<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Tugas</h3><h4>Kelas aktif : <?php if($aktif){?>Kelas <?php echo $aktif["kelas_nama"];}else{echo "Tidak ada";}?></h4></header>
                        <?php
                        if($kelas_tugas)
                        {
                            $url = $this->uri->segment(4);
                        ?>
                        <div class="list-kelas">
                            <span class="data-kelas">
                                <?php
                                foreach($kelas_tugas as $result)
                                {
                                    if($url == $result["kelas_nama"])
                                    {
                                        $class = "class='active'";
                                    }
                                    else
                                    {
                                        $class = "";
                                    }
                                    ?>
                                    <a <?php echo $class?> href="<?php echo base_url()?>superadmin/tugas/kelas/<?php echo $result["kelas_nama"]?>"><?php echo $result["kelas_nama"]?></a>&nbsp;&nbsp;|
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
                                    <th>Kelas</th>
                                    <th>NIM</th> 
                                    <th>Nama</th>
                                    <th>Pertemuan</th>
                                    <th>Asisten Pembimbing</th>
                                    <th>Tanggal</th>
                                    <th colspan="2">Aksi</th> 
				</tr> 
			</thead> 
			<tbody>
                            <?php
                            if($tugas)
                            {
                                $no = 1;
                                foreach($tugas as $result)
                                {
                            ?>
                                    <tr>
                                        <td align="center"><?php echo $no;?></td>
                                        <td>Kelas <?php echo $result["kelas_nama"]?></td>
                                        <td><?php echo $result["tugas_nim"]?></td>
                                        <td><?php echo $result["tugas_nama"]?></td>
                                        <td>Pertemuan <?php echo $result["modul_pertemuan"]?></td>
                                        <td><?php echo $result["user_nama"]?></td>
                                        <td><?php echo $result["tugas_tanggal"]?></td>
                                        <td>
                                            <a href="<?php echo base_url()?>_data/filetugas/<?php echo $result["tugas_file"]?>"><input type="image" src="<?php echo base_url()?>public/images/icn_downld.png" title="Download"></a>
                                            
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["tugas_id"]?>)" />
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
                                    <td colspan="7" align="center" class="no-data">Tidak ada tugas yang tersimpan</td>
                                </tr>
                                <?php
                            }
                            ?>
			</tbody> 
			</table>
                        <footer>
                            <div class="submit_link">
<!--                                <form class="quick_search">-->
                                    <input type="text" style="width:150px" class="ten-radius" placeholder="Cari" onfocus="if(!this._haschanged){this.value=''};this._haschanged=true;">
<!--                                </form>-->
                            </div>
                        </footer>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>
        
    <script type="text/javascript">
        function hapus(id){
            var conf = window.confirm("Apakah Anda yakin ingin menghapus tugas ini?");
            if(conf){
                $.post(
                    "<?php echo base_url()?>superadmin/tugas/hapus",
                    {"id":id},
                    function(data){
                        if(data == 1){
                            window.location.href = "<?php echo base_url().uri_string()?>"
                        }
                    }
                    
                );
            }
        }
    </script>