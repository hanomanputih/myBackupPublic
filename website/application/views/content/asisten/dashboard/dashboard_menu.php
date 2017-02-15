<section id="main" class="column">
    <article class="module width_quarter">
        <header><h3>Akun</h3></header>
        <div class="horison-padding vertical-padding">
            <table class="list-table">
                <tr>
                    <td><strong>NIM</strong></td><td><?php echo $akun["user_username"]?></td>
                </tr>
                <tr>
                    <td><strong>Nama</strong></td><td><?php echo $akun["user_nama"]?></td>
                </tr>
                <tr>
                    <td><strong>Jenis Kelamin</strong></td><td><?php echo $akun["user_jenis_kelamin"]?></td>
                </tr>
                <tr>
                    <td><strong>Angkatan</strong></td><td><?php echo $akun["user_angkatan"]?></td>
                </tr>
                <tr>
                    <td><strong>Jabatan</strong></td><td><?php echo $akun["jabatan_nama"]?></td>
                </tr>
            </table>
         </div>
    </article>
    <article class="module width_quarter">
        <header><h3>Aktif Akun</h3></header>
        <div class="horison-padding vertical-padding">
            <?php
            if($user)
            {
                ?>
                <table class="list-table capitalize">
                <?php
                foreach($user as $result)
                {
                    ?>
                    <tr><td><strong><?php echo $result["user_username"]?></strong></td><td><?php echo $result["user_nama"]?></td>
                    <?php
                }
                ?>
                </table>
                <?php
            }
            else
            {
                ?>
                <div class="no-data center">TIDAK ADA</div>
                <?php
            }
            
            ?>
        </div>
    </article>
    <?php
//    $this->load->view("content/sadmin/dashboard/dash_pesan");
    ?>
</section>