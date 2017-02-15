<?php
$hostname = "ivan.server";
$database = "knn";
$username = "root";
$password = "";
$koneksi = mysql_pconnect($hostname, $username, $password) or die ("Koneksi dengan database gagal dibuat, refresh(F5) halaman ini");
mysql_select_db($database) or die("ERROR: Database tidak ada!"); 
?>
