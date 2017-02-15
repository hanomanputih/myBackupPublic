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
            <td><input name="login" id="submit" type="submit" class="submit-login" /></td>
    </tr>
</table>

<script type="text/javascript">
    $(document).ready(function(){

        $("#submit").click(function(){ 
            $("#info").removeClass();

            var username = $("#username").val();
            var password = $("#password").val();
            if(username.length === 0)
            {
                displayError("username tidak boleh kosong");
            }else if(password.length === 0)
            {
                displayError("password tidak boleh kosong");
            }
            else{

                displayLoading("Mohon tunggu ...");
                $.ajax("<?php echo base_url()?>asisten/login/ceklogin",{
                    data:{
                        username: $("#username").val(),
                        password: $("#password").val()
                    },
                    type: "POST",
                    dataType: "JSON",
                    success: function(data){
                        if(data.status == true){
                            displaySuccess("Berhasil login");
                            window.location.reload();
                        }else{
                            displayError("Username / password salah");
                        }
                    },
                    error: function(){
                        displayError("Maaf, terjadi kesalahan pada server");
                    }
                })
           }        
        })
    })
    function displayLoading(msg){
        $("#info").hide();
        $("#info").addClass("yellow-left");
        $("#info").html(msg);
        $("#info").slideDown(300);
    }
    function displaySuccess(msg){
        $("#info").hide();
        $("#info").addClass("blue-left");
        $("#info").html(msg);
        $("#info").slideDown(300);
    }
    function displayError(msg){
        $("#info").hide();
        $("#info").addClass("red-left");
        $("#info").html(msg);
        $("#info").slideDown(300);
    }
</script>