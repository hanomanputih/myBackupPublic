<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
?>
<article class="module width_quarter">
        <header><h3>Pesan</h3></header>
        <div class="message_list">
                <div class="module_content">
                    <?php
                    if($pesan)
                    {
                        foreach($pesan as $result)
                        {
                            ?>
                            <div class="message">
                                <p><?php echo word_limiter($result["saran_pesan"],5)?> ( <a href="<?php echo base_url()?>asisten/pesan/detail/<?php echo $result["saran_id"]?>">Lihat</a> )</p>
                                <p><strong><?php echo $result["user_id"]?></strong> | <?php echo date("d-M-Y, H:i:s A",human_to_unix($result["saran_tanggal"]))?></p>
                            </div>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                    <div class="message no-data center"><p>TIDAK ADA PESAN</p></div>
                        <?php
                    }
                    ?>
                </div>
        </div>
        <footer>
                
        </footer>
</article>