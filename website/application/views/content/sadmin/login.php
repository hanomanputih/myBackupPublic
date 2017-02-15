<div id="info"></div>
<table border="0" cellpadding="0" cellspacing="0">
    <tr>
            <th>Username</th>
            <td><input name="username" id="username" type="text" placeholder="username" class="login-inp"/></td>
    </tr>
    <tr>
            <th>Password</th>
            <td><input name="password" id="password" type="password" placeholder="password" class="login-inp"/></td>
    </tr>
    <tr>
            <th></th>
            <td><input name="login" id="submit" type="submit" class="submit-login" value="Login" /></td>
    </tr>
</table>
<script type="text/javascript">
    $(document).ready(function(){
        $("#submit").click(function(){
            var username = $("#username").val();
            var password = $("#password").val();
            if(username.length === 0)
            {
                displayMessage("red-left","username tidak boleh kosong");
            }else if(password.length === 0){
                displayMessage("red-left","password tidak boleh kosong");
            }else{

                displayLoadingLogin("Mohon tunggu ...");

                $.ajax("<?php echo base_url()?>superadmin/login/ceklogin",{
                    data : {
                        username : $("#username").val(),
                        password : $("#password").val()
                    },
                    type : "POST",
                    dataType : "JSON",
                    success: function(dataFromServer){
                        if(dataFromServer.berhasil){
                            displayMessage("blue-left","Berhasil login");
                            window.location.reload();
                        }
                        else
                        {
                            displayMessage("red-left","username / password salah");
                        }
                    },
                    error: function(){
                        displayMessage("red-left","Maaf, terjadi kesalahan pada server kami");
                    }
                })
            }
        })
    })
    </script>