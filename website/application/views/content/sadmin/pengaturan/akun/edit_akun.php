<section id="main" class="column">
    <h4 id="info"></h4>
    <article class="module width_3_quarter">
        <header><h3>Detail Akun</h3></header>
        <table class="horison-padding vertical-padding">
            <input type="hidden" name="id" id="id" value="<?php echo $akun["user_id"]?>">
            <tr>
                <td class="bg-gray">Username</td><td><input type="text" name="username" id="username" value="<?php echo $akun["user_username"]?>"></td>
            </tr>
            <tr>
                <td class="bg-gray">password</td><td><input type="password" name="password" id="password" placeholder="Password lama"></td>
            </tr>
            <tr>
                <td class="bg-gray">Password Baru</td><td><input type="password" name="password-new" id="password-new" placeholder="Password baru"></td>
            </tr>
           
        </table>
        <footer>
            <div class="submit_link">
                <input type="submit" class="alt_btn" name="simpan" id="simpan" value="Simpan" title="Simpan"/>
            </div>
        </footer>
    </article>
    
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#list-tahun-ajaran").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/menu/ta";
       });
       $("#simpan").click(function(){
           $.post("<?php echo base_url()?>superadmin/menu/akun/validasi",
            {
                "id":$("#id").val(),
                "username":$("#username").val(),
                "password":$("#password").val(),
                "password_new":$("#password-new").val()
            },
            function(data){
                console.log(data);
                if(data.message == true){
                    displayMessage("alert_success","Akun Berhasil diubah");   
                }else if(data.message == "empty"){
                    displayMessage("alert_error","Password tidak boleh kosong");
                }else if(data.message == "invalid"){
                    displayMessage("alert_error","Password tidak cocok");
                }else if(data.message == "alpha"){
                    displayMessage("alert_error",data.variable+" harus alpha numeric");
                }else if(data.message == "strength"){
                    displayMessage("alert_error","Panjang password baru minimal 6 dan maksimal 32 karakter");
                }else{
                    displayMessage("alert_error","Akun gagal diubah");
                }
            },"JSON"
       );
       })
    })
</script>