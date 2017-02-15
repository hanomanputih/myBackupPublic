<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Kelas Praktikum</h3></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead> 
				<tr> 
                                    <th align="center">No</th> 
                                    <th>Nama Kelas</th> 
                                    <th>Tanggal</th> 
                                    <th align="center">Jam</th>
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
                                        <td><a href="<?php echo base_url()?>superadmin/kcb/praktikan/<?php echo $result["kelas_nama"]?>">Kelas <?php echo $result["kelas_nama"]?></a></td>
                                        <td><?php echo $result["kelas_hari"]?>, <?php echo date("d-M-Y",human_to_unix($result["kelas_tanggal"]))?></td>
                                        <td align="center"><?php echo $result["kelas_jam"]?></td>
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
                                    <td colspan="8" align="center" class="no-data">Tidak ada data kelas</td>
                                </tr>
                                <?php
                            }
                            ?>
			</tbody> 
			</table>
                        <footer>
                            <div class="submit_link">
                                <?php if($this->session->userdata("ta_status") == "active"){?>
                                <input type="submit" id="tambah" value="Tambah Kelas" title="Tambah Kelas"/>
                                <?php }?>
                                    <input type="submit" id="hapus" class="alt_alert" value="Hapus Semua" title="Hapus Semua"/>
                            </div>
                            
                        </footer>
                        
		</article><!-- end of styles article -->
                <div class="spacer"></div>
	</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#tambah").click(function(){
          window.location.href = "<?php echo base_url()?>superadmin/kcb/praktikum/tambah"; 
       });
       $("#hapus").click(function(){
        var conf = window.confirm("Apakah Anda yakin menghapus semua kelas?\nData yang berhubungan dengan kelas ini akan terhapus");
        if(conf){
            $.post("<?php echo base_url()?>superadmin/kcb/kelas_hapus",
                {hapus:1},
                function(data){
                    if(data){
                        window.alert("Semua kelas berhasil dihapus");
                    }else{
                        window.alert("Kelas gagal dihapus");
                        
                    }
                    window.location.reload();
                })
        }

       })
       
    });

function edit(id){
    window.location.href = "<?php echo base_url()?>superadmin/kcb/praktikum/edit/"+id;
}
function hapus(id){
    var konf = window.confirm("Apakah Anda yakin menghapus kelas ini?\nData yang ada di kelas ini juga akan dihapus");
    if(konf){
        $.post("<?php echo base_url()?>superadmin/kcb/praktikum/hapus",
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