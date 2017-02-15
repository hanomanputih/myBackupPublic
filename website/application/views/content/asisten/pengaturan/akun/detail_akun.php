<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Detail Akun</h3></header>
        <table class="horison-padding vertical-padding">
            <input type="hidden" name="id" id="id" value="<?php echo $akun["user_id"]?>">
            <tr>
                <td class="bg-gray">Username</td><td><input type="text" name="username" class="readonly" readonly value="<?php echo $akun["user_username"]?>"></td>
            </tr>
            <tr>
                <td class="bg-gray">Nama Lengkap</td><td><input type="text" name="nama" class="readonly" readonly value="<?php echo $akun["user_nama"]?>"></td>
            </tr>
            <tr>
                <td class="bg-gray">Jenis Kelamin</td><td><input type="text" name="jk" class="readonly" readonly value="<?php echo $akun["user_jenis_kelamin"]?>">
            </tr>
            <tr>
                <td class="bg-gray">Angkatan</td><td><input type="text" name="angkatan" class="readonly" readonly value="<?php echo $akun["user_angkatan"]?>">
            </tr>
            <tr>
                <td class="bg-gray">Jabatan</td><td><input type="text" name="jabatan" class="readonly" readonly value="<?php echo $akun["jabatan_nama"]?>">
            </tr>
        </table>
        <footer>
            <div class="submit_link">
                <input type="submit" class="alt_btn" name="edit" id="edit" value="Ubah Password" title="Ubah Password"/>
            </div>
        </footer>
    </article>
    
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#list-tahun-ajaran").click(function(){
           window.location.href = "<?php echo base_url()?>asisten/menu/ta";
       });
       $("#edit").click(function(){
           var id = $("#id").val();
           window.location.href = "<?php echo base_url()?>asisten/menu/akun/edit/"+id;
       })
    })
</script>