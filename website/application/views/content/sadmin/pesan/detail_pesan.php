<section id="main" class="column">
    <article class="module width_3_quarter">
        <header><h3>Detail Pesan</h3></header>
        <div class="horison-padding vertical-padding">
            <?php
            if($pesan)
            {
               ?>
                <div><small style="color:gray"><?php echo date("d-M-Y h:i:s A",human_to_unix($pesan["saran_tanggal"]))?></small></div>
                <table>
                    <tr>
                        <td><h3>Pengirim</h3></td><td> : </td><td><?php echo $pesan["user_id"]?></td>
                    </tr>
                    <tr>
                        <td><h3>Pesan</h3></td><td> : </td><td><?php echo $pesan["saran_pesan"]?></td>
                    </tr>
                </table>
               <?php
            }
            
            ?>
        </div>
        <footer>
            <div class="submit_link">
                <input type="submit" class="alt_btn pesan" value="List Pesan" title="List Pesan">
            </div>
        </footer>
    </article>

</section>
<script type="text/javascript">
    $(document).ready(function(){
        $(".pesan").click(function(){
            window.location.href = "<?php echo base_url()?>superadmin/pesan"; 
        });
    })
</script>