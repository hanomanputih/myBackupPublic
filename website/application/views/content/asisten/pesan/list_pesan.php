<section id="main" class="column">
    <article class="module width_full">
        <header><h3>Pesan</h3></header>
        <table class="tablesorter" cellspacing="0">
            <thead>
                <tr>
                    <th align="center" width="50px">No</th>
                    <th align="center" width="100px">Pengirim</th>
                    <th width="200px">Tanggal</th>
                    <th width="500px">Pesan</th>
                    
                    <th align="center">Aksi</th>
                </tr>
                </thead>
                <tbody>
                        <?php
                        if($pesan)
                        {
                            $no = 1;
                          foreach($pesan as $result)
                          {
                              ?>
                              <tr <?php if($result['saran_status'] == 0){ echo 'class="bg-gray"';}?>>
                                  <td align="center" ><?php echo $no?></td>
                                  <td align="center"><?php echo $result["user_id"]?></td>
                                  <td><?php echo date("d-M-Y, h:i:s A",human_to_unix($result["saran_tanggal"]))?></td>
                                  <td><?php echo word_limiter($result["saran_pesan"],6)?> [ <a href="<?php echo base_url()?>asisten/pesan/detail/<?php echo $result["saran_id"]?>">detail</a> ]</td>
                                  <td align="center">
                                      <input type="image" src="<?php echo base_url()?>public/images/icn_trash.png" title="Hapus" onclick="hapus(<?php echo $result["saran_id"]?>)">
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
                                    <td colspan="7" align="center" class="no-data">Tidak ada pesan</td>
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
<script type="text/javascript">
    function hapus(id){
        var conf = window.confirm("Apakah Anda ingin menghapus pesan ini?");
        if(conf){
            $.post(
            "<?php echo base_url()?>asisten/pesan/hapus",
            {"id":id},
            function(data){
                if(data.status){
                    window.alert("Pesan berhasil dihapus");
                }
                else{
                    window.alert("Pesan gagal dihapus");
                }
                window.location.reload();
            },"json");
        }
        
    }
</script>
