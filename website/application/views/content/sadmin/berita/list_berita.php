<section id="main" class="column">
		<article class="module width_full">
			<header><h3>List Berita</h3></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
                                    <th align="center">No</th> 
                                    <th>Judul</th> 
                                    <th>Penulis</th> 
                                    <th align="center">Kategori</th>
                                    <th align="center">File</th>
                                    <th>Tanggal</th>
                                    <th align="center">Lihat</th>
                                    <th align="center">Aksi</th> 
				</tr> 
			</thead> 
			<tbody>
                            <?php
                            if($berita)
                            {
                                $no = 1;
                                foreach($berita as $result)
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td width="300px"><a href="<?php echo base_url()?>superadmin/berita/detail/<?php echo $result["berita_title"]?>"><?php echo $result["berita_judul"]?></a></td>
                                        <td><?php echo $result["user_username"]?></td>
                                        <td align="center"><?php echo $result["berita_kategori"]?></td>
                                        <td align="center">
                                            <?php
                                            if($result["berita_file"])
                                            {
                                                echo "ADA";
                                            }
                                            else
                                            {
                                                echo "TIDAK ADA";
                                            }
                                            ?>
                                        </td>
                                        <td><?php echo date("d-M-Y h:i A",  human_to_unix($result["berita_tanggal"]))?></td>
                                        <td align="center"><?php echo $result["berita_lihat"]?></td>
                                        <td align="center">
                                            <?php if($this->session->userdata("ta_status") == "active"){?>
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["berita_id"]?>)"/>
                                            <?}?>
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["berita_id"]?>)"/>
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
                                    <td colspan="7" class="no-data" align="center">Tidak ada data berita</td>
                                </tr>
                                <?php
                            }
                            ?>
			</tbody> 
			</table>
                        <footer>
                        </footer>
                        
		</article><!-- end of styles article -->
                <div class="spacer"></div>
	</section>
<script type="text/javascript">
    function edit(id){
        window.location.href = "<?php echo base_url()?>superadmin/berita/edit/"+id;
    }
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin ingin menghapus berita ini?");
        if(conf){
            window.location.href = "<?php echo base_url()?>superadmin/berita/hapus/"+id;
        }
    }
</script>
