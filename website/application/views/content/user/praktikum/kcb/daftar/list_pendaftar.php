<div id="cB1">
        <h3>KELAS PRAKTIKUM</h3>
        <div class="main-content">
            <div style="margin-bottom: 10px;">
                <div class="content">
                <?php
                if($list_kelas)
                {
                    ?>
                    <table class="list-table" cellspacing="0">
                        <thead>
                            <tr>
                                <th align="center">No</th>
                                <th>Kelas</th>
                                <th>Tanggal</th>
                                <th align="center">Jam</th>
                                <th>Ket</th>
                                <th align="center">Kuota</th>
                                <th align="center">Sisa</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $jumlah;
                            foreach($list_kelas as $result)
                            {
                                $sisa;
                                            $data = $jumlah_praktikan->getCountUserDaftarById($result["kelas_id"]);
                                            if($data)
                                            {
                                                $sisa = $result["kelas_kuota"]-$data["jumlah"];
                                            }
                                            else
                                            {
                                                $sisa =  $result["kelas_kuota"];
                                            }
                                            

                                if($no%2 == 0)
                                {
                                    ?>
                                     <tr>
                                        <td align="center"><?php echo $no?></td>
                                        <td>
                                            
                                            <a href="<?php echo base_url()?>kcb/pendaftaran/daftar/<?php echo $result["kelas_id"]?>">Kelas <?php echo $result["kelas_nama"]?></a>
                                        </td>
                                        <td><?php echo $result["kelas_hari"].", ".date("d-M-Y",human_to_unix($result["kelas_tanggal"]))?></td>
                                        <td align="center"><?php echo $result["kelas_jam"]?></td>
                                        <td><?php echo $result["kelas_keterangan"]?></td>
                                        <td align="center"><?php echo $result["kelas_kuota"]?></td>
                                        <td align="center">
                                            <?php
                                            echo $sisa;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                else
                                {
                                    ?>
                                    <tr class="white">
                                        <td align="center"><?php echo $no?></td>
                                        <td>
                                            <a href="<?php echo base_url()?>kcb/pendaftaran/daftar/<?php echo $result["kelas_id"]?>">Kelas <?php echo $result["kelas_nama"]?></a>
                                        </td>
                                        <td><?php echo $result["kelas_hari"].", ".date("d-M-Y",human_to_unix($result["kelas_tanggal"]))?></td>
                                        <td align="center"><?php echo $result["kelas_jam"]?></td>
                                        <td><?php echo $result["kelas_keterangan"]?></td>
                                        <td align="center"><?php echo $result["kelas_kuota"]?></td>
                                        <td align="center">
                                            <?php
                                            echo $sisa;
                                            ?>
                                        </td>
                                    </tr>
                                    <?php
                                }
                                ?>
                                
                                <?php
                                $no++;
                                $jumlah = $result["kelas_kuota"];
                            }
                            ?>
                        </tbody>
                    </table>
                    
                    <p>
                        *) Klik pada kelas untuk melakukan pendaftaran. Setiap kelas dibatasi hanya <?php echo $jumlah?> praktikan. Dan Silahkan masukkan NIM dan nama Anda.
                    </p>
                    <?php
                }
                else
                {
                    ?>
                    <p class="no-class" style="border-bottom: 1px dotted gray">Tidak ada data kelas</p>
                    <?php
                }
                ?>
                </div>
            </div>
        </div>
</div>

