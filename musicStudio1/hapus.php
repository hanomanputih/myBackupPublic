<?php
include 'koneksi.php';

$id = $_GET['id'];

$query2 = "SELECT * FROM studio WHERE idstudio='$id'";
$sql2 = oci_parse($koneksi, $query2);
ociexecute($sql2);
ocifetchinto($sql2, $data1, OCI_ASSOC);
$fotolama = $data1['FOTO'];
$hapus = "image_studio/$fotolama";
@$hapusfoto = unlink($hapus);


$query = "delete from studio where idstudio = '$id'";
$qr = oci_parse($koneksi, $query);
ociexecute($qr);

echo "<meta http-equiv=refresh content=0;url=homeadmin.php?cat=kelola>";
?>
