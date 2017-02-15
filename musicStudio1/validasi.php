<?php
include "koneksi.php";
$username = $_POST["username"];
$password = $_POST["password"];
$query = "select * from admin where username='$username' and password='$password'";
$tampil = ociparse($koneksi,$query);
ociexecute($tampil);
$data = ocifetchinto($tampil, $data, OCI_ASSOC);
$jumlah = ocirowcount($tampil);

if ($jumlah > 0) {
       session_start();
       $_SESSION ["username"] = $data ["USERNAME"];
      echo "<meta http-equiv=refresh content=0;url=homeadmin.php>";
    }
    else{
        echo "<center><h1>LOGIN GAGAL</h1>";
        echo "<a href=\"login.php\">ULANGI LOGIN</a></center>";
    }
?>
