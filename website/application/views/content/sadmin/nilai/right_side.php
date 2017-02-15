<article class="module width_quarter">
        <header><h3>Tahun Ajaran</h3></header>
        <div class="message_list">
                <div class="module_content">
                        <?php
                        if($ta)
                        {
                                foreach($ta as $result)
                                {
                                ?>
                               <div class="message"><p><a href="<?php echo base_url()?>superadmin/pbo/nilai/ta/<?php echo $result["ta_nama"]?>">Tahun ajaran <?php echo $result["ta_nama"]?></a></p></div>         
                               <?php
                               }
                        }
                        else
                        {
                                ?>
                                <div class="message no-data"><p>Tidak ada tahun ajaran</p></div>
                                <?php
                        }
                        ?>
                        
                </div>
        </div>
        <footer>
        </footer>
</article>