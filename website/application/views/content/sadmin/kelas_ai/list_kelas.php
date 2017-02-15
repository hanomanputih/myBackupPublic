<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Kelas Praktikum</h3></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
                                    <th align="center">No</th> 
                                    <th>Nama Kelas</th> 
                                    <th>Tanggal</th> 
                                    <th>Jam</th>
                                    <th>Keterangan</th>
                                    <th align="center">Kuota</th>
                                    <th align="center">Jumlah</th>
                                    <th align="center">Aksi</th> 
				</tr> 
			</thead> 
			<tbody>
                            <?php
                            if($kelas_ai)
                            {
                                $no = 1;
                                foreach($kelas_ai as $result)
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td>Kelas <?php echo $result["kelas_nama"]?></td>
                                        <td><?php echo $result["kelas_hari"]?>, <?php echo $result["kelas_tanggal"]?></td>
                                        <td><?php echo $result["kelas_jam"]?></td>
                                        <td><?php echo $result["kelas_keterangan"]?></td>
                                        <td align="center"><?php echo $result["kelas_kuota"]?></td>
                                        <td align="center">
                                            <?php
                                            $data = $jumlah->getCountUserDaftarById($result["kelas_id"]);
                                            if($data)
                                            {
                                                echo $data["jumlah"];
                                            }
                                            else
                                            {
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["kelas_id"]?>)"/>
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Delete" onclick="hapus(<?php echo $result["kelas_id"]?>)"/>
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
                                    <td colspan="6" align="center" class="no-data">Tidak ada data kelas</td>
                                </tr>
                                <?php
                            }
                            ?>
			</tbody> 
			</table>
                        <footer>
                            <div class="submit_link">
                                <input type="submit" id="tambah" value="Tambah Kelas" title="Tambah Kelas"/>
                            </div>
                        </footer>
                        
		</article><!-- end of styles article -->
                <div class="spacer"></div>
	</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#tambah").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kelas/ai/tambah"; 
       });
       
    });

function edit(id){
    window.location.href = "<?php echo base_url()?>superadmin/kelas/ai/edit/"+id;
}
function hapus(id){
    var konf = window.confirm("Apakah Anda yakin menghapus kelas ini?");
    if(konf){
        window.location.href = "<?php echo base_url()?>superadmin/kelas/ai/hapus/"+id;
    }
}

</script>