<section id="main" class="column">
		<article class="module width_full">
			<header><h3>Daftar Kelas Praktikum</h3></header>
                        <table class="tablesorter" cellspacing="0"> 
			<thead>
                            <?php
                            if($kelas)
                            {
                                $url = $this->uri->segment(5);
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
                                        <a <?php echo $class?> href="<?php echo base_url()?>asisten/kelas/ai/praktikan/<?php echo $result["kelas_nama"]?>"><?php echo $result["kelas_nama"]?></a>&nbsp;&nbsp;|
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
                                        <td><?php echo $result["daftar_nim"]?></td>
                                        <td><?php echo $result["daftar_nama"]?></td>
                                        <td align="center"><?php echo $result["daftar_angkatan"]?></td>
                                        <td>Kelas <?php echo $result["kelas_nama"]?></td>
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
                                <input type="submit" id="tambah-praktikan" value="Tambah praktikan" title="Tambah Praktikan"/>
                            </div>
                        </footer>
		</article><!-- end of styles article -->
		<div class="spacer"></div>
	</section>