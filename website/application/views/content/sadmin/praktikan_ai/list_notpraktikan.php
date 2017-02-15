<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Praktikan KCB</h3><span>Jumlah Praktikan : <?php echo $jumlah;?> dari <?php echo $total?></span></header>
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
                                        <a <?php echo $class?> href="<?php echo base_url()?>superadmin/kcb/praktikan/<?php echo $result["kelas_nama"]?>"><?php echo $result["kelas_nama"]?></a>&nbsp;&nbsp;|
                                        <?php
                                    }
                                    if($url == "belum-daftar")
                                    {
                                        $class = "class = 'active'";
                                    }
                                    else
                                    {
                                        $class = "class = 'no-data'";
                                    }
                                    ?>
                                    <a <?php echo $class?> href="<?php echo base_url()?>superadmin/kcb/praktikan/belum-daftar">Belum daftar</a> |
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
                            if($praktikan_ai)
                            {
                                $no = 1;
                                foreach($praktikan_ai as $result)
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td><?php echo $result["praktikan_nim"]?></td>
                                        <td><?php echo $result["praktikan_nama"]?></td>
                                        <td align="center">20<?php echo substr($result["praktikan_nim"],0,2)?></td>
                                        <td>Kelas <?php echo $result["kelas_nama"]?></td>
                                        <td align="center">
                                            <?php if($this->session->userdata("ta_status") == "active"){?>
                                             <input type="image" class="edit" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" value="<?php echo $result["praktikan_nim"]?>"/>
                                             <?php
                                            }
                                            else
                                            {
                                                echo "-";
                                            }
                                             ?>
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
                            
                        </footer>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>
<script type="text/javascript">
    $(document).ready(function(){
        $(".edit").click(function(){
            var nim = $(this).val();
            window.location.href = "<?php echo base_url()?>superadmin/kcb/praktikan/tambah/"+nim;
        })
    })
</script>