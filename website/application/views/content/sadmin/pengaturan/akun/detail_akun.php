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
                <td class="bg-gray">password</td><td><input type="password" name="password" class="readonly" readonly value="<?php echo $akun["user_password"]?>"></td>
            </tr>
           
        </table>
        <footer>
            <div class="submit_link">
                <input type="submit" class="alt_btn" name="edit" id="edit" value="Edit" title="Edit"/>
            </div>
        </footer>
    </article>
    
</section>
<script type="text/javascript">
    $(document).ready(function(){
       $("#list-tahun-ajaran").click(function(){
           window.location.href = "<?php echo base_url()?>superadmin/menu/ta";
       });
       $("#edit").click(function(){
           var id = $("#id").val();
           window.location.href = "<?php echo base_url()?>superadmin/menu/akun/edit/"+id;
       })
    })
</script>