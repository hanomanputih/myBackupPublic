<section id="main" class="column">
        <article class="module width_full">
            <header><h3>Data Responsi KCB</h3><span>Jumlah Praktikan : <?php echo $jumlah;?> dari <?php echo $total?></span></header>
                        <table class="tablesorter" cellspacing="0"> 
            <thead>
                            
                <div class="list-kelas">
                    <span class="data-kelas">
                       <?php
                       $url = $this->uri->segment(5);
                        $day = array("senin"=>"senin","selasa"=>"selasa","rabu"=>"rabu","kamis"=>"kamis","jumat"=>"jum'at","sabtu"=>"sabtu","minggu"=>"minggu");
                        foreach($day as $result=>$val)
                        {
                            if($url == $result)
                            {
                                $class = "class='active'";
                            }
                            else
                            {
                                $class = "";
                            }   
                            ?>
                            <a <?php echo $class?> href="<?php echo base_url()?>superadmin/kcb/responsi/praktikan/<?php echo $result?>"><?php echo $val?></a>&nbsp;&nbsp;|
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
                        <a <?php echo $class?> href="<?php echo base_url()?>superadmin/kcb/responsi/praktikan/belum-daftar">Belum daftar</a> |
                    </span>
                    </div>
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
                            if($dataResponsi)
                            {
                                $no = 1;
                                foreach($dataResponsi as $result)
                                {
                                    ?>
                                    <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td><?php echo $result["praktikan_nim"]?></td>
                                        <td><?php echo $result["praktikan_nama"]?></td>
                                        <td align="center">20<?php echo substr($result["praktikan_nim"],0,2)?></td>
                                        <td>Kelas <?php echo $result["kelas_nama"]?></td>
                                        <td align="center">
                                            -   
                                            <!-- <input type="image" id="edit" src="<?php echo base_url()?>public/images/icn_edit.png" title="Edit" onclick="edit(<?php echo $result["daftar_id"]?>)"/>
                                            <input type="image" id="hapus" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["daftar_id"]?>)"/> -->
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
        $("#tambah-praktikan").click(function(){
            window.location.href = "<?php echo base_url()?>superadmin/kcb/praktikan/tambah";
        });
    })
</script>