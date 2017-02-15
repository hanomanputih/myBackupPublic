<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Mahasiswa KCB</h3></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
                                    <th align="center">No</th> 
                                    <th align="center">NIM</th> 
                                    <th>Nama</th> 
                                    <th>Angkatan</th>
                                    <th>Kelas (Teori)</th>
                                    <th align="center">Aksi</th>
				</tr> 
			</thead> 
			<tbody>
                            <?php
                            if($data)
                            {
                                $no = 1;
                                foreach($data as $result)
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td align="center"> <?php echo $result["praktikan_nim"]?></td>
                                        <td><?php echo $result["praktikan_nama"]?></td>
                                        <td>20<?php echo substr($result["praktikan_nim"],0,2)?></td>
                                        <td>Kelas <?php echo $result["praktikan_kelas"]?></td>
                                        <td align="center">
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["praktikan_id"]?>)"/>
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Delete" onclick="hapus(<?php echo $result["praktikan_id"]?>)"/>
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
                                    <td colspan="6" align="center" class="no-data">Tidak ada data mahasiswa</td>
                                </tr>
                                <?php
                            }
                            ?>
			</tbody> 
			</table>
                        <footer>
                            <div class="submit_link">
                                <input type="submit" id="tambah" value="Tambah Mahasiswa" title="Tambah Mahasiswa"/>
                            </div>
                        </footer>
                        
		</article><!-- end of styles article -->
                <div class="spacer"></div>
	</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#tambah").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/data/tambah"; 
       });
       
    });

function edit(id){
    window.location.href = "<?php echo base_url()?>superadmin/data/edit/"+id;
}
function hapus(id){
    var konf = window.confirm("Apakah Anda yakin menghapus mahasiswa ini?");
    if(konf){
        window.location.href = "<?php echo base_url()?>superadmin/data/hapus/"+id;
    }
}

</script>