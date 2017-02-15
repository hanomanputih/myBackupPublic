<section id="main" class="column">
    <article class="module width_full">
        <header><h3>Jadwal Responsi</h3></header>
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
                        if($url == $result["responsi_hari"])
                        {
                            $class = "class='active'";
                        }
                        else
                        {
                            $class = "";
                        }
                        ?>
                    <a <?php echo $class?> href="<?php echo base_url()?>asisten/kelas/ai/responsi/<?php echo $result["responsi_hari"]?>"><?php echo $result["responsi_hari"]?></a>&nbsp;&nbsp;|
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
                    <th>Hari</th>
                    <th>Jam</th>
                    <th>NIM</th>
                    <th>Nama</th>
                    <th>Ruang</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if($responsi)
                {
                    $no = 1;
                    foreach($responsi as $result)
                    {
                        ?>
                        <tr>
                            <td align="center"><?php echo $no?></td>
                            <td><?php echo $result["responsi_hari"]?>, <?php echo $result["responsi_tanggal"]?></td>
                            <td><?php echo $result["responsi_jam"]?></td>
                            <td></td>
                            <td></td>
                            <td><?php echo $result["responsi_ruang"]?></td>
                            <td></td>
                        </tr>
                        <?php
                        $no++;
                    }
                }
                else
                {
                    ?>
                    <tr>
                        <td colspan="6" align="center" class="no-data">Tidak ada data jadwal responsi</td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <footer>
        </footer>
    </article>
    <div class="spacer"></div>
</section>
