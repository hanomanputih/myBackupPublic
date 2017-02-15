<section id="main" class="column">
		<article class="module width_3_quarter">
			<header><h3>Daftar Kelas Teori</h3></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
                                    <th align="center">No</th> 
                                    <th>Nama Kelas</th> 
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
                                        <td><a href="<?php echo base_url()?>superadmin/kcb/mahasiswa/<?php echo $result["kelas_nama"]?>">Kelas <?php echo $result["kelas_nama"]?></a></td>
                                        <td align="center">
                                            <?php
                                            $count = $jumlah->getCountDataKcbById($result["kelas_id"]);
                                            if($count)
                                            {
                                                echo $count["jumlah"];
                                            }
                                            else
                                            {
                                                echo "0";
                                            }
                                            ?>
                                        </td>
                                        <td align="center">
                                            <?php if($this->session->userdata("ta_status") == "active"){?>
                                            <input type="image" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["kelas_id"]?>)"/>
                                            <?php }?>
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
                            <?php if($this->session->userdata("ta_status") == "active"){?>
                            <div class="submit_link">
                                <input type="submit" id="tambah" value="Tambah Kelas" title="Tambah Kelas"/>
                            </div>
                            <?php }?>
                        </footer>
                        
		</article><!-- end of styles article -->
                <div class="spacer"></div>
	</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#tambah").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/kelas/tambah"; 
       });
       
    });

function edit(id){
    window.location.href = "<?php echo base_url()?>superadmin/kcb/kelas/edit/"+id;
}
function hapus(id){
    var konf = window.confirm("Apakah Anda yakin menghapus kelas ini?\nData yang ada di kelas ini juga akan dihapus");
    if(konf){
        $.post("<?php echo base_url()?>superadmin/kcb/kelas/hapus",
            {id_kelas:id},
            function(data){
                if(data){
                    window.alert("Data kelas berhasil dihapus");
                    window.location.reload();
                }else{
                    window.alert("Data kelas gagal dihapus");
                }
            })
    }
}

</script>