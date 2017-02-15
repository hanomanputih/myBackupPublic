<section id="main" class="column">
    <article class="module width_3_quarter">
        <header><h3>Dashboard</h3></header>
        <div class="horison-padding vertical-padding left-float">
            <h3>Latest Login</h3>
            <?php
            if($last_login)
            {
                ?>
                <table class="list-table capitalize">
                <?php
                foreach($last_login as $result)
                {
                    ?>
                    <tr><td><strong><?php echo $result["user_nama"]?></strong></td><td><?php echo date("d-M-Y, h:i:s A",human_to_unix($result["user_login"]))?></td>
                    <?php
                }
                ?>
                </table>
                <?php
            }
            
            ?>
        </div>
         <div class="vertical-padding horison-padding">
                <h3>Akun Aktif</h3>
                <table class="horison-padding list-table">
                    <?php
                    if($user)
                    {
                        foreach($user as $result)
                        {
                            ?>
                            <tr>
                                <td><?php echo $result["user_username"]?></td>
                                <td><?php echo $result["user_nama"]?></td>
                            </tr>
                            <?php
                        }
                    }
                    else
                    {
                        ?>
                        <tr><td><span class="red">Tidak ada</span></td></tr>
                        <?php
                    }
                    ?>
                </table>
            </div>
    </article>
    <?php
//    $this->load->view("content/sadmin/dashboard/dash_pesan");
    ?>
</section>