<?php
include 'koneksi.php';

$id = $_GET['id'];

$query = "delete from tamu where idtamu = '$id'";
$qr = oci_parse($koneksi, $query);
ociexecute($qr);

echo "<meta http-equiv=refresh content=0;url=homeadmin.php?cat=lihattamu>";
?>