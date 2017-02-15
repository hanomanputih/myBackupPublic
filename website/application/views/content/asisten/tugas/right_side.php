<article class="module width_quarter">
        <header><h3>Pertemuan</h3></header>
        <div class="message_list">
                <div class="module_content">
                    <?php
                    if($modul)
                    {
                        foreach($modul as $result)
                        {
                        ?>
                        <div class="message"><p><a href="#"><?php echo $result["modul_nama"]?></a></p></div>
                        <?php
                        }
                    }
                    else
                    {
                        ?>
                        <div class="message no-data"><p>Tidak ada modul</p></div>
                        <?php
                    }
                    ?>
                </div>
        </div>
        <footer>
        </footer>
</article>