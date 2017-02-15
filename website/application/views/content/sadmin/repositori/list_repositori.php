<section id="main" class="column">
		<article class="module width_full">
			<header><h3>List Repositori</h3></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
                                    <th align="center">No</th> 
                                    <th>Nama</th> 
                                    <th>Format File</th> 
                                    <th align="center">Tanggal</th>
                                    <th align="center">Download</th>
                                    <th align="center">Aksi</th> 
				</tr> 
			</thead> 
			<tbody>
                            <?php
                            if($repo)
                            {
                                $no = 1;
                                foreach($repo as $result)
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td><a href="<?php echo base_url()?>_data/filerepo/<?php echo $result["repo_file"]?>" target="_blank"><?php echo $result["repo_nama"]?></a></td>
                                        <td><?php echo $result["repo_tipe_file"]?></td>
                                        <td align="center"><?php echo date("D, d-M-Y | h:i A",human_to_unix($result["repo_tanggal"]))?></td>
                                        <td align="center"><?php echo $result["repo_lihat"]?></td>
                                        <td align="center">
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["repo_id"]?>)"/>
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["repo_id"]?>)"/>
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
                                    <td colspan="6" class="no-data" align="center">Tidak ada data rapositori</td>
                                </tr>
                                <?php
                            }
                            ?>
			</tbody> 
			</table>
                        <footer>
                            <div class="submit_link">
                                <input type="submit" id="tambah" value="Tambah Repositori" title="Tambah Repositori"/>
                            </div>
                        </footer>
                        
		</article><!-- end of styles article -->
                <div class="spacer"></div>
	</section>
<script type="text/javascript">
        $(document).ready(function(){
            $("#tambah").click(function(){
                window.location.href = "<?php echo base_url()?>superadmin/repositori/tambah";
            })
        })
//    function edit(id){
//        window.location.href = "<?php echo base_url()?>superadmin/berita/edit/"+id;
//    }
    function hapus(id){
        var conf = window.confirm("Apakah Anda yakin ingin menghapus berita ini?");
        if(conf){
            window.location.href = "<?php echo base_url()?>superadmin/repositori/hapus/"+id;
        }
    }
</script>
